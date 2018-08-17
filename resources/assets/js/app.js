
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

window.Vue = require('vue');

import MarcasWrapper from './components/ejecutivo/MarcasWrapperComponent';
import MarcasResume from './components/ejecutivo/MarcasResumeComponent';
import UsersComponent from './components/administrador/UsersComponent';
import ServiciosTipos from './components/administrador/ServiciosTiposComponent';
import CredencialesTipos from './components/administrador/CredencialesTiposComponent';

const app = new Vue({
    el: '#app',
    store : require('./store').default,
    components: {
        MarcasWrapper,
        MarcasResume,
        UsersComponent,
        ServiciosTipos,
        CredencialesTipos        
    }
});
