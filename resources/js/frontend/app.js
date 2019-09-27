import '../bootstrap';
import '../plugins';
import Vue from 'vue';
import store from '../store'
// dynamically load components
import './components/index';
import '../components';
import '../mixins';

window.Vue = Vue;
window.webuiPopover =  require('webui-popover')
window.moment = require('moment')
Vue.prototype.$moment = require('moment')

import { DatePicker, Switch, Checkbox, Select, Option, OptionGroup } from 'element-ui'
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'
locale.use(lang)
import 'element-ui/lib/theme-chalk/index.css'
Vue.use(DatePicker)
Vue.use(Switch)
Vue.use(Checkbox)
Vue.use(Select)
Vue.use(Option)
Vue.use(OptionGroup)

// import { TablePlugin } from 'bootstrap-vue'
// Vue.use(TablePlugin)


// credit: https://medium.com/@serhii.matrunchyk/using-laravel-localization-with-javascript-and-vuejs-23064d0c210e
//window.$trans = (string) => _.get(window.i18n, string);

// console.log(trans('auth.unknown'))
// Vue.prototype.trans = string => _.get(window.i18n, string);
Vue.prototype.trans = (string, args) => {
    let value = _.get(window.i18n, string);
    _.eachRight(args, (paramVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, paramVal);
    });
    return value;
};

const app = new Vue({
    el: '#app',
    store
});

