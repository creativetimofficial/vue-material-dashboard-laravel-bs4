<template>
  <form @submit.prevent="updateProfile">
    <md-card>

      <md-card-header class="md-card-header-icon">
        <div class="card-icon">
          <md-icon>perm_identity</md-icon>
        </div>
        <h4 class="title">
          Edit Profile
        </h4>
      </md-card-header>

      <md-card-content>

        <div class="md-layout">
          <label class="md-layout-item md-size-15 md-form-label">
            Name
          </label>
          <div class="md-layout-item">
            <md-field class="md-invalid">
              <md-input v-model="user.name"/>
              <validation-error :errors="apiValidationErrors.name"/>
            </md-field>
          </div>
        </div>

        <div class="md-layout">
          <label class="md-layout-item md-size-15 md-form-label">
            Email
          </label>
          <div class="md-layout-item">
            <md-field class="md-invalid">
              <md-input v-model="user.email"/>
              <validation-error :errors="apiValidationErrors.email"/>
            </md-field>
          </div>
        </div>

      </md-card-content>

      <md-card-actions>
        <md-button type="submit">
          Update Profile
        </md-button>
      </md-card-actions>

    </md-card>
  </form>
</template>
<script>
  import {ValidationError} from "@/components";
  import formMixin from "@/mixins/form-mixin";

  export default {
    name: "edit-profile-card",

    props: {
      user: Object
    },

    components: {ValidationError},

    mixins: [formMixin],

    data() {
      return {
        default_img: process.env.VUE_APP_APP_BASE_URL + "/img/placeholder.jpg",
      }
    },

    methods: {
      async updateProfile() {
        if(["1", "2", "3"].includes(this.user.id)) {
          await this.$store.dispatch("alerts/error", "You are not allowed not change data of default users.")
          return
        }

        try {
          await this.$store.dispatch("profile/update", this.user)
          await this.$store.dispatch("alerts/success", "Profile updated successfully.")
          await this.$store.getters["profile/me"]
        } catch (e) {
          await this.$store.dispatch("alerts/error", "Oops, something went wrong!")
          this.setApiValidation(e.response.data.errors)
        }
      }

    }
  };
</script>

<style></style>
