<template>
    <form @submit.prevent="create()" @keydown="form.onKeydown($event)">
        <div class="form-group">

            <select 
                v-if="courses.length" 
                v-model='form.courses' 
                :multiple="true"
                class="form-control"
                :placeholder="trans('strings.select_courses')">
                    <option v-for="course in courses" :value="course.id" :key="course.id" :label="course.title">
                        {{ course.title }}
                    </option>
            </select>
            <has-error :form="form" field="courses"/>
        </div>
        
        <div class="form-group">
            <input class="form-control" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" 
                :placeholder="trans('strings.title')"/>
            <has-error :form="form" field="title"/>
        </div>
        
        <div class="form-group">
            <quill-editor :content="form.body"
                :options="editorOption"
                @change="onEditorChange($event)">
            </quill-editor>
            <has-error :form="form" field="body"/>
        </div>
        
        <div class="text-right">
            <a href="#" @click.prevent="cancel()" class="mr-3">{{ trans('strings.cancel') }}</a>
            <base-button :loading="form.busy" class="btn btn-danger font-12 fw-500">
                {{ trans('strings.create') }}
            </base-button>
        </div>
        
    </form>
</template>

<script>
    import Form from 'vform'
    export default {
        name: 'CourseAnnouncementCreateForm',
        props: ['courses'],
        
        data: () => ({
            editorOption: {
                placeholder: '',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ]
                }
            },
            
            form: new Form({
                title: '',
                body: '',
                courses: []
            })
        }),
        
        methods: {
            onEditorChange({ editor, html, text }) {
                this.form.body = html
            },
            create(){
                this.form.post(`/api/announcements`)
                    .then(response => {
                        this.form.reset()
                        this.$bus.$emit('announcement:created', null)
                    })
            },
            cancel(){
                this.form.reset()
                this.$bus.$emit('create_announcement:cancelled', null)
            }
            
        }
    }
</script>
