//load dependencies
import Vue from "vue";
import VueRouter from "vue-router";
import router from "./router";
import Index from "./components/Index";
import VueAxios from "vue-axios";
import axios from "axios";
import VueMoment from "vue-moment";

require("./bootstrap");

//default Vue
window.Vue = Vue;

//load router component
Vue.router = router;
Vue.use(VueRouter);
Vue.use(VueMoment);

// Api URL
Vue.use(VueAxios, axios);
axios.defaults.baseURL = `http://localhost:8000/api`;

//load main route context
Vue.component("index", Index);

// Authentication
// Vue.use(VueA);

const app = new Vue({
    el: "#app",
    router
});
