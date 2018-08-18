
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

window.Vue = require('vue');

import Marcas from './components/ejecutivo/MarcasComponent';
import MarcasResume from './components/ejecutivo/MarcasResumeComponent';
import UsersComponent from './components/administrador/UsersComponent';
import ServiciosTipos from './components/administrador/ServiciosTiposComponent';
import CredencialesTipos from './components/administrador/CredencialesTiposComponent';

const app = new Vue({
    el: '#app',
    store : require('./store').default,
    components: {
        Marcas,
        MarcasResume,
        UsersComponent,
        ServiciosTipos,
        CredencialesTipos
    }
});
