/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'
import { setupCalendar, Calendar, DatePicker } from 'v-calendar';

window.Vue = require('vue').default;


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('catalogo-vehiculo-component', require('./components/CatalogoVehiculoComponent.vue').default);
Vue.component('clientes-component', require('./components/ClientesComponent.vue').default);
Vue.component('cliente-card-component', require('./components/ClienteCardComponent.vue').default);
Vue.component('usuarios-cliente-component', require('./components/UsuariosCliente.vue').default);
Vue.component('pacientes-component', require('./components/PacientesComponent.vue').default);
Vue.component('card-paciente-component', require('./components/CardPaciente.vue').default);
Vue.component('paciente-general-component', require('./components/PacienteInfoGeneral.vue').default);
Vue.component('antecedente-patologico-heredofamiliar', require('./components/APatologicoHeredo.vue').default);
Vue.component('antecedente-patologico-personal', require('./components/APatologicoPersonal.vue').default);
Vue.component('antecedente-personal-no-patologico', require('./components/APersonalNoPatologico.vue').default);
Vue.component('tratamientos-component', require('./components/TratamiendosComponent.vue').default);
Vue.component('calendar-component', require('./components/CalendarComponent.vue').default);
Vue.component('odontograma-component', require('./components/OdontogramaComponent.vue').default);
Vue.component('endodoncia-component', require('./components/EndodonciaComponent.vue').default);
Vue.component('calendario-general-component', require('./components/CalendarioGeneralComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(VueGoodTablePlugin);
Vue.component('v-calendar', Calendar);
Vue.component('v-date-picker', DatePicker);
const app = new Vue({
    el: '#app',
});