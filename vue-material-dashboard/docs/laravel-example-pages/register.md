# Register

The register functionality is fully implemented in our theme helping you to start your project in no time. To register a new user you just have to add **/register** in the URL or click on register link from login page and fill the register form with user details.

The `src\pages\Dashboard\Pages\Register.vue` is the Vue component which handles the login functinality. You can easily extend it to your needs.

It uses the auth store located in `src\store\modules\auth.js`.

## Register card
```
<signup-card>
    <h2 class="title text-center" slot="title">Register</h2>
    <div
        class="md-layout-item md-size-50 md-medium-size-50 md-small-size-100 ml-auto"
        slot="content-left"
    >
        <div
        class="info info-horizontal"
        v-for="item in contentLeft"
        :key="item.title"
        >
        <div :class="`icon ${item.colorIcon}`">
            <md-icon>{{ item.icon }}</md-icon>
        </div>
        <div class="description">
            <h4 class="info-title">{{ item.title }}</h4>
            <p class="description">
            {{ item.description }}
            </p>
        </div>
        </div>
    </div>
    <div
        class="md-layout-item md-size-50 md-medium-size-50 md-small-size-100 mr-auto"
        slot="content-right"
    >
        <div class="social-line text-center">
        <md-button class="md-just-icon md-round md-twitter">
            <i class="fab fa-twitter"></i>
        </md-button>
        <md-button class="md-just-icon md-round md-dribbble">
            <i class="fab fa-dribbble"></i>
        </md-button>
        <md-button class="md-just-icon md-round md-facebook">
            <i class="fab fa-facebook-f"></i>
        </md-button>
        <h4 class="mt-3">or be classical</h4>
        </div>

        <md-field class="md-form-group md-invalid" style="margin-bottom: 2rem">
        <md-icon>face</md-icon>
        <label>Name</label>
        <md-input v-model="name"/>
        <validation-error :errors="apiValidationErrors.name"/>
        </md-field>

        <md-field class="md-form-group md-invalid" style="margin-bottom: 2rem">
        <md-icon>email</md-icon>
        <label>Email</label>
        <md-input v-model="email"/>
        <validation-error :errors="apiValidationErrors.email"/>
        </md-field>

        <md-field class="md-form-group md-invalid" style="margin-bottom: 2rem">
        <md-icon>lock_outline</md-icon>
        <label>Password</label>
        <md-input v-model="password" type="password"/>
        <validation-error :errors="apiValidationErrors.password"/>
        </md-field>

        <md-field class="md-form-group md-invalid">
        <md-icon>lock_outline</md-icon>
        <label>Confirm Password</label>
        <md-input v-model="password_confirmation" type="password"/>
        <validation-error :errors="apiValidationErrors.password_confirmation"/>
        </md-field>

        <md-checkbox v-model="boolean">I agree to the <a>terms and conditions</a>.</md-checkbox>

        <div class="button-container">
        <md-button class="md-success md-round mt-4" @click="register" slot="footer">
            Get Started
        </md-button>
        </div>

    </div>
</signup-card>
```