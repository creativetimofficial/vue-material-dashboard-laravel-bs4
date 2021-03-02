<template>
  <form ref="password_form" @submit.prevent="changePassword">

    <md-card>

      <md-card-header class="md-card-header-icon">
        <div class="card-icon">
          <md-icon>perm_identity</md-icon>
        </div>
        <h4 class="title">
          Change Password
        </h4>
      </md-card-header>

      <md-card-content>
        <div class="md-layout">
          <div class="md-layout-item md-size-100">
            <md-field class="md-invalid">
              <label>New Password</label>
              <md-input v-model="password" type="password"/>
              <validation-error :errors="apiValidationErrors.password"/>
            </md-field>
            <md-field class="md-invalid">
              <label>Confirm New Password</label>
              <md-input v-model="password_confirmation" type="password"/>
              <validation-error :errors="apiValidationErrors.password_confirmation"/>
            </md-field>
          </div>
        </div>
      </md-card-content>

      <md-card-actions>
        <md-button type="submit">
          Change Password
        </md-button>
      </md-card-actions>
    </md-card>

  </form>
</template>

<script>
  import {ValidationError} from "@/components";
  import formMixin from "@/mixins/form-mixin";
  export default {
    name: "edit-password-card",

    props: {
      user: Object
    },

    components: {ValidationError},

    mixins: [formMixin],

    data: () => ({
      password: null,
      password_confirmation: null
    }),

    methods: {
      async changePassword() {

        if(["1", "2", "3"].includes(this.user.id)) {
          await this.$store.dispatch("alerts/error", "You are not allowed not change data of default users.")
          return
        }

        const user = {
          id: this.user.id,
          type: "users",
          password: this.password,
          password_confirmation: this.password_confirmation
        }

        try {
          await this.$store.dispatch("users/update", user)
          await this.$store.dispatch("alerts/error", "Password changed successfully.")
          this.user = await this.$store.getters["profile/me"]
          this.$refs['password_form'].reset()
        } catch (e) {
          await this.$store.dispatch("alerts/error", "Oops, something went wrong!")
          this.setApiValidation(e.response.data.errors)
        }

      }
    }
  };
</script>
