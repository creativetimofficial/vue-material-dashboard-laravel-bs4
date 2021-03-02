# Vue Frontend Setup

Vue Material Dashboard PRO json API is a fullstack resource built on top of [Vue Material](https://vuematerial.io/) and [Vuejs](https://vuejs.org/v2/guide/). Build awesome-looking apps with a flexible architecture across a variety of devices and operating systems. Vue Material Dashboard PRO json API is the official Vuejs and json API version of the original Material Dashboard PRO.

## Prerequisites Frontend

The Laravel JSON:API frontend project requires a working local environment with NodeJS version 8.9 or above (8.11.0+ recommended), npm, VueCLI.

Install Node: [https://nodejs.org/](https://nodejs.org/) (version 8.11.0+ recommended)

Install NPM: [https://www.npmjs.com/get-npm](https://www.npmjs.com/get-npm)

Install VueCLI: [https://cli.vuejs.org/guide/installation.html](https://cli.vuejs.org/guide/installation.html)

### Getting Started
1. Navigate to your Vue Dashboard project folder:  `cd your-vue-material-dashbord-project`
2. Install project dependencies: `npm install`
3. Create a new .env file: `cp .env.example .env`
4. `VUE_APP_BASE_URL` should contain the URL of your Vue Material Dashboard Project (eg. http://localhost:8080/)
5. `VUE_APP_API_BASE_URL` should contain the URL of your Laravel JSON:API Project. (eg. http://localhost:3000/api/v1)
6. Run `npm run dev` to start the application in a local development environment or `npm run build`  to build release distributables.

You can also run additional npm tasks such as
- `npm run build` to build your app for production
- `npm run lint` to run linting.

## Vue-cli

We used the latest 3.x [Vue CLI](https://github.com/vuejs/vue-cli) so you can configure your project in no time. You'll find everything you need inside  `package.json` + some other related files such as `.babelrc`, `.eslintrc.js` and `.postcssrc.js`

## Element-UI

  Vue Material Dashboard PRO json API also uses [element-ui](https://vuematerial.io/ui-elements/elevation) components, restyled to fit perfectly with the existing Material look & feel.
