<template>
  <div id="app-wrapper">
    <header>
      <h1>Minha Aplicação Laravel + Vue.js</h1>
      <nav>
        <router-link to="/">Home</router-link>
        <router-link to="/register">Registrar Conta</router-link>
        </nav>
    </header>

    <main>
      <router-view></router-view>
    </main>

    <footer>
      <p>&copy; {{ currentYear }} Minha Aplicação. Todos os direitos reservados.</p>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'App', // Nome do seu componente
  data() {
    return {
      currentYear: new Date().getFullYear(),
    };
  },
  // Você pode adicionar métodos, mounted, computed, etc. aqui se precisar de lógica global para o app
  // Por exemplo, para verificar o status de autenticação, carregar dados globais, etc.
};
</script>

<style>
/* Estilos globais para a sua aplicação */
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #f4f7f6;
  color: #333;
}

#app-wrapper {
  display: flex;
  flex-direction: column;
  min-height: 100vh; /* Garante que o footer fique no final da página */
}

header {
  background-color: #4a5568;
  color: white;
  padding: 20px;
  text-align: center;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

header h1 {
  margin: 0;
  font-size: 2em;
}

nav {
  margin-top: 10px;
}

nav a {
  color: white;
  text-decoration: none;
  margin: 0 15px;
  font-weight: bold;
  transition: color 0.3s ease;
}

nav a:hover {
  color: #a0aec0;
}

/* Estilo para o link ativo (usado pelo Vue Router) */
nav a.router-link-exact-active {
  color: #63b3ed; /* Um tom de azul para o link ativo */
}

main {
  flex-grow: 1; /* Garante que o conteúdo principal ocupe o espaço restante */
  padding: 20px;
  max-width: 1200px;
  margin: 20px auto;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

footer {
  background-color: #333;
  color: white;
  padding: 15px;
  text-align: center;
  margin-top: auto; /* Empurra o footer para o final */
}
</style>