/*********** GLOBAL APP */
var App = Object.freeze({
  name: 'My App',
  version: '2.1.4',
  helpers: {
    trans: (string) => _.get(window.i18n, string),
    // This is a purely functional version of
    // the $reverseText method we saw earlier
    reverseText: function(text) {
      return text
        .split('')
        .reverse()
        .join('')
    }
  }
})
//console.log(App.helpers.trans('strings.cancel'));

/******************** */
import Vue from 'vue'

import StarRating from 'vue-star-rating'
Vue.component('star-rating', StarRating)

Vue.component('pagination', require('laravel-vue-pagination'))

import ToggleButton from 'vue-js-toggle-button'
Vue.use(ToggleButton)

import VueClipboard from 'vue-clipboard2'
Vue.use(VueClipboard)

import {ServerTable, ClientTable, Event} from 'vue-tables-2'

Vue.use(ClientTable, {
  texts:{
    //count:"Showing {from} to {to} of {count} records|{count} records|One record",
    count: '',
    first: App.helpers.trans('strings.first'),
    last: App.helpers.trans('strings.last'), //'Last',
    filter: App.helpers.trans('strings.filters'), //"Filter:",
    filterPlaceholder: App.helpers.trans('strings.search'), //"Search...",
    limit: App.helpers.trans('strings.records'), //"Records:",
    page: App.helpers.trans('strings.page'), //"Page:",
    noResults: App.helpers.trans('strings.no_matching_records'), //"No matching entries",
    //filterBy: App.helpers.trans('strings.filter_by_column'), //"Filter by {column}",
    loading: App.helpers.trans('strings.loading'), //'Loading...',
    //defaultOption: 'Select {column}',
    columns: App.helpers.trans('strings.columns'), //'Columns'
  },
  filterable: false,
  sortIcon: {
    base:'fa', 
    up:'fa-sort-up', 
    down:'fa-sort-down', 
    is: 'fa-sort' 
  },
  filterByColumn:false,
  sendEmptyFilters: false,
  pagination: { 
      chunk:2, 
      dropdown: false,
      edge: false
  },
  texts:{
      filter: "",
      limit: ""
  },
  perPage:10,
  perPageValues:[5,10,25,50,100],
  footerHeadings: false,
  columnsDropdown: false,
  skin: 'table table-responsive-sm table-stripedx table-outline table-md',
}, false, 'bootstrap4', 'default')




Vue.use(ServerTable, {
  texts:{
    //count:"Showing {from} to {to} of {count} records|{count} records|One record",
    count: '',
    first: App.helpers.trans('strings.first'),
    last: App.helpers.trans('strings.last'), //'Last',
    filter: App.helpers.trans('strings.filters'), //"Filter:",
    filterPlaceholder: App.helpers.trans('strings.search'), //"Search...",
    limit: App.helpers.trans('strings.records'), //"Records:",
    page: App.helpers.trans('strings.page'), //"Page:",
    noResults: App.helpers.trans('strings.no_matching_records'), //"No matching entries",
    //filterBy: App.helpers.trans('strings.filter_by_column'), //"Filter by {column}",
    loading: App.helpers.trans('strings.loading'), //'Loading...',
    //defaultOption: 'Select {column}',
    columns: App.helpers.trans('strings.columns'), //'Columns'
  },
  filterable: false,
  sortIcon: {
    base:'fa', 
    up:'fa-sort-up', 
    down:'fa-sort-down', 
    is: 'fa-sort' 
  },
  filterByColumn:false,
  sendEmptyFilters: false,
  pagination: { 
      chunk:2, 
      dropdown: false,
      edge: false
  },
  perPage:10,
  perPageValues:[],
  //perPageValues:[5,10,25,50,100],
  footerHeadings: false,
  columnsDropdown: false,
  skin: 'table table-responsive-sm table-bordered table-outline table-md',
  requestAdapter(data) {
    return {
        page: data.page,
        sort: data.orderBy ? data.orderBy : 'created_at',
        direction: data.ascending ? 'desc' : 'asc',
        query: data.query,
        limit: data.limit
    }
  },

  responseAdapter({data}) {
    return {
        data: data.data,
        count: data.meta.total
    }
  },
}, false, 'bootstrap4', 'footerPagination')

import VuejsDialog from 'vuejs-dialog'
import 'vuejs-dialog/dist/vuejs-dialog.min.css'
Vue.use(VuejsDialog)

import VueAutosize from 'vue-autosize'
Vue.use(VueAutosize)


import Draggable from 'vuedraggable'
Vue.component('draggable', Draggable)


import FileUpload from 'v-file-upload'
Vue.component('file-upload', FileUpload)

import VueTagsInput from '@johmun/vue-tags-input';
Vue.component('vue-tags-input', VueTagsInput)


import AvatarCropper from "vue-avatar-cropper"
Vue.component('avatar-cropper', AvatarCropper)

import VueChartkick from 'vue-chartkick'
import Chart from 'chart.js'
Vue.use(VueChartkick, {adapter: Chart})


import VueElementLoading from 'vue-element-loading'
Vue.component('VueElementLoading', {
    extends: VueElementLoading,
    props: {
      size: {
        type: String,
        default: '40'
      },
      spinner: {
        type: String,
        default: 'spinner'
      },
      color: {
        type: String,
        default: '#FF6700'
      },
      backgroundColor: {
        type: String,
        default: 'rgba(255, 255, 255, .5)'
      }
    }
})

import Vue2Filters from 'vue2-filters'
Vue.use(Vue2Filters)

import { HasError, AlertError, AlertErrors, AlertSuccess } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)


import VueQuillEditor from 'vue-quill-editor'
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
Vue.use(VueQuillEditor)

const bus = {}
bus.install = function (Vue) {
  Vue.prototype.$bus = new Vue()
}
Vue.use(bus)



