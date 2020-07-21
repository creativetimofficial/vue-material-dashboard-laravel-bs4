<template>
  <div>
    <div class="header text-center">
      <h3 class="title">Notifications</h3>
      <p class="category">
        Handcrafted by our friend
        <a target="_blank" href="https://github.com/mouse0270"
          >Robert McIntosh</a
        >. Please checkout the
        <a href="https://bootstrap-notify.remabledesigns.com/" target="_blank"
          >full documentation.</a
        >
      </p>
    </div>
    <div class="md-layout">
      <div class="md-layout-item md-size-50 md-small-size-100">
        <md-card>
          <md-card-header>
            <h4 class="title">Notifications Style</h4>
          </md-card-header>
          <md-card-content>
            <div class="alert alert-info">
              <span>This is a plain notification</span>
            </div>
            <div class="alert alert-info">
              <button type="button" aria-hidden="true" class="close">×</button>
              <span>This is a notification with close button.</span>
            </div>
            <div
              class="alert alert-info alert-with-icon"
              data-notify="container"
            >
              <button type="button" aria-hidden="true" class="close">×</button>
              <i data-notify="icon" class="material-icons">add_alert</i>
              <span data-notify="message"
                >This is a notification with close button and icon and have many
                lines. You can see that the icon and the close button are always
                vertically aligned. This is a beautiful notification. So you
                don't have to worry about the style.</span
              >
            </div>
            <div
              class="alert alert-rose alert-with-icon"
              data-notify="container"
            >
              <button type="button" aria-hidden="true" class="close">×</button>
              <i data-notify="icon" class="material-icons">add_alert</i>
              <span data-notify="message"
                >This is a notification with close button and icon and is made
                with ".alert-rose". You can see that the icon and the close
                button are always vertically aligned. This is a beautiful
                notification. So you don't have to worry about the style.</span
              >
            </div>
          </md-card-content>
        </md-card>
      </div>
      <div class="md-layout-item md-size-50 md-small-size-100">
        <md-card>
          <md-card-header>
            <h4 class="title">Notification states</h4>
          </md-card-header>

          <md-card-content>
            <div class="alert alert-info">
              <button type="button" aria-hidden="true" class="close">×</button>
              <span
                ><b> Info - </b> This is a regular notification made with
                ".alert-info"</span
              >
            </div>
            <div class="alert alert-success">
              <button type="button" aria-hidden="true" class="close">×</button>
              <span
                ><b> Success - </b> This is a regular notification made with
                ".alert-success"</span
              >
            </div>
            <div class="alert alert-warning">
              <button type="button" aria-hidden="true" class="close">×</button>
              <span
                ><b> Warning - </b> This is a regular notification made with
                ".alert-warning"</span
              >
            </div>
            <div class="alert alert-danger">
              <button type="button" aria-hidden="true" class="close">×</button>
              <span
                ><b> Danger - </b> This is a regular notification made with
                ".alert-danger"</span
              >
            </div>
            <div class="alert alert-primary">
              <button type="button" aria-hidden="true" class="close">×</button>
              <span
                ><b> Primary - </b> This is a regular notification made with
                ".alert-primary"</span
              >
            </div>
            <div class="alert alert-rose">
              <button type="button" aria-hidden="true" class="close">×</button>
              <span
                ><b> Rose - </b> This is a regular notification made with
                ".alert-rose"</span
              >
            </div>
          </md-card-content>
        </md-card>
      </div>
      <div class="md-layout-item md-size-100">
        <md-card>
          <md-card-header>
            <h4 class="title text-center">
              Notifications Places
              <p class="category">Click to view notifications</p>
            </h4>
          </md-card-header>

          <md-card-content>
            <div class="places-buttons text-center">
              <md-button class="md-success" @click="notifyVue('top', 'left')"
                >Top Left</md-button
              >
              <md-button class="md-success" @click="notifyVue('top', 'center')"
                >Top Center</md-button
              >
              <md-button class="md-success" @click="notifyVue('top', 'right')"
                >Top Right</md-button
              >
              <md-button class="md-success" @click="notifyVue('bottom', 'left')"
                >Bottom Left</md-button
              >
              <md-button
                class="md-success"
                @click="notifyVue('bottom', 'center')"
                >Bottom Center</md-button
              >
              <md-button
                class="md-success"
                @click="notifyVue('bottom', 'right')"
                >Bottom Right</md-button
              >
            </div>

          </md-card-content>
        </md-card>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  props: {
    registerImg: {
      type: String,
      default: process.env.VUE_APP_APP_BASE_URL + "/img/card-1.jpg"
    },
    applyImg: {
      type: String,
      default: process.env.VUE_APP_APP_BASE_URL + "/img/card-2.jpg"
    }
  },
  data() {
    return {
      type: ["", "info", "success", "warning", "danger"],
      notifications: {
        topCenter: false
      }
    };
  },
  methods: {
    notifyVue(verticalAlign, horizontalAlign) {
      var color = Math.floor(Math.random() * 4 + 1);
      this.$notify({
        timeout: 2500,
        message:
          "Welcome to <b>Vue Material Dashboard Pro</b> - a beautiful admin panel for every web developer.",
        icon: "add_alert",
        horizontalAlign: horizontalAlign,
        verticalAlign: verticalAlign,
        type: this.type[color]
      });
    }
  }
};
</script>
<style lang="scss">
.text-center {
  text-align: center;
}

.places-buttons + div .md-button:not(:last-child) {
  margin-right: 5px;
}
</style>
