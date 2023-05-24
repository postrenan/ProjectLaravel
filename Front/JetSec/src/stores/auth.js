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
      getLoggedIn: (state) => state.loggedIn,
  },
  mutations: {
    setLoggedIn (state, value) {
      state.loggedIn = value;
    },
  },
  actions: {

  }
})

export default store;