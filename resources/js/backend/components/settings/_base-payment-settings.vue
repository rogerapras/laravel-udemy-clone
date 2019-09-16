<template>
    <form @submit.prevent="submit">
        <div class="row">
            <div class="col-md-6">
                <!-- Gateways -->
                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.payment_gateways') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-5 form-control-label">{{ trans('strings.enable_paypal_payment') }}</label>
                        <div class="col-md-7">
                            <el-switch
                                style="display: block"
                                v-model="form.enable_paypal"
                                active-color="#13ce66"
                                inactive-color="#ff4949"
                                :active-text="trans('strings.yes')"
                                :inactive-text="trans('strings.no')">
                            </el-switch>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-5 form-control-label">{{ trans('strings.enable_credit_card') }}</label>
                        <div class="col-md-7">
                            <el-switch
                                style="display: block"
                                v-model="form.enable_credit_card"
                                active-color="#13ce66"
                                inactive-color="#ff4949"
                                :active-text="trans('strings.yes')"
                                :inactive-text="trans('strings.no')">
                            </el-switch>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-5 form-control-label">{{ trans('strings.credit_card_processor') }}</label>
                        <div class="col-md-7">
                            <select v-model="form.credit_card_processor" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('credit_card_processor') }">
                                <option value="stripe">Stripe</option>
                                <option value="razorpay">RazorPay</option>
                            </select>
                            <has-error :form="form" field="credit_card_processor"></has-error>
                        </div>
                    </div>
                </fieldset>

                <!-- PAYPAL SETTINGS -->
                <template v-if="form.enable_paypal">
                    <fieldset>
                        <legend class="scheduler-border">{{ trans('strings.paypal_settings') }}</legend>
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.paypal_mode') }}</label>
                            <div class="col-md-7">
                                <el-switch
                                    style="display: block"
                                    v-model="form.paypal_mode"
                                    active-color="#13ce66"
                                    inactive-color="#ff4949"
                                    :active-text="trans('strings.live')"
                                    :inactive-text="trans('strings.sandbox')"
                                    active-value="live"
                                    inactive-value="sandbox">
                                </el-switch>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">
                                {{ trans('strings.paypal_sandbox_api_username') }}
                            </label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.paypal_sandbox_api_username" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('paypal_sandbox_api_username') }">
                                <has-error :form="form" field="paypal_sandbox_api_username"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.paypal_sandbox_api_password') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.paypal_sandbox_api_password" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('paypal_sandbox_api_password') }">
                                <has-error :form="form" field="paypal_sandbox_api_password"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.paypal_sandbox_api_secret') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.paypal_sandbox_api_secret" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('paypal_sandbox_api_secret') }">
                                <has-error :form="form" field="paypal_sandbox_api_secret"></has-error>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.paypal_live_api_username') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.paypal_live_api_username" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('paypal_live_api_username') }">
                                <has-error :form="form" field="paypal_live_api_username"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.paypal_live_api_password') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.paypal_live_api_password" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('paypal_live_api_password') }">
                                <has-error :form="form" field="paypal_live_api_password"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.paypal_live_api_secret') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.paypal_live_api_secret" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('paypal_live_api_secret') }">
                                <has-error :form="form" field="paypal_live_api_secret"></has-error>
                            </div>
                        </div>
                    </fieldset>
                </template>

                <!-- Stripe Settings -->
                <template v-if="form.credit_card_processor == 'stripe'">
                    <fieldset>
                        <legend class="scheduler-border">{{ trans('strings.stripe_settings') }}</legend>
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.stripe_mode') }}</label>
                            <div class="col-md-7">
                                <el-switch
                                    style="display: block"
                                    v-model="form.stripe_mode"
                                    active-color="#13ce66"
                                    inactive-color="#ff4949"
                                    :active-text="trans('strings.live')"
                                    :inactive-text="trans('strings.sandbox')"
                                    active-value="live"
                                    inactive-value="sandbox">
                                </el-switch>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.stripe_sandbox_public_key') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.stripe_sandbox_public_key" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('stripe_sandbox_public_key') }">
                                <has-error :form="form" field="stripe_sandbox_public_key"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.stripe_sandbox_secret_key') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.stripe_sandbox_secret_key" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('stripe_sandbox_secret_key') }">
                                <has-error :form="form" field="stripe_sandbox_secret_key"></has-error>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.stripe_live_public_key') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.stripe_live_public_key" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('stripe_live_public_key') }">
                                <has-error :form="form" field="stripe_live_public_key"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.stripe_live_secret_key') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.stripe_live_secret_key" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('stripe_live_secret_key') }">
                                <has-error :form="form" field="stripe_live_secret_key"></has-error>
                            </div>
                        </div>
                    </fieldset>
                </template>

                <template v-if="form.credit_card_processor == 'razorpay'">
                    <!-- Razorpay Settings -->
                    <fieldset>
                        <legend class="scheduler-border">{{ trans('strings.razorpay_settings') }}</legend>
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.razorpay_mode') }}</label>
                            <div class="col-md-7">
                                <el-switch
                                    style="display: block"
                                    v-model="form.razorpay_mode"
                                    active-color="#13ce66"
                                    inactive-color="#ff4949"
                                    :active-text="trans('strings.live')"
                                    :inactive-text="trans('strings.sandbox')"
                                    active-value="live"
                                    inactive-value="sandbox">
                                </el-switch>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.razorpay_sandbox_public_key') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.razorpay_sandbox_public_key" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('razorpay_sandbox_public_key') }">
                                <has-error :form="form" field="razorpay_sandbox_public_key"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.razorpay_sandbox_secret_key') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.razorpay_sandbox_secret_key" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('razorpay_sandbox_secret_key') }">
                                <has-error :form="form" field="razorpay_sandbox_secret_key"></has-error>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.razorpay_live_public_key') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.razorpay_live_public_key" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('razorpay_live_public_key') }">
                                <has-error :form="form" field="razorpay_live_public_key"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.razorpay_live_secret_key') }}</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.razorpay_live_secret_key" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('razorpay_live_secret_key') }">
                                <has-error :form="form" field="razorpay_live_secret_key"></has-error>
                            </div>
                        </div>
                    </fieldset>
                </template>
                    

            </div>

            <!-- RIGHT -->
            <div class="col-md-6"></div>

            <div class="col-md-12">
                <base-button :loading="form.busy" class="btn rounded-0 btn-lg btn-success">
                    {{ trans('strings.save') }}
                </base-button>
            </div>
        </div>
    </form>
