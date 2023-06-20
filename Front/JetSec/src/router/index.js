import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from "../views/Home.vue";
import About from "../views/About.vue";
import Service from "../views/Service.vue";
import ClientArea from "../views/ClientArea.vue";
import Contact from "../views/Home.vue";
import Login from "../views/Login.vue";
import RestrictArea from "@/views/RestrictArea.vue";
import Blog from "../views/Blog.vue"
import post from "@/views/Post.vue"

Vue.use(VueRouter);

const router = new VueRouter({
  mode: "history",
  base: import.meta.env.BASE_URL,
  routes: [
    {
      path: "/",
      name: "Home",
      component: Home,
    },
    {
      path: "/about",
      name: "About",
      component: About,
    },
    {
      path: "/service",
      name: "Service",
      component: Service,
    },
    {
      path: "/client-area",
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
      path: "/login",
      name: "Login",
      component: Login,
    },
    {
      path: "/restrict-area",
      name: "RestrictArea",
      component: RestrictArea,
    },
    {
      path: "/blog",
      name: "Blog",
      component: Blog,
      meta: {
        hideHeader: true
      },
    },
    {
      path:"/post/:slug",
      name:'post',
      component: post,
      props: true
    },
  ]
});

export default router
