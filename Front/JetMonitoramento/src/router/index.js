import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../components/Home.vue";


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
            path: "/About",
            name: "About",
            component: About,
        },
        {
            path: "/Blog",
            name: "Blog",
            component: Blog,
        },
        {
            path: "/Service",
            name: "Service",
            component: Service,
        },
        {
            path: "/Contact",
            name: "Contact",
            component: Contact,
        },
        {
            path: "/ClientArea",
            name: "ClientArea",
            component: ClientArea,
        },
    ],
});

export default router;
