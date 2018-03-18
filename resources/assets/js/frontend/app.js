require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Vuetify from 'vuetify';
import axios from 'axios';

window.Vue.use(Vuetify)
window.Vue.use(VueAxios, axios);
window.Vue.use(VueRouter);

axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
    'X-Requested-With': 'XMLHttpRequest',
};




// import App from './components/admin/App.vue'
// import router from './components/admin/routes/index.js'

const app = new Vue(
    {
        router,
        components: {
            // app: App
        }
    }
    ).$mount('#app');