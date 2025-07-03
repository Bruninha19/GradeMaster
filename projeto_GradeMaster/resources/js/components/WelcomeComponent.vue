<template>
  <div style="background-color: #e0ffe0; padding: 20px; border-radius: 8px;">
    <h2>Olá do Vue.js!</h2>
    <p>Esta é uma mensagem de um componente Vue.js.</p>
    <button @click="count++">Contador: {{ count }}</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      count: 0
    };
  },
  mounted() {
    console.log('Componente WelcomeComponent montado.');
  }
};
</script>

<style scoped>
/* Estilos específicos para este componente */
h2 {
  color: #333;
}
button {
  padding: 10px 15px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
</style>