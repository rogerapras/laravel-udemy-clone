<template>
    <div class="panel list-complete-item dragme" :id="`lesson-heading-${lesson.id}`">
        
        <h4 class="acdn-title clearfix p-2">
            <a data-toggle="collapse" :data-parent="`#MyLessonAccordion-${section.id}`"
                :href="`#lessoncollapse-${lesson.uuid}`" class="draggable-panel collapsed" aria-expanded="false">
                <i class="fa fa-check-circle text-success" v-if="hasContent"></i>
                <i class="fa fa-check-circle" v-else></i>
                {{ trans('strings.lesson') }} {{ lesson.sortOrder }}:
                <span class="fa fa-play-circle" v-if="hasContent && lesson.content_type=='video'"></span> 
                <span class="fa fa-youtube text-danger" v-if="hasContent && lesson.content_type=='youtube'"></span> 
                <span class="fa fa-file-text-o" v-if="hasContent && lesson.content_type=='article'"></span> 
                {{ lesson.title }}
            </a>
            <span class="actions d-none pull-right mr-0 font-13">
                <i class="fas fa-arrows-alt reorder-icon mr-3 handle"></i>
                <a href="#" @click.prevent="EditLesson(lesson.uuid)">
                    <i class="fas fa-pencil-alt mr-3"></i>
                </a>
                <a href="#" @click.prevent="destroy()">
                    <i class="fas fa-trash"></i>
                </a>
            </span>
        </h4>

        <div :id="`lessoncollapse-${lesson.uuid}`" class="panel-collapse collapse" aria-expanded="false">
            <div class="acdn-body">
                <div class="row mb-3" v-if="ShowLessonEdit">
                    <div class="col-md-12">
                        <EditLessonForm :lesson="lesson" />
                    </div>
                </div>
                
                <div class="row" v-else>
                    <div class="col-md-12" v-if="!action && !hasContent">
                        <div class="btn-group d-flex justify-content-center" role="group" aria-label="Action Buttons">

                            <button v-if="source == 'both' || source == 'upload'" type="button" class="btn btn-light flex-fillx mr-2" @click="SetAddContent('video', 'new')">
                                <i class="fas fa-cloud-upload-alt"></i>
                                {{ trans('strings.upload_video') }}
                            </button>
                            <button v-if="source == 'both' || source == 'youtube'" type="button" class="btn btn-light flex-fillx mr-2" @click="SetAddContent('youtube', 'new')">
                                <i class="fab fa-youtube"></i>
                                {{ trans('strings.youtube_video') }}
                            </button>
                            <button type="button" class="btn btn-light flex-fillx" @click="SetAddContent('article', 'new')">
                                <i class="fas fa-file-alt"></i>
                                {{ trans('strings.text_content') }}
                            </button>
                        </div>
                    </div>
                    
                    <!-- CHECK THIS AND PASS THE CORRECT DATA -->
                    <div class="col-md-12" v-if="action">
                        <ContentVideoUpload :lesson="lesson" v-if="action=='NewVideoUpload'" />
                        <ContentCreateYoutubeForm :lesson="lesson" v-if="action=='NewYoutubeVideo'" />
                        <ContentCreateYoutubeForm :lesson="lesson" action="edit" v-if="action=='EditYoutubeVideo'" />
                        <ContentCreateArticleForm :lesson="lesson" v-if="action=='NewArticle'" />
                        <ContentCreateArticleForm :lesson="lesson" action="edit" v-if="action=='EditArticle'" />
                    </div>
                    
                    <div class="col-md-12 d-flex" v-if="!action && hasContent">
                        <!-- Uploaded Video -->
                        <div class="d-flex" v-if="lesson.content_type=='video'">
                            <div class="p-3 border rounded bg-secondary mr-2">
                                <i class="fa fa-play-circle fa-2x text-white"></i>    
                            </div>
                            <div class="d-flex flex-column">
                                <div>
                                    <h4 class="text-secondary">
                                        {{ lesson.video.original_filename }}
                                    </h4>
                                </div>
                                <div class="mt-1">{{ lesson.durationHMS }} min</div>
                                
                                <div class="mt-1">
                                    <template v-if="lesson.video.is_processed && lesson.video.processing_succeeded">
                                        <a href="#" @click.prevent="SetAddContent('video', 'edit')">
                                            <i class="fas fa-pencil-alt"></i> {{ trans('strings.edit_content') }}
                                        </a>
                                    </template>
                                    <template v-if="lesson.video.is_processed && !lesson.video.processing_succeeded">
                                        <span class="badge badge-danger">{{ trans('strings.video_processing_failed') }}</span>
                                        <a href="#" @click.prevent="SetAddContent('video', 'edit')">
                                            <i class="fas fa-pencil-alt"></i> {{ trans('strings.edit_content') }}
                                        </a>
                                    </template>
                                    <template v-if="!lesson.video.is_processed">
                                        <span class="badge badge-warning">{{ trans('strings.video_processing') }}</span>
                                    </template>
                                </div>
                                
                            </div>
                        </div>
                        
                        <!-- Youtube Video -->
                        <div class="d-flex" v-if="lesson.content_type=='youtube'">
                            <div class="p-3 border rounded bg-danger mr-2">
                                <i class="fab fa-youtube fa-2x text-white"></i>    
                            </div>
                            <div class="d-flex flex-column">
                                <div>
                                    <h4 class="text-secondary">
                                        {{ lesson.video.youtube_link }}
                                    </h4>
                                </div>
                                <div class="mt-1">{{ lesson.durationHMS }}</div>
                                <div class="mt-1">
                                    <a href="#" @click.prevent="SetAddContent('youtube', 'edit')">
                                        <i class="fas fa-pencil-alt"></i> {{ trans('strings.edit_content') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Article -->
                        <div class="d-flex" v-if="lesson.content_type=='article'">
                            <div class="p-3 border rounded bg-secondary mr-2">
                                <i class="fa fa-file-alt fa-2x text-white"></i>    
                            </div>
                            <div class="d-flex flex-column">
                                <div class="mt-2">
                                    <a href="#" @click.prevent="SetAddContent('article', 'edit')">
                                        <i class="fas fa-pencil-alt"></i> {{ trans('strings.edit_content') }}
                                    </a>
                                </div>
                                <div class="mt-2">
                                    <a href="#" @click.prevent="SetAddContent('video', 'replace')">
                                        <i class="fa fa-play-circle"></i> {{ trans('strings.replace_with_video') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    import { mapGetters, mapState } from 'vuex'
    import EditLessonForm from './_edit_lesson_form'
    import ContentVideoUpload from './_content_video_upload'
    import ContentCreateYoutubeForm from './_content_create_youtube_form'
    import ContentCreateArticleForm from './_content_create_article_form'
    
    import Form from 'vform'
    import axios from 'axios'
    export default{
        name: 'SectionLesson',
        
        components: {
            EditLessonForm,
            ContentVideoUpload,
            ContentCreateYoutubeForm,
            ContentCreateArticleForm
        },
        
        props: ['index', 'prop_lesson', 'section', 'findLessonsBySection'],
        
        data(){
            return {
                source: '',
                lesson: {},
                action: null,
                hasContent: false,
                content: [],
                ShowLessonEdit: false
            }
        },
        
        methods: {
            findLessonContent(){
                axios.get(`/api/lessons/${this.prop_lesson.id}`)
                    .then(response => {
                        this.lesson = response.data.data
                        this.hasContent = response.data.data.has_content
                    })
            },
            
            EditLesson(uid){
                let _el = $(`#lessoncollapse-${uid}`)
                if(!_el.hasClass("show")){
                    _el.addClass("show");
                }
                
                this.ShowLessonEdit = true    
            },
            
            SetAddContent(type, action){

                if(type == 'video' && action == 'new'){
                    this.action = 'NewVideoUpload'
                }
                
                if(type == 'youtube' && action == 'new'){
                    this.action = 'NewYoutubeVideo'
                }
                
                if(type == 'youtube' && action == 'edit'){
                    this.action = 'EditYoutubeVideo'
                }
                
                if(type == 'video' && action == 'edit'){
                    this.$dialog.confirm({title: this.trans('strings.confirm_delete'), 
                        body: this.trans('strings.this_will_delete_current_video')}, {animation: 'fade'})
                    .then(dialog => {
                        this.action = 'NewVideoUpload'
                    }).catch(() => {
                        
                    }); 
                }
                
                if(type == 'video' && action == 'replace'){
                    this.$dialog.confirm({title: this.trans('strings.confirm_delete'), body: this.trans('strings.text_will_be_deleted')}, {animation: 'fade'})
                    .then(dialog => {
                        this.action = 'NewVideoUpload'
                    }).catch(() => {

                    }); 
                }
                
                if(type == 'article' && action=='new'){
                    this.action = 'NewArticle'
                }
                
                if(type == 'article' && action=='edit'){
                    this.action = 'EditArticle'
                }
                
                
            },
            
            destroy(){
                this.$dialog.confirm({title: this.trans('strings.confirm_delete'), 
                    body: this.trans('strings.confirm_lesson_delete')}, {animation: 'fade', loader: true})
                    .then(dialog => {
                        axios.delete(`/api/lessons/${this.prop_lesson.id}`)
                            .then(() => {
                                dialog.close()
                                this.findLessonsBySection()
                            }).catch(e => {
                                dialog.close()
                            })
                            
                    })
            }
        },
        
        created(){
            this.findLessonContent()
        },

        async beforeMount(){
            this.source = await window.config.source
        },
        
        mounted(){
            
            this.$bus.$on('upload:cancelled', data => {
                if(data == this.prop_lesson.id){
                    this.action = null
                }
            })
            .$on('upload:complete', data => {
                if(data == this.prop_lesson.id){
                    this.action = null
                    this.hasContent = true
                    this.findLessonContent()
                }
            })
            .$on('lesson.editEnd', data => {
                if(data ==  this.prop_lesson.id){
                    this.ShowLessonEdit = false
                    this.findLessonsBySection()
                }
            })
            
            $('.acdn-title').on('mouseover', function(){
                $(this).find('.actions').removeClass('d-none');
            }).on('mouseout', function(){
                $(this).find('.actions').addClass('d-none');
            })
        }
        
        
        
    }
</script>

<style scoped>
.tc-accordion .acdn-title a:after,
.tc-accordion .acdn-title a.collapsed:after{
    content: ''
}
</style>