</template>

<script>
import axios from 'axios'
import Form from 'vform'
export default {
    data(){
        return {
            form: new Form({
                enable_paypal: false,
                enable_credit_card: false,
                credit_card_processor: 'stripe',
                paypal_mode: 'sandbox',
                paypal_sandbox_api_username: '',
                paypal_sandbox_api_password: '',
                paypal_sandbox_api_secret: '',
                paypal_live_api_username: '',
                paypal_live_api_password: '',
                paypal_live_api_secret: '',
                stripe_mode: 'sandbox',
                stripe_sandbox_public_key: '',
                stripe_sandbox_secret_key: '',
                stripe_live_public_key: '',
                stripe_live_secret_key: '',
                razorpay_mode: 'sandbox',
                razorpay_sandbox_public_key: '',
                razorpay_sandbox_secret_key: '',
                razorpay_live_public_key: '',
                razorpay_live_secret_key: ''
            })
        }
    },
    methods:{
        submit(){
            this.form.post(`/api/admin/settings/payment`)
                .then(res => this.settings = res.data.payments)
            
        },
        fetchSettings(){
            axios.get('/api/admin/settings')
                .then(async res => {
                    const settings = await res.data.payments

                    for(const key of this.form.keys()){
                        if(settings[key] && parseInt(settings[key])==1) settings[key] = await true
                        if(settings[key] && parseInt(settings[key])==0) settings[key] = await false

                        this.form[key] = await settings[key] || this.form[key]
                    }
                })
        }
    },

    beforeMount(){
        this.fetchSettings()
    }
}
</script>
