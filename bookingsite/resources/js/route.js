
import VueRouter from "vue-router";

import Bookables from "./Bookables/bookables.vue";
import Bookable from './Bookable/bookable.vue';

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
];

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history",
});

export default router;
