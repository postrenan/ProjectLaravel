import Vue from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import './assets/main.css'
import store from './stores/auth';
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'

new Vue({
  store,
  router,
  pinia: createPinia(),
  render: (h) => h(App),
}).$mount('#app')
