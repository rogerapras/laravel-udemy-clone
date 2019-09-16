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
                        <label class="col-md-4 form-control-label">{{ trans('strings.redirect_https') }}</label>
                        <div class="col-md-8 ">
                            <el-switch
                                style="display: block"
                                v-model="form.redirect_https"
                                active-color="#13ce66"
                                inactive-color="#ff4949"
                                :active-text="trans('strings.yes')"
                                :inactive-text="trans('strings.no')"
                                :active-value="true"
                                :inactive-value="false">
                            </el-switch>
                            <p class="text-muted mt-2 mb-2">{{ trans('strings.redirect_https_explanation') }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.site_url') }}</label>
                        <div class="col-md-8 ">
                            <input type="text" v-model="form.site_url" class="form-control" 
                                :class="{ 'is-invalid': form.errors.has('site_url') }">
                                <has-error :form="form" field="site_url"></has-error>
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

                    <template v-if="form.video_providers !== 'youtube'">
                        <div class="form-group rowx mb-1">
                            <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300 mb-0">
                                <input id="remember" name="remember" :value="true" v-model="form.encode_videos" 
                                    class="custom-control-input rounded-0" 
                                    type="checkbox">
                                <label class="custom-control-label" for="remember">
                                {{ trans('strings.enable_video_encoding') }}
                                </label>
                            </div>
                            <div class="alert alert-warning p-2">
                                <h4 class="text-darkx mb-0 font-weight-light">{{ trans('strings.important') }}</h4>
                                <p class="font-13 text-darkx mb-0">{{ trans('strings.enable_video_encoding_explanation') }}</p>
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

                        <template v-if="form.video_upload_location == 's3'">
                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.s3_access_id') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.s3_access_id" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('s3_access_id') }">
                                    <has-error :form="form" field="s3_access_id"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.s3_secret_access_key') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.s3_secret_access_key" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('s3_secret_access_key') }">
                                    <has-error :form="form" field="s3_secret_access_key"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.s3_default_region') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.s3_default_region" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('s3_default_region') }">
                                    <has-error :form="form" field="s3_default_region"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.s3_bucket') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.s3_bucket" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('s3_bucket') }">
                                    <has-error :form="form" field="s3_bucket"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.s3_url') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.s3_url" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('s3_url') }">
                                    <has-error :form="form" field="s3_url"></has-error>
                                </div>
                            </div>
                        </template>

                        
                    </template>
                </fieldset>

                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.images') }}</legend>
                    <div class="form-group row mb-1">
                        <!-- <label class="col-md-4 form-control-label">{{ trans('strings.site_logo') }}</label> -->
                        <div class="col-md-12">
                            <div class="mb-2">
                                <img :src="form.logo" width="200" class="rounded" />
                            </div>
                            <div class="">
                                <button id="pick-logo" :disabled="isLoading" :class="{ 'btn-loading': isLoading }" class="btn btn-sm btn-info">
                                    {{ trans('strings.choose_logo') }}
                                </button>
                                <avatar-cropper
                                    @uploaded="handleUploaded"
                                    @uploading="handleUploading"
                                    mimes="image/png,image/gif,image/jpeg"
                                    trigger="#pick-logo"
                                    upload-form-name="photo"
                                    upload-url="/api/admin/settings/upload?icon_type=logo"
                                    :cropper-options="{ autoCropArea: 1 }"
                                    :labels="{ submit: trans('strings.submit'), cancel: trans('strings.cancel') }"/>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <!-- <label class="col-md-4 form-control-label">{{ trans('strings.site_favicon') }}</label> -->
                        <div class="col-md-12">
                            <div class="mb-2">
                                <img :src="form.favicon" width="50" class="rounded" />
                            </div>
                            <div class="">
                                <button id="pick-favicon" :disabled="isLoading" :class="{ 'btn-loading': isLoading }" class="btn btn-sm btn-info">
                                    {{ trans('strings.choose_icon') }}
                                </button>
                                <avatar-cropper
                                    @uploaded="handleUploaded"
                                    @uploading="handleUploading"
                                    mimes="image/png,image/ico"
                                    trigger="#pick-favicon"
                                    upload-form-name="photo"
                                    upload-url="/api/admin/settings/upload?icon_type=favicon"
                                    :cropper-options="{ autoCropArea: 1, aspectRatio: 1, movable: false }"
                                    :labels="{ submit: trans('strings.submit'), cancel: trans('strings.cancel') }"/>
                            </div>
                            <hr />
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <!-- <label class="col-md-4 form-control-label">{{ trans('strings.site_favicon') }}</label> -->
                        <div class="col-md-12">
                            <div class="mb-2">
                                <img :src="form.homepage_image" width="250" class="rounded" />
                            </div>
                            <div class="">
                                <button id="pick-homepage_image" :disabled="isLoading" :class="{ 'btn-loading': isLoading }" class="btn btn-sm btn-info">
                                    {{ trans('strings.choose_homepage_image') }}
                                </button>
                                <avatar-cropper
                                    @uploaded="handleUploaded"
                                    @uploading="handleUploading"
                                    mimes="image/png,image/jpg,image/gif,image/jpeg"
                                    trigger="#pick-homepage_image"
                                    upload-form-name="photo"
                                    upload-url="/api/admin/settings/upload?icon_type=homepage_image"
                                    :cropper-options="{ autoCropArea: 1 }"
                                    :labels="{ submit: trans('strings.submit'), cancel: trans('strings.cancel') }"/>
                            </div>
                            <hr />
                        </div>
                    </div>
                </fieldset>

            </div>

            <!-- RIGHT -->
            <div class="col-md-6"></div>


            <div class="col-md-12">
                <base-button :loading="form.busy" class="btn btn-lg rounded-0 btn-success">
                    {{ trans('strings.save') }}
                </base-button>
            </div>

        </div>
    </form>
</template>

<script>
import AvatarCropper from "vue-avatar-cropper"
import Form from 'vform'
export default {
    components: {
        AvatarCropper
    },

    data(){
        return {
            isLoading: false,
            currencies: [],
            croper_options: {
                //aspectRatio: 16 / 9,
                autoCropArea: 1
            },
            form: new Form({
                encode_videos: false,
                site_mode: 'demo',
                site_url: '',
                redirect_https: false,
                site_name: '',
                site_description: '',
                site_keywords: '',
                site_address: '',
                site_google_analytics: '',
                earning_organic_sales_percentage: '',
                earning_promo_sales_percentage: '',
                purchase_code: '',
                envato_username: '',
                video_upload_location: 'local',
                video_max_size_mb: 20,
                video_providers: 'both',
                site_currency: 'USD',
                logo: '',
                favicon: '',
                homepage_image: ''
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
        },

        handleUploaded(resp) {
            this.fetchSettings()
            this.isLoading = false
        },
        handleUploading(){
            this.isLoading = true;
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