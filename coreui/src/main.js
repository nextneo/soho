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

import {
    library
} from '@fortawesome/fontawesome-svg-core'
import {
    faUserSecret
} from '@fortawesome/free-solid-svg-icons'
import {
    FontAwesomeIcon
} from '@fortawesome/vue-fontawesome'
library.add(faUserSecret)

import {
    BootstrapVue,
    IconsPlugin
} from 'bootstrap-vue'

import VueLazyload from 'vue-lazyload'
// Import Bootstrap an BootstrapVue CSS files (order is important)
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.prototype.$apiAdress = 'http://127.0.0.1'
Vue.config.performance = true
Vue.use(CoreuiVue)
Vue.use(CKEditor)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueLazyload)
Vue.component('font-awesome-icon', FontAwesomeIcon)

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