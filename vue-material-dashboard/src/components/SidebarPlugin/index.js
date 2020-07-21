import Sidebar from "./SideBar.vue";
import SidebarItem from "./SidebarItem.vue";

const SidebarStore = {
  showSidebar: false,
  sidebarLinks: [],
  linksStore: [],
  isMinimized: false,
  displaySidebar(value) {
    this.showSidebar = value;
  },
  toggleMinimize() {
    document.body.classList.toggle("sidebar-mini");
    // we simulate the window Resize so the charts will get updated in realtime.
    const simulateWindowResize = setInterval(() => {
      window.dispatchEvent(new Event("resize"));
    }, 180);

    // we stop the simulation of Window Resize after the animations are completed
    setTimeout(() => {
      clearInterval(simulateWindowResize);
    }, 1000);

    this.isMinimized = !this.isMinimized;
  },
  addSidebarLink(link) {
    this.linksStore.push(link);
  },
  removeSidebarLink(link) {
    const index = this.sidebarLinks.indexOf(this);
    this.linksStore.splice(index, 1);
  },
  collapseAllMenus() {
    this.linksStore.forEach(link => {
      link.collapsed = true;
    });
  }
};

const SidebarPlugin = {
  install(Vue, options) {
    if (options && options.sidebarLinks) {
      SidebarStore.sidebarLinks = options.sidebarLinks;
    }
    Vue.mixin({
      data() {
        return {
          sidebarStore: SidebarStore
        };
      }
    });

    Object.defineProperty(Vue.prototype, "$sidebar", {
      get() {
        return this.$root.sidebarStore;
      }
    });
    Vue.component("side-bar", Sidebar);
    Vue.component("sidebar-item", SidebarItem);
  }
};

export default SidebarPlugin;
