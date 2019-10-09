<template>
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend class="scheduler-border">Site Languages</legend>
                <template v-if="languages.length > 0">
                    <table class="table table-sm table-borderedx">
                        <thead>
                            <th style="width: 150px;">{{ trans('strings.name') }}</th>
                            <th style="width: 100px;">{{ trans('strings.carbon_code') }}</th>
                            <th style="width: 100px;">{{ trans('strings.php_code') }}</th>
                            <th style="width: 150px;"></th>
                            <th style="width: 150px;"></th>
                        </thead>
                        <tbody>
                            <language-edit-form v-for="language in languages" :key="language.carbon_code" :language="language" />
                        </tbody>
                    </table>
                </template>

                <template v-else>
                    {{ trans('strings.no_languages') }}
                </template>
            </fieldset>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import LanguageEditForm from './LanguageEditForm'
import Form from 'vform'
export default {
    components:{
        LanguageEditForm
    },
    
    data(){
        return {
            languages: []
        }
    },

    methods: {
        fetchLanguages(){
            axios.get('/api/admin/languages')
                .then(response => {
                    this.languages = response.data
                })
        }
    },

    beforeMount(){
        this.fetchLanguages()

        this.$bus.$on('language:updated', () => {
            this.fetchLanguages()
        })
    }
}
</script>
