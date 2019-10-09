<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
export default {
    data(){
        return {
            form: new Form({})
        }
    },

    methods:{
        update(){
            this.form.post(`/api/installer/update`)
                .then(response => {
                    window.location.reload();
                }).catch(e => {
                    console.log(r.response)
                })
        }
    },

    computed:{
        ...mapGetters({
            currencies: 'currency/currencies'
        })
    },
    
    mounted(){
        if(this.currencies.length === 0){
            this.$store.dispatch('currency/fetchCurrencies')
        }
    }

}
</script>