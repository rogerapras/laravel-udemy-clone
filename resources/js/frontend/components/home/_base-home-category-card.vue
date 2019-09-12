<template>
    <div class="col-md-3 mb-3">
        <a href="#" class="d-block text-dark">
            <div class="card card-body d-flex flex-row align-items-center">
    			<div class="mr-2 category__icon font-22">
    				<span :class="icon"></span>
    			</div>
    			<div class="font-18">
    				{{ name }}
    			</div>
  		    </div>
        </a>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    
    export default{
        
        name: 'CategoryCard',
        
        props: {
            name: { type: String, default: null },
            icon: { type: String, default: null }
        },
        
        data() {
          return {
            
          }
        },
      
        components: {
            
        },
      
        computed: mapGetters({
            authenticated: 'auth/check'
        }),
      
        methods: {
            
        },
    
        created(){
            
        }
    }
</script>