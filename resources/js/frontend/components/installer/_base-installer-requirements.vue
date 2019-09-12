
<script>
import Form from 'vform'
export default {

    data(){
        return {
            messages: {},
            form: new Form({

            })
        }
    },

    methods:{
        checkRequirements(){
            this.form.post(`/api/installer/requirements`)
                .then(response => {
                    this.messages = response.data
                })
        }
    },

    beforeMount(){
        this.checkRequirements()
    }

}
</script>

<style>

</style>