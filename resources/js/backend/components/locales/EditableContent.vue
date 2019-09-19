<template>
    <div>
        <span v-if="!editing" @click="startEditing"
            class="text-primary" style="cursor: pointer; text-decoration: underline; text-decoration-style: dashed;">
            {{ form.value }}
        </span>
        <div v-if="editing">
            <div class="d-flex">
                <textarea class="form-control mb-1" v-model="form.value"></textarea>
                <div class="text-right">
                    <button class="btn btn-sm btn-success mb-1" @click="save()"><i class="fas fa-save"></i></button>
                    <button class="btn btn-sm btn-danger" @click="cancelled()"><i class="fas fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform'
export default {
    props: ['value', 'url', 'group'],

    data(){
        return {
            editing: false,
            old_val: '',
            form: new Form({
                value: '',
                group: ''
            })
        }
    },

    // watch: {
    //     value(newVal){
    //         this.form.value = newVal
    //     }
    // },

    methods: {
        save(){
            this.form.put(this.url)
                .then(response => {
                    this.editing = false
                })
        },

        cancelled(){
            this.form.value = this.old_val
            this.editing = false 

            //this.$emit('translation-cancelled')
        },

        async startEditing(){
            this.old_val = await this.form.value
            this.editing = await true
        }
    },

    mounted(){
        this.form.value = this.value
        this.form.group = this.group
    }
}
</script>