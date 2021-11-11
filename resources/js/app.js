require('./bootstrap');

window.Vue = require('vue').default;

import VueCookies from 'vue-cookies'
window.Vue.use(VueCookies)


const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = new Vue({
    el: '#app',
});
