<template>
    <div>
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="mb-2">
                    <div class="text-danger mb-2" v-if="error">{{ error }}</div>
                    <el-upload 
                        class="upload-demo"
                        ref="upload"
                        :action="url"
                        :auto-upload="false"
                        :multiple="false"
                        name="file"
                        :accept="accept"
                        :on-change="uploadChanged"
                        :on-error="uploadError"
                        :on-success="uploadSuccess"
                        :on-remove="uploadRemoved"
                        :before-remove="beforeRemove"
                        :before-upload="beforeUploadCheckSize"
                        :on-progress="uploadProgress"
                        :limit="1"
                        list-type="text">
                        <el-button slot="trigger" size="small" type="primary" v-if="!fileSelected"><i class="fas fa-cloud-upload-alt"></i> Choose Video File</el-button>
                        <!-- <el-button size="small" type="warning" @click.prevent="submitUpload" v-if="fileSelected"><i class="fas fa-cloud-upload-alt"></i> Upload</el-button> -->
                        <div class="el-upload__tip" slot="tip" v-if="!fileSelected">mp4 / mpeg files with a size less than {{window_max_size}}mb</div>
                    </el-upload>
                </div>

                <el-button :disabled="uploading" size="small" type="warning" @click.prevent="submitUpload" v-if="fileSelected">
                    <i class="fas fa-cloud-upload-alt"></i> Upload
                </el-button>
                <!-- <button :disabled="uploading" type="button" class="btn btn-warning" @click.prevent="submitUpload" v-if="fileSelected"><i class="fas fa-cloud-upload-alt"></i> Upload</button> -->
            </div>

            <!-- <div class="col-md-12">
                <div class="mb-3">Max video size allowed: {{window_max_size}}MB</div>
                <div class="text-danger mb-2" v-if="error">{{ error }}</div>
                <file-upload 
                    ref="uploader"
                    :url='url'
                    :max-size="max_size" 
                    btn-label=" Select Video (.mp4, .mpeg)"
                    btn-uploading-label="Uploading..."
                    :accept="accept"
                    @error="handleError"
                    @success="fileSuccess"
                    @progress="fileProgress"
                    @change="onFileChange"></file-upload>
            </div> -->
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
                uploading: false,
                fileSelected: false,
                window_max_size: null,
                //max_size: 10000000,
                error: '',
                url: `/api/lessons/${this.lesson.id}/video/upload`,
                //headers: {'access-token': '<your-token>'},
                //filesUploaded: [],
                accept: '.mp4,.mpeg'
            }
        },

        props: ['lesson'],
        
        methods: {
            submitUpload(){
                this.$refs.upload.submit();
            },
            uploadChanged(file, fileList){
                this.fileSelected = true
            },
            uploadSuccess(response, file, fileList){
                this.uploading = false
                this.$bus.$emit('upload:complete', this.lesson.id)
            },
            uploadError(error, file, fileList){
                this.fileSelected = false
                this.uploading = false
                this.error = "Error while uploading the file"
            },
            uploadRemoved(){
                this.fileSelected = false
            },

            handleExceed(files, fileList) {
                this.$vmessage.warning(`The limit is 3, you selected ${files.length} files this time, add up to ${files.length + fileList.length} totally`);
            },

            beforeRemove(file, fileList) {
                //return this.$vconfirm(`Remove ${ file.name } from upload list?`);
            },

            beforeUploadCheckSize(file){
                const filesize = file.size / 1024 / 1024;
                const isLt20M = filesize < window.config.max_size;
                if (!isLt20M) {
                    this.$vmessage.error(`File cannot exceed ${window.config.max_size}mb in size. Your file is ${filesize.toFixed(2)}mb`);
                }

                return isLt20M;
            },

            uploadProgress(){
                this.uploading = true
            },

            cancel(){
                this.$refs.upload.clearFiles()
                this.$bus.$emit('upload:cancelled', this.lesson.id)
            },


            /****************************************** */
            fileSuccess(e){
                this.$bus.$emit('upload:complete', this.lesson.id)
            },
            
            fileProgress(value){
                //console.log(value)
            },
            
            cancel(){
                this.$bus.$emit('upload:cancelled', this.lesson.id)
            },
            
            onFileChange(file){
                this.fileUploaded = file
            },

            handleError(e){
                this.error = e.message
            }
            
        },

        beforeMount(){
            this.max_size = (window.config.max_size) * 1024 * 1024
            this.window_max_size = window.config.max_size

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