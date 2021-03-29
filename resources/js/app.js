require('./bootstrap');
import common from './common';
Vue.mixin(common);



window.Vue = require('vue');
import Vue from 'vue'
import VueI18n from 'vue-i18n'
import i18n from './i18n';
Vue.use(require('vue-moment'));
Vue.use(VueI18n)

import JsonCSV from 'vue-json-csv'
Vue.component('downloadCsv', JsonCSV)

import * as VueGoogleMaps from 'vue2-google-maps'
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDfryPX4WzD2zaOpUtE5O-CLnZUC3ZLb3U',
        libraries: 'places',
    },
    installComponents: true
})
import vuetify from './plugins/vuetify'

let userType = window.authUser.type
router.beforeEach((to, from, next) => {
	//document.title=to.meta.title
   
    if(to.meta){
        let allowed = to.meta.type
        for(let a of allowed){
            if(a==userType){
                next();
            }
        }
    }
    return
    
  
  });
router.afterEach((to, from) => {
    Vue.nextTick(() => {
        document.title = to.meta.title ? to.meta.title : 'Salwagarden Title';
    });
})

Vue.component('z-dashboard', require('./components/dashboard.vue').default);

import router from './router'
import store from './store'

const app = new Vue({
    el: '#app',
    vuetify,
    i18n,
    router,
    store: store,
});