<template>
  <div class="notifications">
    <transition-group name="list" mode="in-out">
      <notification
        v-for="notification in notifications"
        :key="notification.timestamp.getTime()"
        :message="notification.message"
        :icon="notification.icon"
        :type="notification.type"
        :timeout="notification.timeout"
        :timestamp="notification.timestamp"
        :vertical-align="notification.verticalAlign"
        :horizontal-align="notification.horizontalAlign"
        @on-close="removeNotification"
      >
      </notification>
    </transition-group>
  </div>
</template>
<script>
import Notification from "./Notification.vue";
export default {
  components: {
    Notification
  },
  data() {
    return {
      notifications: this.$notifications.state
    };
  },
  methods: {
    removeNotification(timestamp) {
      this.$notifications.removeNotification(timestamp);
    }
  }
};
</script>
<style lang="scss">
.notifications {
  .list-move {
    transition: transform 0.3s, opacity 0.4s;
  }
  .list-item {
    display: inline-block;
    margin-right: 10px;
  }
  .list-enter-active {
    transition: transform 0.2s ease-in, opacity 0.4s ease-in;
  }
  .list-leave-active {
    transition: transform 1s ease-out, opacity 0.4s ease-out;
  }

  .list-enter {
    opacity: 0;
    transform: scale(1.1);
  }
  .list-leave-to {
    opacity: 0;
    transform: scale(1.2, 0.7);
  }
}
</style>
