<template>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#languages" class="nav-link" data-toggle="tab" role="tab" aria-controls="languages">
                        <i class="fas fa-globe"></i> 
                        {{ trans('strings.languages') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#translations" class="nav-link active" data-toggle="tab" role="tab" aria-controls="translations">
                        <i class="fas fa-comments"></i> 
                        {{ trans('strings.translations') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content card-min-height">
                <div class="tab-pane" id="languages" role="tabpanel">
                    <language-list></language-list>
                </div>

                <div class="tab-pane active" id="translations" role="tabpanel">
                    <vue-element-loading :active="loading" background-color="rgba(255,255,255,.9)"  :is-full-screen="false" spinner="bar-fade-scale"/>
                    <v-client-table
                        name="localeTable"
                        :data="translations"
                        :columns="columns" 
                        ref="datatable"
                        :options="options">
                        <div slot="afterFilter" class="mr-2 d-flex ml-2">
                            <div class="mr-3 form-group">
                                <div class="row">
                                    <label class="col-md-6 pr-0 text-right">{{ trans('strings.language') }}: </label>
                                    <div class="col-md-6 pl-0">
                                        <select class="form-control text-capitalize" v-model="selected_language" @change="fetchTranslationsForLocale()">
                                            <option v-for="locale in activeLanguages" :key="locale.id" :value="locale.carbon_code">
                                                {{ locale.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mr-3 form-group">
                                <div class="row">
                                    <label class="col-md-8 pr-0 text-right">{{ trans('strings.translation_group') }}: </label>
                                    <div class="col-md-4 pl-0">
                                        <select class="form-control text-capitalize" v-model="selected_group" @change="fetchTranslationsForLocale()">
                                            <option v-for="group in groups" :key="group" :value="group">
                                                {{ group.charAt(0).toUpperCase() + group.slice(1)  }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div slot="beforeLimit" class="mr-2 d-flex ml-2">
                            <button :busy="importing" class="btn btn-danger mr-2 btn-md" @click="importTranslations()">
                                <span v-if="!importing">{{ trans('strings.import') }}</span>
                                <span v-else>
                                    <i class="fas fa-spinner fa-spin"></i>
                                    {{ trans('strings.importing') }}
                                </span>
                            </button>

                            <button :busy="publishing" class="btn btn-success btn-md" @click="publish()">
                                <span v-if="!publishing">{{ trans('strings.publish') }}</span>
                                <span v-else>
                                    <i class="fas fa-spinner fa-spin"></i>
                                    {{ trans('strings.publishing') }}
                                </span>
                            </button>
                        </div>
                    </v-client-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import editable from '../../plugins/bootstrap-editable'
import Cookies from 'js-cookie'
import LanguageList from './LanguageList.vue'
import XEditable from './EditableContent.vue'

export default {
    components: {
        //XEditable,
        LanguageList
    },
    
    data(){
        return {
            importing: false,
            publishing: false,
            loading: false,
            selected_language: 'en',
            selected_group: 'strings',
            groups: {},
            languages: [],
            translations: [],

            columns: ['key', 'value'],
                
            options: {
                columnsClasses: {
                    value: 'w-75',
                    key: 'w-25'
                },
                templates: {
                    value: XEditable
                },
                perPage: 15,
                perPageValues:[15, 30, 50,100],
                highlightMatches: true,
                filterable: ['key', 'value'],
                headings: {
                    'key': this.trans('strings.key'),
                    'value': this.trans('strings.value')
                },
                filterByColumn:false,
                sendEmptyFilters: false,
                pagination: { 
                    chunk: 5, 
                    dropdown: false,
                    edge: false
                },
                skin: 'table table-responsive-sm table-stripedx table-outline table-sm',
            }
        }
    },

    computed:{
        activeLanguages(){
            if(this.languages.length)return this.languages.filter(l => l.is_active == 1);
        }
    },

    watch:{
        selected_language(lang){
            Cookies.set('selected_language', lang, { expires: 365 })
        },

        selected_group(group){
            Cookies.set('selected_group', group, { expires: 365 })
        }
    },

    methods: {
        async importTranslations(){
            this.importing = await true
            await axios.get('/api/admin/locales/import')
                .then(response => {
                    location.reload()
                }).catch(error => {
                    console.log(error.response)
                }).finally(() => {
                    this.importing = false
                })
        },

        async publish(){
            this.publishing = await true
            setTimeout(() => {
                axios.post(`/api/admin/locale/${this.selected_group}/publish`)
                    .then(response => {

                    }).finally(() => this.publishing = false)
            }, 1000)
            
        },

        fetchLanguages(){
            axios.get('/api/admin/languages?activeOnly=true')
                .then(response => {
                    this.languages = response.data
                })
        },

        async fetchTranslationsForLocale(){
            this.loading = await true
            this.translations = []
            await axios.get(`/api/admin/locales/${this.selected_group}/${this.selected_language}`)
                .then(async response => {
                    this.groups = await response.data.groups
                    const difference = await response.data.difference
                    let translations = await response.data.translations 

                    for (const d of difference) {
                        await translations.push({
                            key: d,
                            value: null,
                            locale: this.selected_language,
                            group: this.selected_group
                        })
                    }
                    this.translations = await translations
                }).finally(() => this.loading = false)
        }
    },

    created(){
        this.selected_language = Cookies.get('selected_language') || 'en'
        this.selected_group = Cookies.get('selected_group') || 'strings'
        this.fetchLanguages()
    },

    beforeMount(){
        this.fetchTranslationsForLocale()
    },

    mounted(){
        this.$bus.$on('language:updated', () => {
            this.fetchLanguages()
        })
    }
}
</script>

<style>
    /* @import '~bootstrap-editable/css/bootstrap-editable.css'; */
</style>