import Vuex, { Store } from 'vuex'
import Vue from "vue";

Vue.use(Vuex)

// Create a new store instance.
const store = new Store({
  state () {
    return {
      loggedIn: false,
    }
  },
  getters: {
      getLog: (state) => state.loggedIn,
  },
  mutations: {
    increment (state) {
      state.loggedIn;
    },
  },
  actions: {

  }
})

export default store;