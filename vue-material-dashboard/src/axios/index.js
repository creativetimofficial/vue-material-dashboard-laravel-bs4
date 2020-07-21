import Vue from "vue";
import VueAxios from "vue-axios";

import axios from "axios";

import {VueAuthenticate} from "vue-authenticate";

Vue.use(VueAxios, axios);

const vueAuth = new VueAuthenticate(Vue.prototype.$http, {
  baseUrl: process.env.VUE_APP_API_BASE_URL,
  tokenName: "access_token",
  loginUrl: "/login",
  registerUrl: "/register"
});