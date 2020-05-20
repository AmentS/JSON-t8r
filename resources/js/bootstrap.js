import Vue from 'vue';
import axios from 'axios';
import VueRouter from 'vue-router';
import VueGoogleCharts from 'vue-google-charts'

Vue.use(VueGoogleCharts)


window.Vue = Vue;
window.axios = axios;
Vue.use(VueRouter);



window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

