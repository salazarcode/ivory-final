
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('users-component', require('./components/administrador/UsersComponent.vue'));
Vue.component('servicios-tipos', require('./components/administrador/ServiciosTiposComponent.vue'));
Vue.component('credenciales-tipos', require('./components/administrador/CredencialesTiposComponent.vue'));
Vue.component('marcas-wrapper', require('./components/ejecutivo/MarcasWrapperComponent.vue'));
Vue.component('marcas-single', require('./components/ejecutivo/MarcasSingleComponent.vue'));

const app = new Vue({
    el: '#app',
    store : require('./store').default
});
