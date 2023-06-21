import Vuex, { Store } from 'vuex'
import Vue from "vue";

Vue.use(Vuex)

const store = new Store({
  state () {
    return {
      loggedIn: false,
      user: { id: 9999, name: 'random' },
    }
  },
  getters: {
      getLoggedIn: (state) => state.loggedIn,
      getUser: (state) => state.user,
  },
  mutations: {
    setLoggedIn (state, value) {
      state.loggedIn = value;
    },
    setUser(state, user) {
      state.user = { id: 9999, name: 'random' };
    },
  },
})

export default store;