<template>
  <span v-if="errors && errors.length">
    <small class="md-error" v-text="errors[0]"/>
  </span>
</template>

<script>
  export default {
    props: {
      errors: {
        type: Array,
        default: () => ([])
      }
    }
  }
</script>

<style lang="scss">
  .md-field {
    .md-error {
      bottom: -8px;
    }
  }
</style>
