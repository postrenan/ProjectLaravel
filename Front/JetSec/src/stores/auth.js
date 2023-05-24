import { defineStore } from 'pinia'

export const useAuthStore = defineStore({
  state: () => ({
    isLoggedIn: false,
  }),
  actions: {
    login(){
      this.isLoggedIn = true;
    },
    logout(){

      this.isLoggedIn = false;
    }
  }
})
