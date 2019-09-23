<template>
    <div>
        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-money-bill-alt"></i>
            <span class="text-uppercase">{{ currency }}</span>
        </button>

        <div class="dropdown-menu" aria-labelledby="about-us">
            <a class="dropdown-item" v-for="c in selected" :key="c.code"
                href="#" @click.prevent="switchCurrency(c.code)">
                {{ c.name }}
            </a>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default{
        computed:{
            ...mapGetters({
                currencies: 'currency/currencies'
            }),
            
            currency:{
                get(){
                    return this.$store.state.currency.currency
                },
                
                set(val){
                    this.$store.commit('currency/SET_CURRENCY', val)
                }
            },

            selected(){
                return this.currencies.filter(c => c.code !== this.currency)
            }
        },

        methods:{
            async switchCurrency(cur){
                await this.$store.commit('currency/SET_CURRENCY', cur)
            }
        }
        
        
    }
</script>