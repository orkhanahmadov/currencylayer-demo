import './bootstrap'

import Vue from 'vue'
import vuetify from './plugins/vuetify'

Vue.component('currency-exchange', require('./components/CurrencyExchange.vue').default);

const app = new Vue({
    vuetify,
    el: '#app',
});
