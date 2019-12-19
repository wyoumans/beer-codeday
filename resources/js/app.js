/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

// libraries
import Vue from "vue";
import VueRouter from "vue-router";
import VueProgressBar from "vue-progressbar";

const progressBarOptions = {
    color: "#2c5282",
    failedColor: "red",
    thickness: "4px"
};

Vue.use(VueRouter);
Vue.use(VueProgressBar, progressBarOptions);

// public components
import Home from "./components/Home";
import Beers from "./components/Beers";
import BeerDetails from "./components/BeerDetails";

// router
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/beers",
            name: "beers",
            component: Beers
        },
        {
            path: "/beers/:id",
            name: "beer-details",
            component: BeerDetails
        }
    ]
});

// the vue app
const app = new Vue({
    el: "#app",
    router
});
