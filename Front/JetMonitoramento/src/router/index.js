import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import ClientArea from "../views/ClientArea.vue";


Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    base: import.meta.env.BASE_URL,
    routes: [
        {
            path: "/Home",
            name: "Home",
            component: Home,
        },
        {
          path: "/ClientArea",
          name: "ClientArea",
          component: ClientArea,
        },
    ],
});

export default router;
