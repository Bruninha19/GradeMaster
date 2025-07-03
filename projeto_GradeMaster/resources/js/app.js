import './bootstrap'; // Se você usa o bootstrap.js do Laravel

import { createApp } from 'vue';
import App from './App.vue'; // Certifique-se de que App.vue existe aqui
import router from './router'; // Importe seu arquivo de roteamento

const app = createApp(App);

app.use(router); // Use o Vue Router

app.mount('#app'); // Monte o aplicativo Vue no elemento <div id="app">