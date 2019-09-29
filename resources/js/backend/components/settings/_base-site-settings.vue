<template>
    <form @submit.prevent="submit">
        <div class="row">
            <div class="col-md-8">
                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.site_settings') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.site_mode') }}</label>
                        <div class="col-md-8">
                            <div class="form-group rowx mb-1">
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300 mb-0">
                                    <input id="enable_demo_mode" name="enable_demo_mode" :value="true" v-model="form.enable_demo_mode" 
                                        class="custom-control-input rounded-0" 
                                        type="checkbox">
                                    <label class="custom-control-label" for="enable_demo_mode">
                                        {{ trans('strings.enable_demo_mode') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.redirect_https') }}</label>
                        <div class="col-md-8 ">
                            <div class="form-group rowx mb-1">
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300 mb-0">
                                    <input id="redirect_https" name="redirect_https" :value="true" v-model="form.redirect_https" 
                                        class="custom-control-input rounded-0" 
                                        type="checkbox">
                                    <label class="custom-control-label" for="redirect_https">
                                        {{ trans('strings.redirect_https') }}
                                    </label>
                                </div>
                            </div>
                            <p class="text-muted mt-0 mb-2">{{ trans('strings.redirect_https_explanation') }}</p>
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
            <div class="col-md-4"></div>


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
                enable_demo_mode: false,
                site_url: '',
                redirect_https: false,
                site_name: '',
                site_description: '',
                site_keywords: '',
                site_address: '',
                site_google_analytics: '',
                earning_organic_sales_percentage: '',
                earning_promo_sales_percentage: '',
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
                            if(settings[key] && parseInt(settings[key])==1) settings[key] = await true
                            if(settings[key] && parseInt(settings[key])==0) settings[key] = await false

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