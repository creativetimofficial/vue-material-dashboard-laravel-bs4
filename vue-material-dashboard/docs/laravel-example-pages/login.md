# Login

The login functionality is fully implemented in our theme helping you to start your project in no time. To login into dashboard you just have to add **/login** in the URL and fill the login form with the credentials (user: **admin@jsonapi.com** and password: **secret**).

The `src\pages\Dashboard\Pages\Login.vue` is the Vue component which handles the login functinality. You can easily adapt it to your needs.

It uses the auth store located in `src\store\modules\auth.js`.

## Login card
```
<login-card header-color="green">
  <h4 slot="title" class="title">Log in</h4>
  <md-button slot="buttons" ref="#facebook" class="md-just-icon md-simple md-white">
    <i class="fab fa-facebook-square"></i>
  </md-button> 
  <md-button slot="buttons" href="#twitter" class="md-just-icon md-simple md-white">
    <i class="fab fa-twitter"></i>
  </md-button>
  <md-button slot="buttons" href="#google" class="md-just-icon md-simple md-white">
    <i class="fab fa-google-plus-g"></i>
  </md-button>
  <p slot="description" class="description">Or Be Classical</p>
  <md-field class="form-group md-invalid" slot="inputs" style="margin-bottom: 28px">
    <md-icon>email</md-icon>
    <label>Email...</label>
    <md-input v-model="email" type="email"/>
    <validation-error :errors="apiValidationErrors.email"/>
  </md-field>
  <md-field class="form-group md-invalid" slot="inputs">
    <md-icon>lock_outline</md-icon>
    <label>Password...</label>
    <md-input v-model="password" type="password"/>
  </md-field>
  <md-button slot="footer" @click="login" class="md-simple md-success md-lg">
    Lets Go
  </md-button>
</login-card>
```
