<template>
  <component
    :is="baseComponent"
    :to="link.path ? link.path : '/'"
    :class="{ active: isActive }"
    tag="li"
  >
    <a
      v-if="isMenu"
      href="#"
      class="nav-link sidebar-menu-item"
      :aria-expanded="!collapsed"
      data-toggle="collapse"
      @click.prevent="collapseMenu"
    >
      <md-icon v-if="link.icon">{{ link.icon }}</md-icon>
      <md-icon v-if="link.image">
      <md-avatar style="height: auto; width: auto; min-width: auto">
        <img :src="link.image" alt="Avatar">
      </md-avatar>
      </md-icon>
      <p>
        {{ link.name }}
        <b class="caret"></b>
      </p>
    </a>

    <collapse-transition>
      <div v-if="$slots.default || this.isMenu" v-show="!collapsed">
        <ul class="nav">
          <slot></slot>
        </ul>
      </div>
    </collapse-transition>

    <slot
      name="title"
      v-if="children.length === 0 && !$slots.default && link.path"
    >
      <component
        :to="link.path"
        @click.native="linkClick"
        :is="elementType(link, false)"
        :class="{ active: link.active }"
        class="nav-link"
        :target="link.target"
        :href="link.path"
      >
        <template v-if="addLink">
          <span class="sidebar-mini">{{ linkPrefix }}</span>
          <span class="sidebar-normal">{{ link.name }}</span>
        </template>
        <template v-else>
          <md-icon>{{ link.icon }}</md-icon>
          <p>{{ link.name }}</p>
        </template>
      </component>
    </slot>
  </component>
</template>
<script>
export default {
  name: "sidebar-item",
  props: {
    menu: {
      type: Boolean,
      default: false
    },
    opened: {
      type: Boolean,
      default: false
    },
    link: {
      type: Object,
      default: () => {
        return {
          name: "",
          icon: "",
          image: "",
          path: "",
          children: []
        };
      }
    }
  },
  provide() {
    return {
      addLink: this.addChild,
      removeLink: this.removeChild
    };
  },
  inject: {
    addLink: { default: null },
    removeLink: { default: null },
    autoClose: {
      default: true
    }
  },
  data() {
    return {
      children: [],
      collapsed: !this.opened
    };
  },
  computed: {
    baseComponent() {
      return this.isMenu || this.link.isRoute ? "li" : "router-link";
    },
    linkPrefix() {
      if (this.link.name) {
        let words = this.link.name.split(" ");
        return words.map(word => word.substring(0, 1)).join("");
      }
      return false;
    },
    isMenu() {
      return this.children.length > 0 || this.menu === true;
    },
    isActive() {
      if (this.$route && this.$route.path) {
        let matchingRoute = this.children.find(c =>
          this.$route.path.startsWith(c.link.path)
        );
        if (matchingRoute !== undefined) {
          return true;
        }
      }
      return false;
    }
  },
  methods: {
    addChild(item) {
      const index = this.$slots.default.indexOf(item.$vnode);
      this.children.splice(index, 0, item);
    },
    removeChild(item) {
      const tabs = this.children;
      const index = tabs.indexOf(item);
      tabs.splice(index, 1);
    },
    elementType(link, isParent = true) {
      if (link.isRoute === false) {
        return isParent ? "li" : "a";
      } else {
        return "router-link";
      }
    },
    linkAbbreviation(name) {
      const matches = name.match(/\b(\w)/g);
      return matches.join("");
    },
    linkClick() {
      if (!this.addLink) {
        this.$sidebar.collapseAllMenus();
      }

      if (
        this.autoClose &&
        this.$sidebar &&
        this.$sidebar.showSidebar === true
      ) {
        this.$sidebar.displaySidebar(false);
      }
    },
    collapseMenu() {
      if (this.collapsed) {
        this.$sidebar.addSidebarLink(this);
        this.$sidebar.collapseAllMenus();
      }

      this.collapsed = !this.collapsed;
    },
    collapseSubMenu(link) {
      link.collapsed = !link.collapsed;
    }
  },
  mounted() {
    if (this.addLink) {
      this.addLink(this);
    }
    if (this.link.collapsed !== undefined) {
      this.collapsed = this.link.collapsed;
    }
    if (this.isActive && this.isMenu) {
      this.collapsed = false;
    }
  },
  destroyed() {
    this.$sidebar.removeSidebarLink(this);
    if (this.$el && this.$el.parentNode) {
      this.$el.parentNode.removeChild(this.$el);
    }
    if (this.removeLink) {
      this.removeLink(this);
    }
  }
};
</script>
<style>
.sidebar-menu-item {
  cursor: pointer;
}
</style>
