<script>
import Form from 'vform'
export default {
    data(){
        return {
            success: false,
            form: new Form({
                purchase_code: '0b4ff457-56ec-44f1-bc34-85160b580aef',
                username: 'mazensalama',
            })
        }
    },

    methods:{
        submit(){
            this.form.post(`/api/installer/license`)
                .then(response => {
                    this.success = true
                }).catch(err => {
                    this.success = false
                })
        }
    }
}
</script>