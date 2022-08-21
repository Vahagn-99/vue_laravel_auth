import { createApp, h } from 'vue'
import router from "@/router"
import store from "@/store"
import App from "@/App.vue";


const app = createApp({
  render: () => h(App)
}).use(router).use(store).mount('#app')  