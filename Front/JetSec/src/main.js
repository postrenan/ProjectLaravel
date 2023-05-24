import Vue from 'vue'
import Vuex from 'vuex';
import { createPinia, PiniaVuePlugin } from 'pinia'
import App from './App.vue'
import router from './router'
import './assets/main.css'
import store from './stores/auth';

new Vue({
  store,
  router,
  pinia: createPinia(),
  render: (h) => h(App)
}).$mount('#app')
