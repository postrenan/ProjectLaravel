import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from "../views/Home.vue";
import About from "../views/About.vue";
import Service from "../views/Service.vue";
import ClientArea from "../views/ClientArea.vue";
import Contact from "../views/Home.vue";
import Login from "../views/Login.vue";
import EmailStep from "../views/EmailStep.vue";


Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  base: import.meta.env.BASE_URL,
  routes: [
    {
      path: "/",
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
      meta: {requiresAuth: true},
    },
    {
      path: "/home",
      name: "Contact",
      component: Contact,
    },
    {
      path: "/Login",
      name: "Login",
      component: Login,
    },
    {
      path: "/EmailStep",
      name: "EmailStep",
      component: EmailStep,
    },
  ]
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    next();
  } else {
    next();
  }
});
export default router
