require('./bootstrap');

window.Vue = require('vue');

import moment from 'moment';
import { Form, HasError, AlertError } from 'vform';
import VueProgressBar from 'vue-progressbar';

import Gate from './Gate';
Vue.prototype.$gate = new Gate(window.user);

import swal from 'sweetalert2';
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

window.form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import VoerroTagsInput from '@voerro/vue-tagsinput';

Vue.component('tags-input', VoerroTagsInput);

import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );

import VueRouter from 'vue-router';
Vue.use(VueRouter);

let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/proposal', component: require('./components/Proposal.vue').default },
    { path: '/project/create', component: require('./components/CreateProject.vue').default },
    { path: '/projects', component: require('./components/Projects.vue').default },
    { path: '/project/:slug', component: require('./components/Project.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.filter('strDate', (date) => {
    return moment(date).format('MMMM Do YYYY');
});

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
});


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('not-found', require('./components/NotFound.vue').default);
Vue.component('vue-table', require('./components/TableComponents/Table.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));


const app = new Vue({
    el: '#app',
    router,
    data() {
        return {
            search: ''
        }
    },
    methods: {
        searching() {
            this.$emit('searching');
        }
    }
});

window.Fire = new Vue();
