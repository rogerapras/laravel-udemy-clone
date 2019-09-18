<template>
    <div class="container">
        <vue-element-loading :active="loading" :is-full-screen="false" spinner="bar-fade-scale" color="#FF6700"/>
        <!-- LEFT SIDE -->
        <div class="row">  
            <div class="col-md-5">
                <div class="h5">
                    {{ trans('strings.your') }} 
                    {{ cart.item_count | pluralize('item') }} ({{ cart.item_count }})
                </div>
                <hr />
                <div class="list-group">
                    <div class="list-group-item px-0 border-0" v-for="item in cartItems" :key="item.id">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="mr-3">
                                    <img :src="item.product.thumbnail" width="100" />
                                </div>
                                <div class="d-flex flex-column">
                                    <a :href="`/course/${item.product.slug}`">
                                        <h6 class="fw-300 mb-0">
                                            {{ item.product.title | truncate(40) }}
                                        </h6>
                                        <span class="text-muted font-12">
                                            {{ trans('strings.by') }}
                                            {{ item.product.author.full_name }}
                                        </span>
                                    </a>
                                    
                                    <div class="" v-if="item.has_discount">
                                        <h4 class="fw-600 mb-0">
                                            <span v-if="item.purchase_price > 0">
                                                <base-currency :price="item.purchase_price"></base-currency>
                                            </span>
                                            <span v-else>
                                                {{ trans('strings.free') }}
                                            </span>
                                            <del class="text-muted font-13 ml-1">
                                                <base-currency :price="item.unit_price"></base-currency>
                                            </del>
                                        </h4>
                                    </div>
                                    <div class="" v-else>
                                        <h4 class="fw-600 mb-0">
                                            <base-currency :price="item.unit_price"></base-currency>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!--/ END SIDEBAR -->
    
            <div class="col-md-7 d-flex flex-column">
                <div class="d-flex h2 fw-600 align-items-center">
                    <div class="mr-2">
                        {{ trans('strings.total') }}
                    </div>
                    <div v-if="cartHasDiscount">
                        <span class="mr-2">
                            <base-currency :price="cart.total_purchase_price"></base-currency>
                        </span>
                        <del class="text-muted h5 fw-300">
                            <base-currency :price="cart.total_price"></base-currency>
                        </del>
                    </div>
                    <div v-else>
                        <base-currency :price="cart.total_price"></base-currency>
                    </div>
                </div>
        
                <!-- Checkout Components -->
                <div id="checkout__accordion" class="tc-accordion">
                    <template v-if="parseInt(payment_settings.enable_credit_card) == 1">
                        <div class="panel border border-secondary bg-white shadow-sm">
                            <h4 class="acdn-title course__detail">
                                <a data-toggle="collapse" data-parent="#checkout__accordion" href="#payment-stripe" aria-expanded="true" class="">
                                    {{ trans('strings.pay_with_credit_card') }}
                                </a>
                            </h4> 
                            <div id="payment-stripe" aria-expanded="false" 
                                class="panel-collapse collapse show">
                                <div class="acdn-body">
                                    <template v-if="payment_settings.credit_card_processor === 'stripe'">
                                        <checkout-stripe 
                                            :api_key="payment_settings.stripe_mode === 'live' ? payment_settings.stripe_live_public_key : payment_settings.stripe_sandbox_public_key" />
                                    </template>

                                    <template v-if="payment_settings.credit_card_processor === 'razorpay'">
                                        <checkout-razorpay 
                                            :api_key="payment_settings.razorpay_mode === 'live' ? payment_settings.razorpay_live_public_key : payment_settings.razorpay_sandbox_public_key"
                                            :site_name="site_name" :currency="site_currency" />
                                    </template>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </template>

                    <template v-if="payment_settings.enable_paypal">
                        <div class="panel border border-secondary bg-white shadow-sm">
                            <h4 class="acdn-title course__detail">
                                <a data-toggle="collapse" data-parent="#checkout__accordion" href="#payment-paypal" aria-expanded="false" 
                                    class="collapsed">
                                    {{ trans('strings.pay_with_paypal') }}
                                </a>
                            </h4>
                            <div id="payment-paypal" aria-expanded="false" class="panel-collapse bg-whitex collapse">
                                <div class="acdn-body">
                                    <a href="/payment/paypal/ec-checkout" class="btn btn-primary" @click="form.busy=true">
                                        <span v-if="form.busy">
                                            <i class="fa fa-spinner fa-spin"></i> 
                                            {{ trans('strings.taking_you_to_paypal') }}
                                        </span>
                                        <span v-else>
                                            {{ trans('strings.pay_with_paypal') }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CheckoutStripe from './imports/_checkout_stripe'
    import CheckoutRazorpay from './imports/_checkout_razorpay'
    import { mapGetters } from 'vuex'
    import Form from 'vform'
    
    export default {
        components:{
            CheckoutStripe,
            CheckoutRazorpay
        },

        props: ['payment_settings', 'site_name', 'site_currency'],
        
        data(){
            return {
                form: new Form({
                    cart: '', //course ids 
                    courses: []
                })
            }
        },
        
        computed: {
            ...mapGetters({
                cartItems: 'cart/items',
                cart: 'cart/cart',
                sitewideCoupon: 'cart/sitewideCoupon',
                loading: 'cart/loading'
            }),
            
            cartHasDiscount(){
                return this.cart.total_price > this.cart.total_purchase_price
            }
        },
        
        methods:{
            onPaypalClick(){
                this.form.busy = true
            }
        },

        mounted(){
            //console.log(this.payment_settings)
        }
    }

</script>

