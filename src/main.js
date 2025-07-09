// src/main.js
import './assets/main.css';

import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // <--- ADD THIS LINE to import your router

const app = createApp(App);

app.use(router); // <--- ADD THIS LINE to tell Vue to use the router

app.mount('#app');