// src/router/index.js

import { createRouter, createWebHistory } from 'vue-router';

// Importe o seu componente de formulário de registro existente
import RegisterFormComponent from '../components/RegisterFormComponent.vue'; // AJUSTE ESTE CAMINHO SE NECESSÁRIO

// Você pode ter outros componentes, como sua página de CRUD
// import UserCrudPage from '../views/UserCrudPage.vue';

const routes = [
  // Esta é uma rota inicial. Você pode redirecionar para a tela de registro
  // ou para outra página padrão quando o usuário acessa a raiz do site.
  {
    path: '/',
    name: 'Home',
    redirect: '/register' // Redireciona a URL raiz para '/register'
  },
  // Rota para a sua tela de registro de conta
  {
    path: '/register', // A URL que aparecerá no navegador, ex: http://localhost:8080/register
    name: 'Register',
    component: RegisterFormComponent, // Seu componente RegisterFormComponent.vue
  },
  // Exemplo de rota para sua tela de CRUD, se aplicável
  // {
  //   path: '/crud',
  //   name: 'UserCrud',
  //   component: UserCrudPage,
  // },
  // ... adicione outras rotas conforme necessário
];

const router = createRouter({
  history: createWebHistory(), // Usa o modo de histórico HTML5 (URLs limpas, sem #)
  routes,
});

export default router;