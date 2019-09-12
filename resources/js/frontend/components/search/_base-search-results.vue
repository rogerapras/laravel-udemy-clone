<template>
    <div>
        <vue-element-loading :active="loading" :is-full-screen="false" spinner="bar-fade-scale"/>
        
        <template v-if="!loading">
            <div v-if="courses.length > 0">
                <list-item v-for="course in courses" :course="course" :key="course.uuid" />
            </div>
            <div v-else>
                <p>{{ trans('strings.no_search_results') }}</p>
            </div>
        </template>
        
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import ListItem from './imports/_search_course_list_item'
    
    export default {
        components: {
            ListItem
        },
        computed: {
            ...mapGetters({
                loading: 'search/loading',
                courses: 'search/courses'
            })
        },
    }
    
</script>