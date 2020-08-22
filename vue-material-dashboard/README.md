# [Vue Material Dashboard Laravel](https://vue-material-dashboard-laravel.creative-tim.com/?ref=mdpl-readme) [![Tweet](https://img.shields.io/twitter/url/http/shields.io.svg?style=social&logo=twitter)](https://twitter.com/home?status=Vue%20Material%20Dashboard%20Laravel%E2%9D%A4%EF%B8%8F%0Ahttps%3A//vue-material-dashboard-laravel.creative-tim.com/%20%23%vue%20%23%material%20%23design%20%23dashboard%20%23laravel%20via%20%40CreativeTim)

![version](https://img.shields.io/badge/version-1.0.1-blue.svg) ![license](https://img.shields.io/badge/license-MIT-blue.svg) [![GitHub issues open](https://img.shields.io/github/issues/creativetimofficial/vue-material-dashboard-laravel.svg?maxAge=2592000)](https://github.com/creativetimofficial/vue-material-dashboard-laravelpro-/issues?q=is%3Aopen+is%3Aissue) [![GitHub issues closed](https://img.shields.io/github/issues-closed-raw/creativetimofficial/vue-material-dashboard-laravel/vue-material-dashboard-laravel.svg?maxAge=2592000)](https://github.com/creativetimofficial/vue-material-dashboard-laravel/issues?q=is%3Aissue+is%3Aclosed)


*Frontend version*: Material Dashboard v2.1.2. More info at https://www.creative-tim.com/product/material-dashboard

*Vue version*: Vue Material Dashboard v1.4.0. More info at https://www.creative-tim.com/product/vue-material-dashboard

![Product Image](https://github.com/creativetimofficial/public-assets/raw/master/vue-material-dashboard-laravel/vue-material-dashboard-laravel.gif?raw=true)

What if your frontend came not only with reusable components, but also with a reusable backend? API-driven development is more than just a buzzword and we partnered with [UPDIVISION](https://updivision.com) to prove it. Build awesome-looking apps with a flexible architecture across a variety of devices and operating systems with Vue Material Dashboard Laravel. 

# Download

For the free version of the project you can either
- download the .zip file from the Creative Tim site and extract it or 
- make a clone from the Github repository

You will get two project folders: one for the Laravel API project and one for the Vue frontend.

# Laravel API Setup

## Introduction

JSON:API is a specification for how a client should request that resources be fetched or modified, and how a server should respond to those requests. It is designed to minimize both the number of requests and the amount of data transmitted between clients and servers. This efficiency is achieved without compromising readability, flexibility, or discoverability.

[Click here to go to the JSON:API docs](https://explore.postman.com/api/6357/laravel-jsonapi)

## Prerequisites

The Laravel JSON:API backend project requires a working Apache/Nginx local environment with PHP, Composer and MySQL.

The Laravel JSON:API frontend project requires a working local environment with NodeJS version 8.9 or above (8.11.0+ recommended), npm, VueCLI.

If you don't already have a local development environment, use one of the following links:

- Windows: [How to install WAMP on Windows](https://updivision.com/blog/post/beginner-s-guide-to-setting-up-your-local-development-environment-on-windows)
- Linux: [How to install LAMP on Linux](https://howtoubuntu.org/how-to-install-lamp-on-ubuntu)
- Mac: [How to install MAMP on MAC](https://wpshout.com/quick-guides/how-to-install-mamp-on-your-mac/)
- Install Composer: [https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md)

Install Composer: https://getcomposer.org/doc/00-intro.md

Install Node: https://nodejs.org/ (version 8.11.0+ recommended)

Install NPM: https://www.npmjs.com/get-npm

Install VueCLI: https://cli.vuejs.org/guide/installation.html

## Laravel JSON:API Project Installation

1. Navigate in your Laravel API project folder: `cd your-laravel-json-api-project`
2. Install project dependencies: `composer install`
3. Create a new .env file: `cp .env.example .env`
4. Generate application key: `php artisan key:generate`
5. Create users table: `php artisan migrate --seed`
6. Install Laravel Passport: `php artisan passport:install`
7. Add your own mailtrap.io credentials in MAIL_USERNAME and MAIL_PASSWORD in the .env file
8. Add your own database credentials in the .env file in DB_DATABASE, DB_USERNAME, DB_PASSWORD

## Vue Material Dashboard Project Installation

1. Navigate to your Vue Dashboard project folder:  `cd your-vue-material-dashbord-project`
2. Install project dependencies: `npm install`
3. Create a new .env file: `cp .env.example .env`
4. `VUE_APP_APP_BASE_URL` should contain the URL of your Vue Material Dashboard Project (eg. http://localhost:8080/)
5. `VUE_APP_API_BASE_URL` should contain the URL of your Laravel JSON:API Project. (eg. http://localhost:3000/api/v1)
6. Run `npm run dev` to start the application in a local development environment or `npm run build`  to build release distributables.

## Element-UI

  Vue Material Dashboard json API also uses [element-ui](https://vuematerial.io/ui-elements/elevation) components, restyled to fit perfectly with the existing Material look & feel.

## Usage

Register a user or login using admin@material.com and secret and start testing the theme.

Besides the dashboard and the auth pages this theme also has an edit profile page. All the necessary files are installed out of the box and all the needed routes are added to `src\router\index.js`. Keep in mind that all the features can be viewed once you log in using the credentials provided above or by registering your own user.

### Dashboard

You can access the dashboard either by using the "**Dashboards/Dashboard**" link in the left sidebar or by adding **/home** in the URL.

### Login

The login functionality is fully implemented in our theme helping you to start your project in no time. To login into dashboard you just have to add **/login** in the URL and fill the login form with the credentials (user: **admin@material.com** and password: **secret**).

The `src\pages\Dashboard\Pages\Login.vue` is the Vue component which handles the login functinality. You can easily adapt it to your needs.

It uses the auth store located in `src\store\modules\auth.js`.

#### Login card
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

### Register

The register functionality is fully implemented in our theme helping you to start your project in no time. To register a new user you just have to add **/register** in the URL or click on register link from login page and fill the register form with user details.

The `src\pages\Dashboard\Pages\Register.vue` is the Vue component which handles the login functinality. You can easily extend it to your needs.

It uses the auth store located in `src\store\modules\auth.js`.

#### Register card
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

### Profile edit

You have the option to edit the current logged in user's profile information (name, email, profile picture) and password. To access this page, just click the "**Examples/Profile**" link in the left sidebar or add **/profile** in the URL.

The `src\pages\Dashboard\Examples\UserProfile` is the folder with Vue components that handle the update of the user information and password.

#### Edit profile component
```
<template>
  <form>
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
            Profile Photo
          </label>
          <div class="md-layout-item">
            <div class="file-input">
              <div v-if="avatar_img">
                <div class="image-container">
                  <img :src="avatar_img"/>
                </div>
              </div>
              <div class="image-container" v-else>
                <img :src="default_img"/>
              </div>
              <div class="button-container">
                <md-button class="md-danger md-round" @click="removeImage" v-if="avatar_img">
                  <i class="fa fa-times"/>
                  Remove
                </md-button>
                <md-button class="md-success md-fileinput">
                  <template v-if="!avatar_img">Select image</template>
                  <template v-else>Change</template>
                  <input type="file" @change="onFileChange"/>
                </md-button>
              </div>
            </div>
          </div>
        </div>

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
        <md-button @click="updateProfile()">
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
        avatar_img: null,
        default_img: process.env.VUE_APP_APP_BASE_URL + "/img/placeholder.jpg",
        file: null
      }
    },

    methods: {

      onFileChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length) return;
        this.createImage(files[0]);
      },

      createImage(file) {
        let reader = new FileReader();
        reader.onload = e => {
          this.avatar_img = e.target.result;
          this.file = file;
        }
        reader.readAsDataURL(file);
      },

      removeImage() {
        this.avatar_img = null;
      },

      async updateProfile() {
        try {
          if (!this.user.profile_image) {
            await this.$store.dispatch("users/upload", {user: this.user, image: this.file})
            this.user.profile_image = await this.$store.getters["profile/url"]
          }
          await this.$store.dispatch("profile/update", this.user)
          await this.$store.dispatch("alerts/success", "Profile updated successfully.")
          this.user = await this.$store.getters["profile/me"]
        } catch (e) {
          await this.$store.dispatch("alerts/error", "Oops, something went wrong!")
          this.setApiValidation(e.response.data.errors)
        }

      }

    }
  };
</script>
```

#### Edit password component

```
<template>
  <form ref="password_form">

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
              <label>Current Password</label>
              <md-input v-model="password" type="password"/>
              <validation-error :errors="apiValidationErrors.password"/>
            </md-field>
            <md-field class="md-invalid">
              <label>New Password</label>
              <md-input v-model="new_password" type="password"/>
              <validation-error :errors="apiValidationErrors.password_confirmation"/>
            </md-field>
            <md-field class="md-invalid">
              <label>Confirm New Password</label>
              <md-input v-model="confirm_password" type="password"/>
              <validation-error :errors="apiValidationErrors.password_confirmation"/>
            </md-field>
          </div>
        </div>
      </md-card-content>

      <md-card-actions>
        <md-button @click="changePassword()">
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
      new_password: null,
      confirm_password: null
    }),

    methods: {
      async changePassword() {

        this.user.password = this.password;
        this.user.password_new = this.new_password;
        this.user.password_confirmation = this.confirm_password;

        try {
          await this.$store.dispatch("users/update", this.user)
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
```

## Table of Contents

* [Versions](#versions)
* [Demo](#demo)
* [Documentation](#documentation)
* [File Structure](#file-structure)
* [Browser Support](#browser-support)
* [Resources](#resources)
* [Reporting Issues](#reporting-issues)
* [Licensing](#licensing)
* [Useful Links](#useful-links)

## Versions

[<img src="https://github.com/creativetimofficial/public-assets/blob/master/logos/html-logo.jpg" height="80" />](#)
[<img src="https://github.com/creativetimofficial/public-assets/blob/master/logos/laravel_logo.png" height="80" />](#)
[<img src="https://github.com/creativetimofficial/public-assets/blob/master/logos/vue.jpg" height="80" />](#)
[<img src="https://github.com/creativetimofficial/public-assets/blob/master/logos/json-api.png" height="75" />](#)

| HTML | Laravel |
| --- | --- |
| [![Material Dashboard HTML](https://s3.amazonaws.com/creativetim_bucket/products/50/thumb/opt_md_thumbnail.jpg)](https://demos.creative-tim.com/material-dashboard/examples/dashboard.html?ref=vmdl-readme) | [![Material Dashboard Laravel](https://s3.amazonaws.com/creativetim_bucket/products/154/thumb/opt_md_laravel_thumbnail.jpg)](https://material-dashboard-laravel.creative-tim.com/?ref=vmdl-readme) |

| Vue | Vue & Laravel |
| --- | --- |
| [![Vue Material Dashboard](https://s3.amazonaws.com/creativetim_bucket/products/81/thumb/opt_md_vue_thumbnail.jpg)](https://www.creative-tim.com/product/vue-material-dashboard?ref=vmdl-readme) | [![Vue Material Dashboard Laravel](https://s3.amazonaws.com/creativetim_bucket/products/331/thumb/opt_md_vuelaravel_thumbnail.jpg)](https://www.creative-tim.com/product/vue-material-dashboard-laravel?ref=vmdl-readme) |

## Demo

| Register | Login | Dashboard |
| --- | --- | ---  |
| [![Register](https://github.com/creativetimofficial/public-assets/raw/master/vue-material-dashboard-laravel/Register.png)](https://vue-material-dashboard-laravel.creative-tim.com/register?ref=vmdl-readme)  | [![Login](https://github.com/creativetimofficial/public-assets/raw/master/vue-material-dashboard-laravel/Login.png)](https://vue-material-dashboard-laravel.creative-tim.com/login?ref=vmdl-readme)  | [![Dashboard](https://github.com/creativetimofficial/public-assets/raw/master/vue-material-dashboard-laravel/Dashboard.png)](https://vue-material-dashboard-laravel.creative-tim.com/?ref=vmdl-readme) |

| Profile Page | Users Page | Tables Page  |
| --- | --- | ---  |
| [![Profile Page](https://github.com/creativetimofficial/public-assets/raw/master/vue-material-dashboard-laravel/Profile.png)](https://vue-material-dashboard-laravel.creative-tim.com/profile?ref=vmdl-readme)  | [![Users Page](https://github.com/creativetimofficial/public-assets/raw/master/vue-material-dashboard-laravel/Users.png)](https://vue-material-dashboard-laravel.creative-tim.com/user?ref=vmdl-readme) | [![Tables Page](https://github.com/creativetimofficial/public-assets/raw/master/vue-material-dashboard-laravel/Tables.png)](https://vue-material-dashboard-laravel.creative-tim.com/table-list?ref=vmdl-readme)
[View More](https://vue-material-dashboard-laravel.creative-tim.com/?ref=vmdl-readme)

## Documentation
The documentation for the Vue Material Dashboard Laravel is hosted at our [website](https://vue-material-dashboard-laravel.creative-tim.com/documentation?ref=vmdl-readme).

## File Structure
```
|   .browserslistrc
|   .eslintrc.js
|   .gitignore
|   .jshintrc
|   babel.config.js
|   CHANGELOG.md
|   package-lock.json
|   package.json
|   postcss.config.js
|   README.md
|   yarn.lock
|
+---public
|   |   .DS_Store
|   |   favicon.png
|   |   index.html
|   |
|   \---img
|       |   apple-icon.png
|       |   bg-pricing.jpg
|       |   bg3.jpg
|       |   bg9.jpg
|       |   card-1.jpg
|       |   card-2.jpg
|       |   card-3.jpg
|       |   default-avatar.png
|       |   favicon.png
|       |   image_placeholder.jpg
|       |   laravel-vue.svg
|       |   lock.jpg
|       |   login.jpg
|       |   mask.png
|       |   new_logo.png
|       |   placeholder.jpg
|       |   product1.jpg
|       |   product2.jpg
|       |   product3.jpg
|       |   register.jpg
|       |   sidebar-1.jpg
|       |   sidebar-2.jpg
|       |   sidebar-3.jpg
|       |   sidebar-4.jpg
|       |   vue-logo.png
|       |
|       \---faces
|               avatar.jpg
|               card-profile1-square.jpg
|               card-profile2-square.jpg
|               marc.jpg
|
\---src
    |   .DS_Store
    |   App.vue
    |   globalComponents.js
    |   globalDirectives.js
    |   main.js
    |   material-dashboard.js
    |
    +---assets
    |   |   .DS_Store
    |   |
    |   +---css
    |   |       demo.css
    |   |
    |   +---images
    |   |       avatar.jpg
    |   |
    |   \---scss
    |       |   .DS_Store
    |       |   material-dashboard.scss
    |       |
    |       \---md
    |           |   .DS_Store
    |           |   _alerts.scss
    |           |   _autocomplete.scss
    |           |   _badges.scss
    |           |   _buttons.scss
    |           |   _cards.scss
    |           |   _chartist.scss
    |           |   _checkboxes.scss
    |           |   _collapse.scss
    |           |   _colors.scss
    |           |   _dialogs.scss
    |           |   _dropdown.scss
    |           |   _fileinput.scss
    |           |   _fixed-plugin.scss
    |           |   _footers.scss
    |           |   _forms.scss
    |           |   _headers.scss
    |           |   _info-areas.scss
    |           |   _inputs-size.scss
    |           |   _inputs.scss
    |           |   _layout.scss
    |           |   _misc.scss
    |           |   _mixins.scss
    |           |   _navbars.scss
    |           |   _pages.scss
    |           |   _pagination.scss
    |           |   _pills.scss
    |           |   _popups.scss
    |           |   _progress.scss
    |           |   _radios.scss
    |           |   _responsive.scss
    |           |   _rtl.scss
    |           |   _select.scss
    |           |   _shadows.scss
    |           |   _sidebar-and-main-panel.scss
    |           |   _tables.scss
    |           |   _tabs.scss
    |           |   _tags.scss
    |           |   _timeline.scss
    |           |   _togglebutton.scss
    |           |   _typography.scss
    |           |   _variables.scss
    |           |
    |           +---cards
    |           |       _card-global-sales.scss
    |           |       _card-login.scss
    |           |       _card-pricing.scss
    |           |       _card-product.scss
    |           |       _card-profile.scss
    |           |       _card-signup.scss
    |           |       _card-tabs.scss
    |           |       _card-testimonials.scss
    |           |
    |           +---mixins
    |           |       _chartist.scss
    |           |       _sidebar.scss
    |           |       _transparency.scss
    |           |       _vendor-prefixes.scss
    |           |
    |           \---plugins
    |                   _animate.scss
    |                   _fullcalendar.scss
    |                   _md-datepicker.scss
    |                   _perfect-scrollbar.scss
    |                   _plugin-jquery.jvectormap.scss
    |                   _plugin-nouislider.scss
    |                   _sweetalert2.scss
    |                   _wizard-card.scss
    |
    +---axios
    |       index.js
    |
    +---components
    |   |   .DS_Store
    |   |   Badge.vue
    |   |   Dropdown.vue
    |   |   index.js
    |   |   Logout.vue
    |   |   Pagination.vue
    |   |   Slider.vue
    |   |   Tabs.vue
    |   |   ValidationError.vue
    |   |
    |   +---Cards
    |   |       ChartCard.vue
    |   |       LoginCard.vue
    |   |       NavTabsCard.vue
    |   |       SignupCard.vue
    |   |       StatsCard.vue
    |   |
    |   +---NotificationPlugin
    |   |       index.js
    |   |       Notification.vue
    |   |       Notifications.vue
    |   |
    |   +---SidebarPlugin
    |   |       index.js
    |   |       SideBar.vue
    |   |       SidebarItem.vue
    |   |
    |   \---WorldMap
    |           WorldMap.vue
    |           world_map.js
    |
    +---middleware
    |       auth.js
    |       guest.js
    |
    +---mixins
    |       form-mixin.js
    |
    +---pages
    |   |   .DS_Store
    |   |   FixedPlugin.vue
    |   |
    |   \---Dashboard
    |       |   .DS_Store
    |       |   Dashboard.vue
    |       |
    |       +---Components
    |       |       Icons.vue
    |       |       Notifications.vue
    |       |       Typography.vue
    |       |
    |       +---Examples
    |       |   |   UserProfile.vue
    |       |   |
    |       |   +---UserManagement
    |       |   |       AddUserPage.vue
    |       |   |       EditUserPage.vue
    |       |   |       ListUserPage.vue
    |       |   |
    |       |   \---UserProfile
    |       |           EditPasswordCard.vue
    |       |           EditProfileCard.vue
    |       |           UserProfileCard.vue
    |       |
    |       +---Layout
    |       |   |   Content.vue
    |       |   |   ContentFooter.vue
    |       |   |   DashboardLayout.vue
    |       |   |   TopNavbar.vue
    |       |   |
    |       |   \---Extra
    |       |           MobileMenu.vue
    |       |           UserMenu.vue
    |       |
    |       +---Maps
    |       |       API_KEY.js
    |       |       FullScreenMap.vue
    |       |
    |       +---Pages
    |       |       AuthLayout.vue
    |       |       Login.vue
    |       |       Register.vue
    |       |       RtlSupport.vue
    |       |
    |       \---Tables
    |               RegularTables.vue
    |
    +---router
    |       index.js
    |       routes.js
    |
    \---store
        |   index.js
        |
        +---modules
        |       alerts-module.js
        |       auth.js
        |       categories-module.js
        |       items-module.js
        |       profile-module.js
        |       roles-module.js
        |       tags-module.js
        |       users-module.js
        |
        \---services
                categories-service.js
                items-service.js
                profile-service.js
                roles-service.js
                tags-service.js
                users-service.js
```

## Browser Support

At present, we officially aim to support the last two versions of the following browsers:

<img src="https://github.com/creativetimofficial/public-assets/blob/master/logos/chrome-logo.png?raw=true" width="64" height="64"> <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/firefox-logo.png" width="64" height="64"> <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/edge-logo.png" width="64" height="64"> <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/safari-logo.png" width="64" height="64"> <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/opera-logo.png" width="64" height="64">


## Resources
- Demo: <https://vue-material-dashboard-laravel.creative-tim.com/?ref=vmdl-readme>
- Download Page: <https://www.creative-tim.com/product/vue-material-dashboard-laravel?ref=vmdl-readme>
- Documentation: <https://vue-material-dashboard-laravel.creative-tim.com/documentation?ref=vmdl-readme>
- License Agreement: <https://www.creative-tim.com/license>
- Support: <https://www.creative-tim.com/contact-us>
- Issues: [Github Issues Page](https://github.com/creativetimofficial/vue-material-dashboard-laravel/issues)
- **Dashboards:**

| HTML | Laravel |
| --- | --- |
| [![Material Dashboard HTML](https://s3.amazonaws.com/creativetim_bucket/products/50/thumb/opt_md_thumbnail.jpg)](https://demos.creative-tim.com/material-dashboard/examples/dashboard.html?ref=vmdl-readme) | [![Material Dashboard Laravel](https://s3.amazonaws.com/creativetim_bucket/products/154/thumb/opt_md_laravel_thumbnail.jpg)](https://material-dashboard-laravel.creative-tim.com/?ref=vmdl-readme) |

| Vue | Vue & Laravel |
| --- | --- |
| [![Vue Material Dashboard](https://s3.amazonaws.com/creativetim_bucket/products/81/thumb/opt_md_vue_thumbnail.jpg)](https://www.creative-tim.com/product/vue-material-dashboard?ref=vmdl-readme) | [![Vue Material Dashboard Laravel](https://s3.amazonaws.com/creativetim_bucket/products/331/thumb/opt_md_vuelaravel_thumbnail.jpg)](https://www.creative-tim.com/product/vue-material-dashboard-laravel?ref=vmdl-readme) |

## Change log

Please see the [changelog](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Creative Tim](https://creative-tim.com/?ref=vmdl-readme)
- [UPDIVISION](https://updivision.com)

## Reporting Issues

We use GitHub Issues as the official bug tracker for the Vue Material Dashboard Laravel. Here are some advices for our users that want to report an issue:

1. Make sure that you are using the latest version of the Vue Material Dashboard Laravel. Check the CHANGELOG from your dashboard on our [website](https://www.creative-tim.com/?ref=vmdl-readme).
2. Providing us reproducible steps for the issue will shorten the time it takes for it to be fixed.
3. Some issues may be browser specific, so specifying in what browser you encountered the issue might help.

## Licensing

- Copyright 2019 Creative Tim (https://www.creative-tim.com/?ref=vmdl-readme)
- [Creative Tim License](https://www.creative-tim.com/license).


## Useful Links

- [Tutorials](https://www.youtube.com/channel/UCVyTG4sCw-rOvB9oHkzZD1w)
- [Affiliate Program](https://www.creative-tim.com/affiliates/new) (earn money)
- [Blog Creative Tim](http://blog.creative-tim.com/)
- [Free Products](https://www.creative-tim.com/bootstrap-themes/free) from Creative Tim
- [Premium Products](https://www.creative-tim.com/bootstrap-themes/premium?ref=vmdl-readme) from Creative Tim
- [React Products](https://www.creative-tim.com/bootstrap-themes/react-themes?ref=vmdl-readme) from Creative Tim
- [Angular Products](https://www.creative-tim.com/bootstrap-themes/angular-themes?ref=vmdl-readme) from Creative Tim
- [VueJS Products](https://www.creative-tim.com/bootstrap-themes/vuejs-themes?ref=vmdl-readme) from Creative Tim
- [More products](https://www.creative-tim.com/bootstrap-themes?ref=vmdl-readme) from Creative Tim
- Check our Bundles [here](https://www.creative-tim.com/bundles??ref=vmdl-readme)

## Social Media

### Creative Tim:

Twitter: <https://twitter.com/CreativeTim?ref=vmdl-readme>

Facebook: <https://www.facebook.com/CreativeTim?ref=vmdl-readme>

Dribbble: <https://dribbble.com/creativetim?ref=vmdl-readme>

Instagram: <https://www.instagram.com/CreativeTimOfficial?ref=vmdl-readme>


### Updivision:

Twitter: <https://twitter.com/updivision?ref=vmdl-readme>

Facebook: <https://www.facebook.com/updivision?ref=vmdl-readme>

Linkedin: <https://www.linkedin.com/company/updivision?ref=vmdl-readme>

Updivision Blog: <https://updivision.com/blog/?ref=vmdl-readme>

## Credits

- [Creative Tim](https://creative-tim.com/?ref=mdpl-readme)
- [UPDIVISION](https://updivision.com)
