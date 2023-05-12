import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from "../views/Home.vue";
import About from "../views/About.vue";
import Service from "../views/Service.vue";
import ClientArea from "../views/ClientArea.vue";
import Contact from "../views/Home.vue"
import Login from "../views/Login.vue"


Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  base: import.meta.env.BASE_URL,
  routes: [
    {
      path: "/home",
      name: "Home",
      component: Home,
    },
    {
      path: "/About",
      name: "About",
      component: About,
    },
    {
      path: "/Service",
      name: "Service",
      component: Service,
    },
    {
      path: "/ClientArea",
      name: "ClientArea",
      component: ClientArea,
    },
    {
      path: "/home",
      name: "Contact",
      component: Contact,
    },
    {
      path: "/login",
      name: "Login",
      component: Login,
    },
  ]
})

export default router
