/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Menubar from './components/Menubar.vue';

import vuetify from './plugins/vuetify';
import store from './store';

window.Vue = require('vue');
import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    vuetify,
    store,
    router: new VueRouter(routes),
    components: {
    	Menubar
    },
    beforeCreate() {
        this.$store.dispatch("updateLoggedUser");
    }
});