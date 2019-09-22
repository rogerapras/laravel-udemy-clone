<template>
    <button class="btn btn-danger rounded-0 btn-lg font-16" @click="onBtnClick()">
        <span>{{ trans('strings.complete_payment') }}</span>
    </button> 
</template>
<script>
    import Form from 'vform'
    import { mapGetters } from 'vuex'

    export default {
        data(){
            return {
                form: new Form({
                    razorpay_payment_id: '',
                    cart: '',
                    courses: [],
                    purchase_price: '',
                    coupons: []
                }),
                
                options: {
                    key: '',
                    amount: 1000,
                    name: '',
                    currency: 'USD',
                    handler: this.handler,
                    theme: {
                        color: "#168AFA"
                    }
                },
                
            }
        },
        
        props:{
            type: { type: String, default: 'cart' },
            course: { type: [Array, Object] },
            api_key: { type: String, required: true }
        },
        
        computed: {
            ...mapGetters({
                cartItems: 'cart/items',
                cart: 'cart/cart',
                sitewideCoupon: 'cart/sitewideCoupon'
            }),
            
            cartHasDiscount(){
                return this.cart.total_price > this.cart.total_purchase_price
            }
        },
        
        methods: {
            onBtnClick(){
                this.options.amount = parseInt(this.cart.total_purchase_price*100)
                var rzp_popup = new Razorpay(this.options);   
                rzp_popup.open();
            },
            
            handler(response){
                this.form.razorpay_payment_id = response.razorpay_payment_id
                this.form.courses = this.cartItems.map(item => item.product.id)
                this.form.coupons = this.cartItems.filter(item => {
                    return item.coupon_id !== null;
                }).map( item => item.coupon_id )
                
                this.form.cart = this.cart.id
                this.form.purchase_price = this.cart.total_purchase_price
                this.form.post(`/api/cart/payment/razorpay/process`)
                    .then(response => {
                        //console.log(response)
                        //window.location.href="/"
                    })
            }
        },
        
        
        beforeMount(){
            this.options.key = this.api_key
            this.options.name = window.config.appName
            this.options.currency = window.config.default_currency
            /*
            setTimeout(() => {
                this.options.amount = this.cart.total_purchase_price*100
                var rzp_popup = new Razorpay(this.options);
            
                document.getElementById('razorpay-button').onclick = (e) => {
                    e.preventDefault();
                    $('#razorpay-button').attr('disabled', 'disabled');
    		        $('#razorpay-button').html("<i class='fa fa-gear fa-spin'></i> processing");
                    rzp_popup.open();
                }
            }, 1500)*/
        }
        
    }
</script>