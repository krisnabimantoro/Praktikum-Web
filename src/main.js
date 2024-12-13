// import { createApp } from 'vue'
// import './style.css'
// import App from './App.vue'

// createApp(App).mount('#app')
import { createApp } from 'vue';
//import component App
import App from './App.vue';
//import config router
import router from './router'
//create App Vue
const app = createApp(App);
//gunakan "router" di Vue dengan plugin "use"
app.use(router);
app.mount('#app');