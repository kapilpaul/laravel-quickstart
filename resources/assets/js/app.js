/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require("./bootstrap");
window.Vue = require("vue");
import axios from "axios";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

console.log(
  "%c Developed by Kapil",
  "background-color:#333;padding:20px;color:#fff;border-radius:4px"
);

axios.defaults.baseURL = process.env.MIX_APP_URL;

axios.interceptors.response.use(
  function(response) {
    return response;
  },
  function(error) {
    store.dispatch("setSubmitted", false);
    store.dispatch("setValidationErrors", error.response.data);
    throw error.response;
  }
);

import { store } from "./store/index";

const app = new Vue({
  el: "#app",
  store,
  components: {
  }
});
