import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";

import "./assets/main.scss";

/**
 * Fontawesome icons
 */
import { library } from '@fortawesome/fontawesome-svg-core'
import {faThermometerQuarter}  from "@fortawesome/free-solid-svg-icons";
import { faSkyatlas }  from "@fortawesome/free-brands-svg-icons";

library.add(faThermometerQuarter, faSkyatlas)

/**
 * Bootstrap application
 */
const app = createApp(App);

app.use(createPinia());
app.use(router);

app.mount("#app");
