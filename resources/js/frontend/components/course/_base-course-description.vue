<template>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="course__content py-2 d-flex justify-content-between">
                <base-heading :text="trans('strings.course_description')"></base-heading>
            </div>
            <div v-html="course.description"></div>
        </div>
    </div>
    
</template>

<script>
    
    export default {
        props: ['course']
    }
</script>