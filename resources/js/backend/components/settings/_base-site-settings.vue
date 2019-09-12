<template>
    <form @submit.prevent="submit">
        <div class="row">
            <div class="col-md-6">
                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.site') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.site_mode') }}</label>
                        <div class="col-md-8 ">
                            <el-switch
                                style="display: block"
                                v-model="form.site_mode"
                                active-color="#13ce66"
                                inactive-color="#ff4949"
                                :active-text="trans('strings.live')"
                                :inactive-text="trans('strings.demo')"
                                active-value="live"
                                inactive-value="demo">
                            </el-switch>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.site_name') }}</label>
                        <div class="col-md-8 ">
                            <input type="text" v-model="form.site_name" class="form-control" 
                                :class="{ 'is-invalid': form.errors.has('site_name') }">
                                <has-error :form="form" field="site_name"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.site_description') }}</label>
                        <div class="col-md-8 ">
                            <textarea v-model="form.site_description" class="form-control" :class="{ 'is-invalid': form.errors.has('site_description') }"></textarea>
                            <has-error :form="form" field="site_description"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.site_keywords') }}</label>
                        <div class="col-md-8 ">
                            <textarea v-model="form.site_keywords" class="form-control" :class="{ 'is-invalid': form.errors.has('site_keywords') }"></textarea>
                            <has-error :form="form" field="site_keywords"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.google_analytics') }}</label>
                        <div class="col-md-8 ">
                            <input type="text" v-model="form.site_google_analytics" class="form-control" 
                                placeholder="UA-XXXXXXXX"
                                :class="{ 'is-invalid': form.errors.has('site_google_analytics') }">
                                <has-error :form="form" field="site_google_analytics"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.site_currency') }}</label>
                        <div class="col-md-8 ">
                            <select v-model="form.site_currency" class="form-control" 
                                :class="{ 'is-invalid': form.errors.has('site_currency') }">
                                <option v-for="currency in currencies" :value="currency.code" :key="currency.code">
                                    {{ currency.name }}
                                </option>
                            </select>
                            <has-error :form="form" field="site_currency"></has-error>
                        </div>
                    </div>

                    <!-- <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.site_address') }}</label>
                        <div class="col-md-8 ">
                            <textarea v-model="form.site_address" class="form-control" :class="{ 'is-invalid': form.errors.has('site_address') }"></textarea>
                            <has-error :form="form" field="site_address"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.system_email') }}</label>
                        <div class="col-md-8 ">
                            <input type="text" v-model="form.site_system_email" class="form-control" 
                                :class="{ 'is-invalid': form.errors.has('site_system_email') }">
                                <has-error :form="form" field="site_system_email"></has-error>
                        </div>
                    </div> -->
                </fieldset>

                <!-- Sales -->
                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.author_earnings') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.organic_sales_percent') }}</label>
                        <div class="col-md-8 ">
                            <input type="number" v-model="form.earning_organic_sales_percentage" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('form.earning_organic_sales_percentage') }">
                            <has-error :form="form" field="form.earning_organic_sales_percentage"></has-error>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.promo_sales_percent') }}</label>
                        <div class="col-md-8 ">
                            <input type="number" v-model="form.earning_promo_sales_percentage" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('earning_promo_sales_percentage') }">
                            <has-error :form="form" field="earning_promo_sales_percentage"></has-error>
                        </div>
                    </div>
                </fieldset>
            </div>

            <!-- RIGHT -->
            <div class="col-md-6">
                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.license_information') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.purchase_code') }}</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.purchase_code" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('purchase_code') }">
                            <has-error :form="form" field="purchase_code"></has-error>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.envato_username') }}</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.envato_username" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('envato_username') }">
                            <has-error :form="form" field="envato_username"></has-error>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.video_settings') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.video_upload_location') }}</label>
                        <div class="col-md-8">
                            <select v-model="form.video_upload_location" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('video_upload_location') }">
                                <option value="s3">{{ trans('strings.amazon_s3_bucket') }}</option>
                                <option value="local">{{ trans('strings.local_server') }}</option>
                            </select>
                            <has-error :form="form" field="video_upload_location"></has-error>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.video_max_size_mb') }}</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.video_max_size_mb" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('video_max_size_mb') }">
                            <has-error :form="form" field="video_max_size_mb"></has-error>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.video_providers') }}</label>
                        <div class="col-md-8">
                            <select v-model="form.video_providers" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('video_providers') }">
                                <option value="upload">{{ trans('strings.upload_only') }}</option>
                                <option value="youtube">{{ trans('strings.youtube_only') }}</option>
                                <option value="both">{{ trans('strings.both') }}</option>
                            </select>
                            <has-error :form="form" field="video_providers"></has-error>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.images') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.site_logo') }}</label>
                        <div class="col-md-8">
                            place upload component here
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.site_favicon') }}</label>
                        <div class="col-md-8">
                            place upload component here
                        </div>
                    </div>
                </fieldset>
            </div>


            <div class="col-md-12">
                <base-button :loading="form.busy" class="btn-block btn-lg btn-success">
                    {{ trans('strings.save') }}
                </base-button>
            </div>

        </div>
    </form>
</template>

<script>
import Form from 'vform'
export default {
    data(){
        return {
            currencies: [],
            form: new Form({
                site_mode: 'demo',
                site_name: '',
                site_description: '',
                site_keywords: '',
                site_address: '',
                site_google_analytics: '',
                //site_system_email: '',
                earning_organic_sales_percentage: '',
                earning_promo_sales_percentage: '',
                purchase_code: '',
                envato_username: '',
                video_upload_location: 'local',
                video_max_size_mb: 20,
                video_providers: 'both',
                site_currency: 'USD'
            })
        }
    },

    methods:{
        submit(){
            this.form.post(`/api/admin/settings/site`)
                .then(() => {
                    this.$bus.$emit('currency:updated', null)
                })
        },

        fetchSettings(){
            axios.get('/api/admin/settings')
                .then(async res => {
                    const settings = await res.data.site
                    if(settings !== undefined){
                        for(const key of this.form.keys()){
                            //if(settings[key] && parseInt(settings[key])==1) settings[key] = await true
                            //if(settings[key] && parseInt(settings[key])==0) settings[key] = await false
                            this.form[key] = await settings[key] || this.form[key]
                        }
                    }
                })
        }
    },

    beforeMount(){
        this.fetchSettings()
    },

    mounted(){
        this.$bus.$on('currencies:fetched', data => {
            this.currencies = data 
        })
    }

}
</script>