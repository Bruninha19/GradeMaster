<template>
  <form @submit.prevent="registerUser" class="register-form">
    <div class="form-group">
      <label for="fullName">Nome completo</label>
      <input type="text" id="fullName" v-model="form.full_name" required>
      <span v-if="errors.full_name" class="error-message">{{ errors.full_name[0] }}</span>
    </div>

    <div class="form-group">
      <label for="educationalEmail">E-mail educacional</label>
      <input type="email" id="educationalEmail" v-model="form.educational_email" required>
      <span v-if="errors.educational_email" class="error-message">{{ errors.educational_email[0] }}</span>
    </div>

    <div class="form-group">
      <label for="password">Senha</label>
      <input type="password" id="password" v-model="form.password" required>
      <span v-if="errors.password" class="error-message">{{ errors.password[0] }}</span>
    </div>

    <div class="form-group">
      <label for="confirmPassword">Confirmar senha</label>
      <input type="password" id="confirmPassword" v-model="form.password_confirmation" required>
      <span v-if="errors.password_confirmation" class="error-message">{{ errors.password_confirmation[0] }}</span>
    </div>

    <button type="submit" class="btn-register" :disabled="loading">
      {{ loading ? 'CADASTRANDO...' : 'CADASTRAR' }}
    </button>

    <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
    <p v-if="generalError" class="error-message">{{ generalError }}</p>
  </form>
</template>

<script>
// import axios from 'axios'; // Se não estiver global no app.js/bootstrap.js

export default {
  name: 'RegisterFormComponent',
  data() {
    return {
      form: {
        full_name: '',
        educational_email: '',
        password: '',
        password_confirmation: '',
      },
      errors: {},
      successMessage: '',
      generalError: '',
      loading: false,
    };
  },
  methods: {
    async registerUser() {
      this.loading = true;
      this.errors = {};
      this.successMessage = '';
      this.generalError = '';

      if (this.form.password !== this.form.password_confirmation) {
        this.errors.password_confirmation = ['As senhas não coincidem.'];
        this.generalError = 'Por favor, corrija os erros no formulário.';
        this.loading = false;
        return;
      }

      try {
        // A URL para onde os dados serão enviados: /api/contas
        const response = await axios.post('http://127.0.0.1:8000/api/contas', this.form);

        this.successMessage = response.data.message || 'Conta criada com sucesso!';
        this.form = { full_name: '', educational_email: '', password: '', password_confirmation: '' };
        console.log('Registro bem-sucedido:', response.data);

      } catch (error) {
        if (error.response) {
          if (error.response.status === 422 && error.response.data.errors) {
            this.errors = error.response.data.errors;
            this.generalError = error.response.data.message || 'Por favor, corrija os erros no formulário.';
          } else {
            this.generalError = error.response.data.message || 'Ocorreu um erro ao registrar a conta.';
          }
        } else if (error.request) {
          this.generalError = 'Não foi possível conectar ao servidor. Verifique sua conexão ou o servidor.';
        } else {
          this.generalError = 'Erro inesperado. Tente novamente.';
        }
        console.error('Erro no registro:', error);
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
/* Seus estilos originais - não alterados */
.register-form {
  margin-left: 40px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  background-color: #ffffff;
}
.form-group {
  display: flex;
  flex-direction: column;
  text-align: left;
}
.form-group label {
  margin-bottom: 8px;
  font-weight: bold;
  color: #555;
}
.form-group input {
  background-color: #EFEFEF;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 1em;
  width: 400px;
}
.form-group input:focus {
  border-color: #000;
  outline: none;
}
.btn-register {
  grid-column: 1 / -1; /* Ocupa as duas colunas */
  padding: 11px 11px 11px 11px;
  background-color: #1E88DA; /* Cor azul do botão */
  color: white;
  border: none;
  border-radius: 10px;
  font-size: 0.9em;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-top: 50px;
  width: 170px;
  height: 42px;
}
.btn-register:hover {
  background-color: #0056b3;
}
/* Novos estilos para mensagens de erro/sucesso */
.error-message {
  color: #dc3545; /* Vermelho */
  font-size: 0.85em;
  margin-top: 5px;
}
.success-message {
  color: #28a745; /* Verde */
  font-size: 0.85em;
  margin-top: 5px;
}
</style>