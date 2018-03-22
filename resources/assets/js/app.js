require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Vuetify from 'vuetify';
import axios from 'axios';

import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

import VueQuillEditor from 'vue-quill-editor'

// require styles
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

window.Vue.use(VueQuillEditor, /* { default global options } */)

window.Vue.use(Vuetify)
window.Vue.use(VueAxios, axios);
window.Vue.use(VueRouter);

axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
    'ContentType':'application/json',
    'X-Requested-With': 'XMLHttpRequest',
};

import App from './components/admin/App.vue'
import router from './components/admin/routes/index.js'
import 'vuetify/dist/vuetify.min.css'

router.beforeResolve((to, from, next) => {
    axios.get('/api/v1/user/')
        .then(e => {
            next();
        })
        .catch(e => {
            window.location = '/login'
        })
})

const app = new Vue(
    {
        router,
        components: {
            app: App
        }
    }
    ).$mount('#app');