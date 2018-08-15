
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


import MarcasWrapper from './components/ejecutivo/MarcasWrapperComponent';
import ExampleCompo from './components/ejecutivo/ExampleCompo';
import UsersComponent from './components/administrador/UsersComponent';
import ServiciosTiposComponent from './components/administrador/ServiciosTiposComponent';
import CredencialesTiposComponent from './components/administrador/CredencialesTiposComponent';

const app = new Vue({
    el: '#app',
    store : require('./store').default,
    components: {
        MarcasWrapper,
        ExampleCompo,
        UsersComponent,
        ServiciosTiposComponent,
        CredencialesTiposComponent        
    }
});
