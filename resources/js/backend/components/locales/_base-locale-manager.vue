<template>
    <div class="row">
        <div class="col-md-3">
            <div class="card card-body">
                <select class="form-control" v-model="selected_language" @change="fetchTranslationsForLocale()">
                    <option v-for="locale in locales" :key="locale" :value="locale">
                        {{ locale }}
                    </option>
                </select>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <strong>Languages</strong>
                </div><!--card-header-->
                <div class="card-body card-min-height">
                    <vue-element-loading :active="loading" background-color="rgba(255,255,255,.9)"  :is-full-screen="false" spinner="bar-fade-scale"/>

                    <v-client-table
                        name="localeTable"
                        :data="translations"
                        :columns="columns" 
                        ref="datatable"
                        :options="options">

                        <template slot="value" slot-scope="props">
                            <a href="#" class="editable" 
                                data-type="textarea"
                                :data-url="`/locales/strings/${selected_language}`">{{ props.row.value }}</a>
                        </template>
                    </v-client-table>

                </div><!--card-body-->
            </div><!--card-->
        </div>
        
    </div>
</template>

<script>

import editable from '../../plugins/bootstrap-editable'

//const editable = require('bootstrap-editable')

export default {
    props: ['locales'],
    components: {
        
    },

    data(){
        return {
            loading: false,
            selected_language: 'en',
            translations: [],

            columns: ['key', 'value', 'action'],
                
            options: {
                perPage: 15,
                perPageValues:[15, 30, 50,100],
                highlightMatches: true,
                filterable: ['key', 'value'],
                headings: {
                    'key': this.trans('strings.key'),
                    'value': this.trans('strings.value'),
                    'action': ''
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

    methods: {
        async fetchTranslationsForLocale(){
            this.loading = await true
            await axios.get(`/api/admin/locales/strings/${this.selected_language}`)
                .then(response => {
                    this.translations = response.data.translations
                }).finally(() => this.loading = false)
        }
    },

    beforeMount(){
        this.fetchTranslationsForLocale()
    },

    mounted(){
        setTimeout(() =>{
            $('.editable').editable({
                inputclass: 'form-control',
                title: 'Enter Translation',
                url: '/post',
            })
        }, 2000)
        
    }
}
</script>

<style>
@import '~bootstrap-editable/css/bootstrap-editable.css'
</style>