<script>
import Form from 'vform'
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
                    //console.log(response)
                }).catch(e => {
                    console.log(r.response)
                })
        }
    }

}
</script>