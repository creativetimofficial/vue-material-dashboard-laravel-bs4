// Notifications plugin. Used on Notifications page
import Notifications from "@/components/NotificationPlugin";
// A plugin file where you could register global components used across the app
import GlobalComponents from "./globalComponents";
// A plugin file where you could register global directives
import GlobalDirectives from "./globalDirectives";
// Sidebar on the right. Used as a local plugin in DashboardLayout.vue
import SideBar from "./components/SidebarPlugin";
// Tabs plugin. Used on Panels page.

import VueMaterial from "vue-material";

// asset imports
import "vue-material/dist/vue-material.min.css";
import "./assets/scss/material-dashboard.scss";
import "./assets/css/demo.css";

// library auto imports
import "es6-promise/auto";

export default {
  install(Vue) {
    Vue.use(GlobalComponents);
    Vue.use(GlobalDirectives);
    Vue.use(VueMaterial);
    Vue.use(SideBar);
    Vue.use(Notifications);
  }
};
