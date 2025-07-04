
import { createApp } from 'vue'
import RegisterFormComponent from './components/RegisterFormComponent.vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const app = createApp({})
app.config.globalProperties.$toast = toast;
app.component('register-form-component', RegisterFormComponent)
app.mount('#app')
