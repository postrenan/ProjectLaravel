import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from "../views/Home.vue";
import About from "../views/About.vue";
import Service from "../views/Service.vue";
import ClientArea from "../views/ClientArea.vue";
import Contact from "../views/Home.vue";
import Login from "../views/Login.vue";
import EmailStep from "../views/EmailStep.vue";
import RestrictArea from "@/views/RestrictArea.vue";
import Crud from "@/views/Crud.vue";
import Blog from "../views/Blog.vue"
import BlogManager from "@/views/BlogManager.vue";

import Cookies from 'js-cookie'
import axios from 'axios';

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
      meta: {requiresAuth: true,
          hideHeader: true
      },
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
    {
      path: "/RestrictArea",
      name: "RestrictArea",
      component: RestrictArea,
    },
    {
      path: "/Crud",
      name: "Crud",
      component: Crud,
      meta: {
        requiresAuth: true,
        hideHeader: true
      },
    },
    {
      path: "/Blog",
      name: "Blog",
      component: Blog,
      meta: {
        hideHeader: true
      },
    },
    {
      path: "/BlogManager",
      name:"BlogManager",
      component: BlogManager,
      meta: {
        hideHeader: true
      },
    }
  ]
});



// router.beforeEach((to, from, next) => {
// axios.get('/http://127.0.0.1:8000/api/validateLogin')
//   if (to.meta.requiresAuth) {
//     if () {
//       return next('/ClientArea');
//     } else if (!Cookies.get('api_token')) {
//       return next({name: '/Login'});
//     }
//   }
//   next();
// });
export default router
