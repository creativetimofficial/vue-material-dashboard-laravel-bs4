import DropDown from "./components/Dropdown.vue";
import { ValidationProvider } from "vee-validate";
import { ValidationObserver } from "vee-validate";
import {
  CollapseTransition,
  SlideYDownTransition,
  FadeTransition,
  ZoomCenterTransition
} from "../node_modules/vue2-transitions";
/**
 * You can register global components here and use them as a plugin in your main Vue instance
 */

const GlobalComponents = {
  install(Vue) {
    Vue.component("drop-down", DropDown);
    Vue.component("ValidationProvider", ValidationProvider);
    Vue.component("ValidationObserver", ValidationObserver);
    Vue.component("CollapseTransition", CollapseTransition);
    Vue.component("SlideYDownTransition", SlideYDownTransition);
    Vue.component("FadeTransition", FadeTransition);
    Vue.component("ZoomCenterTransition", ZoomCenterTransition);
  }
};

export default GlobalComponents;
