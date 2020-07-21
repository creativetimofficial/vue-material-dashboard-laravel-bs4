<template>
  <a :class="class" @click="logout()">
    <slot></slot>
  </a>
</template>
<script>
export default {
  name: "log-out",
  props: {
    class: String
  },
  methods: {
    logout() {
      this.$store.logout();
    }
  }
};
</script>
