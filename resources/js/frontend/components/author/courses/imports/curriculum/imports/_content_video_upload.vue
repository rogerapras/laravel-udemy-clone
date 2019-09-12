<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <file-upload 
                    ref="uploader"
                    :url='url'
                    :accept="accept"
                    @success="fileSuccess"
                    @progress="fileProgress"
                    @change="onFileChange"></file-upload>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-12 text-right">
                <a href="#" class="d-block" @click.prevent="cancel">
                    {{ trans('strings.cancel') }}    
                </a>
            </div>
        </div>
        
    </div>
</template>

<script>
    import { mapGetters, mapState } from 'vuex'

    export default {
        name: 'ContentVideoUpload',
        data(){
            return {
                url: `/api/lessons/${this.lesson.id}/video/upload`,
                //headers: {'access-token': '<your-token>'},
                filesUploaded: [],
                accept: '.mp4,.mpeg'
            }
        },

        props: ['lesson'],
        
        methods: {
            fileSuccess(e){
                this.$bus.$emit('upload:complete', this.lesson.id)
            },
            
            fileProgress(value){
                //console.log(value)
            },
            
            cancel(){
                //const uploaderInstance = this.$refs.uploader.uploader
                //uploaderInstance.cancel()
                this.$bus.$emit('upload:cancelled', this.lesson.id)
            },
            
            onFileChange(file){
                this.fileUploaded = file
            }
            
        }
        
    }
</script>

<style>
    .file-upload .input-wrapper {
        background-color: #007791!important;
        height: 30px!important;
    }
    .file-upload .input-wrapper .file-upload-label .file-upload-icon {
        font-size: 18px!important;
    }
    .file-upload .input-wrapper .file-upload-label {
        display: flex !important;
        justify-content: center;
        align-items: center;
        padding: 5px 10px !important;
    }
    label > span {
        width: auto !important;
        text-align: right !important;
        padding-right: 0 !important;
        border-right: none !important;
    }
</style>