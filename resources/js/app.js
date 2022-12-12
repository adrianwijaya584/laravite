import { createPinia } from "pinia";
import { createApp } from "vue";
import App from "./app.vue"
import routers from './routers'

const app= createApp(App)

const pinia= createPinia()

app
  .use(pinia)
  .use(routers)

app.mount("#app")