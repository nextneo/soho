import 'core-js/stable'
import Vue from 'vue'
import App from './App'
import router from './router'
import CoreuiVue from '@coreui/vue'
import {
    iconsSet as icons
} from './assets/icons/icons.js'
import store from './store'
import CKEditor from 'ckeditor4-vue'

Vue.prototype.$apiAdress = 'http://localhost'
Vue.config.performance = true
Vue.use(CoreuiVue)
Vue.use(CKEditor)

new Vue({
    el: '#app',
    router,
    store,
    icons,
    template: '<App/>',
    components: {
        App
    },
})