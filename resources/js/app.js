/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

import { store } from "./store";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component(
//     "example-component",
//     require("./components/ExampleComponent.vue").default
// );

/**
 * PAGES
 */
Vue.component(
    "login-component",
    require("./components/pages/Login.vue").default
);
Vue.component("home-component", require("./components/pages/Home.vue").default);
Vue.component(
    "brands-component",
    require("./components/pages/Brands.vue").default
);

/**
 * PARTS
 */
Vue.component(
    "input-container-component",
    require("./components/parts/InputContainer.vue").default
);
Vue.component(
    "table-component",
    require("./components/parts/Table.vue").default
);
Vue.component("card-component", require("./components/parts/Card.vue").default);
Vue.component(
    "modal-component",
    require("./components/parts/Modal.vue").default
);
Vue.component(
    "alerts-component",
    require("./components/parts/Alert.vue").default
);
Vue.component(
    "paginate-component",
    require("./components/parts/Paginate.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    store,
});
