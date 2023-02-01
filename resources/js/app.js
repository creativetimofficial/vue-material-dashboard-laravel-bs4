/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//require('js-year-calendar');

window.Vue = require('vue');
window.axios = require('axios');
window.luxon = require("luxon");

Vue.prototype.$http = window.axios;
Vue.prototype.$csrf = document.head.querySelector('meta[name="csrf-token"]').content;

Vue.directive('can', {
	bind: function(el ,binding) {
		return window.Laravel = "auth()->user()->can('binding.value')";
	}
});
import DataTable from 'laravel-vue-datatable';
Vue.use(DataTable);

import Multiselect from 'vue-multiselect';
Vue.component('multiselect', Multiselect);

import VCalendar from 'v-calendar';

Vue.use(VCalendar, {
  locales: {
    'pt-BR': {
      firstDayOfWeek: 1,
      masks: {
        L: 'YYYY-MM-DD'
      }
    }
  }
});

import { VueCsvImportPlugin } from 'vue-csv-import';
Vue.use(VueCsvImportPlugin);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
 });
