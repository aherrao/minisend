
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./main');

window.Vue = require('vue');

import Vuex from 'vuex';
import VeeValidate from 'vee-validate';
import Toasted from 'vue-toasted';
import VueGoodTablePlugin from 'vue-good-table';
import VuejsPaginate from 'vuejs-paginate';
import Treeselect from '@riophae/vue-treeselect';
import Datepicker from 'vuejs-datepicker';
import VueTrix from "vue-trix";
import Chart from 'chart.js';

/** fontawesome - start */

import { library } from '@fortawesome/fontawesome-svg-core'
import { faCoffee } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faCoffee)
Vue.component('font-awesome-icon', FontAwesomeIcon)

/** fontawesome - end */

// import the styles 
import 'vue-good-table/dist/vue-good-table.css'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'

Vue.use(Vuex)
Vue.use(VeeValidate);
Vue.use(Toasted)
Vue.use(VueGoodTablePlugin);
Vue.component('paginate', VuejsPaginate);
Vue.component('treeselect', Treeselect);
Vue.component('datepicker', Datepicker);
Vue.component('vueTrix', VueTrix);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//Project
Vue.component('project-index', require('./components/clients/projects/Index.vue').default);
Vue.component('project-create', require('./components/clients/projects/Create.vue').default);
Vue.component('project-show', require('./components/clients/projects/Show.vue').default);

//Sprint
Vue.component('sprint-index', require('./components/clients/sprints/Index.vue').default);
Vue.component('sprint-create', require('./components/clients/sprints/Create.vue').default);
Vue.component('sprint-show', require('./components/clients/sprints/Show.vue').default);

//Task
Vue.component('task-index', require('./components/clients/tasks/Index.vue').default);
Vue.component('task-create', require('./components/clients/tasks/Create.vue').default);
Vue.component('task-show', require('./components/clients/tasks/Show.vue').default);

//Task
Vue.component('user-index', require('./components/clients/users/Index.vue').default);
Vue.component('user-create', require('./components/clients/users/Create.vue').default);
Vue.component('user-show', require('./components/clients/users/Show.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
