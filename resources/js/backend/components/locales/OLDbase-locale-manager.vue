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

                    <ejs-grid 
                        :dataSource="translations" 
                        :allowPaging='true' 
                        :pageSettings='{ pageCount: 5}' 
                        :editSettings='editSettings'
                        :toolbar='toolbar'
                        :actionBegin="actionBegin">
                        <e-columns>
                            <e-column field='id' :visible='false' headerText='ID' :isPrimaryKey='true' width='130'></e-column>
                            <e-column field='key' headerText='Key' width='120' textAlign='Left' :isPrimaryKey='false'></e-column>
                            <e-column field='value' headerText='Value' :template="valueTemplate" width='500' textAlign='Left'></e-column>
                        </e-columns> 
                    </ejs-grid>

                </div><!--card-body-->
            </div><!--card-->
        </div>
        
    
        
    </div>
    
</template>

<script>
import Vue from 'vue'
import { GridPlugin, Edit, Toolbar, Page } from "@syncfusion/ej2-vue-grids";
Vue.use(GridPlugin)

export default {
    props: ['locales'],
    provide: {
        grid: [Edit, Toolbar, Page]
    },

    data(){
        return {
            loading: false,
            selected_language: 'en',
            translations: [],
            valueTemplate: function () {
                return {
                    template: Vue.component('valuetemplate', {
                        template: `
                            <span class="text-primary" style="cursor: pointer; text-decoration: underline; text-decoration-style: dashed;">
                                {{ data.value }}
                            </span>`,
                        data(){ return { data: {} }; }
                    })
                }
            },
            editSettings: { 
                allowEditing: true, 
                allowAdding: true, 
                allowDeleting: true, 
                mode: 'Dialog', 
                template(){
                    return { template: Vue.component('translation-item',  {
                        template:`
                            <div formGroup="orderForm">
                                <label class="font-weight-bold">Enter translation</label>
                                <textarea id="value" class="form-control" rows="5" v-model='data.value'></text-area>
                            </div>
                            `,
                            data(){
                                return {
                                    data: {}
                                }
                            },
                        })
                    }
                }
            },
            //toolbar: ['Add', 'Edit', 'Delete', 'Cancel'],
            toolbar: ['Add', 'Edit'],
        }
    },

    methods: {
        actionBegin (args) {
            if (args.requestType === 'save') {
                const val = args.form.querySelector("#value").value
                args.data['value'] = val
                const data = args.data
                axios.post(`/api/admin/locales/${data.id}/update`, {
                    value: val,
                    group: 'strings'
                })
            }
        },
        async fetchTranslationsForLocale(){
            this.loading = await true
            await axios.get(`/api/admin/locales/strings/${this.selected_language}`)
                .then(response => {
                    this.translations = response.data.translations
                }).finally(() => this.loading = false)
        },

        reinitializeEditable(){
            
        }
    },

    beforeMount(){
        this.fetchTranslationsForLocale()
    },

    mounted(){
        
    }
}
</script>

<style scoped>
@import '~@syncfusion/ej2-base/styles/bootstrap4.css';  
@import '~@syncfusion/ej2-buttons/styles/bootstrap4.css';  
@import '~@syncfusion/ej2-navigations/styles/bootstrap4.css';
@import '~@syncfusion/ej2-popups/styles/bootstrap4.css';
@import "~@syncfusion/ej2-vue-grids/styles/bootstrap4.css";
</style>