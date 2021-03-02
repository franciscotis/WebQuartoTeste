import Vue from 'vue'
import router from './router';
import App from './vue/App';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import {faMapMarkerAlt, faPlusSquare} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import * as VueGoogleMaps from 'vue2-google-maps'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import '../sass/app.scss'
import credentials from './util/credentials.json';

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueGoogleMaps, {
    load: {
        key: credentials.apiKey,
    },
    installComponents: true
})

window.axios = require('axios');

library.add(faPlusSquare,faMapMarkerAlt)
Vue.component('font-awesome-icon', FontAwesomeIcon)


const app = new Vue({
    el: '#app',
    render: h => h(App),
    router


});


