
import VueRouter from "vue-router";

import Bookables from "./Bookables/bookables.vue";
import Bookable from './Bookable/bookable.vue';
import Review from './review/Review.vue';
import Basket from './Basket/basket.vue';


const routes = [
    {
        path: "/",
        component: Bookables,
        name: "home",
    },
    {
       path: "/bookable/:id",
        component: Bookable,
        name: "bookable",
    },
    {
        path: "/review/:id",
        component:Review,
        name: "review",
    },
    {
        path: "/basket",
        component:Basket,
        name: "basket",
    },
    {
        path: "/auth/login",
        component:require("./auth/Login").default,
        name: "login",
    },
    {
        path: "/auth/register",
        component:require("./auth/Register").default,
        name: "register",
    }
];

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history",
});

export default router;
