<template>
  <form @submit.prevent="submitForm" class="form-container">
    <div class="form-row">
      <div class="form-group">
        <label>Nome completo</label>
        <input 
          class="input" 
          type="text" 
          v-model="form.nome_completo" 
          :class="{ 'input-error': errors.nome_completo }"
          required
          minlength="5"
          maxlength="100"
        />
        <span v-if="errors.nome_completo" class="error-message">
          {{ errors.nome_completo[0] }}
        </span>
      </div>

      <div class="form-group">
        <label>E-mail educacional</label>
        <input 
        class="input" 
        type="email" 
        v-model="form.email" 
        :class="{ 'input-error': errors.email }"
        required
      />
        <span v-if="errors.email" class="error-message">
          {{ errors.email[0] }}
        </span>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Senha</label>
        <input 
          class="input" 
          type="password" 
          v-model="form.senha" 
          :class="{ 'input-error': errors.senha }"
          required
          minlength="8"
          pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
          title="A senha deve conter pelo menos 8 caracteres, uma letra maiúscula, um número e um caractere especial"
        />
        <span v-if="errors.senha" class="error-message">
          {{ errors.senha[0] }}
        </span>
      </div>

      <div class="form-group">
        <label>Confirmar senha</label>
        <input 
          class="input" 
          type="password" 
          v-model="form.senha_confirmation" 
          required
          minlength="8"
        />
      </div>
    </div>

    <button 
      type="submit" 
      class="btn-cadastrar"
      :disabled="isLoading"
    >
      {{ isLoading ? 'CADASTRANDO...' : 'CADASTRAR' }}
    </button>
  </form>
</template>

<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';

export default {
  name: 'RegisterFormComponent',
  data() {
    return {
      form: {
        nome_completo: '',
        email: '',
        senha: '',
        senha_confirmation: ''
      },
      errors: {},
      isLoading: false,
      // Configuração de ambiente
      apiUrl: import.meta.env.VITE_API_BASE_URL || 'http:/127.0.1:8000/api'
    };
  },
  methods: {
    async submitForm() {
      this.isLoading = true;
      this.errors = {};
      
      try {
        const response = await axios.post(`${this.apiUrl}contas`, {
          nome_completo: this.form.nome_completo,
          email: this.form.email,
          senha: this.form.senha,
          senha_confirmation: this.form.senha_confirmation
        }, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        });
        
        if (response.data.success) {
          toast.success('Cadastro realizado com sucesso!');
          setTimeout(() => {
            this.$router.push('/login');
          }, 1500);
        }
      } catch (error) {
        if (error.response?.status === 422) {
          this.errors = error.response.data.errors;
          toast.error('Por favor, corrija os campos destacados');
        } else {
          const errorMsg = error.response?.data?.message || 
                         error.code === 'ERR_NETWORK' 
                         ? 'Não foi possível conectar ao servidor' 
                         : 'Erro durante o cadastro';
          toast.error(errorMsg);
          console.error('Detalhes do erro:', {
            request: error.config,
            response: error.response?.data,
            status: error.response?.status
          });
        }
      } finally {
        this.isLoading = false;
      }
    }
  }
}
</script>

<style scoped>
.form-container {
  max-width: 800px;
  width: 100%;
  margin-left: 50px;
  padding: 40px 20px;
  background: #fff;
  border-radius: 10px;
}

.form-row {
  display: flex;
  flex-wrap: wrap;
  gap: 70px;
  margin-bottom: 25px;
}

.form-group {
  flex: 1 1 45%;
  min-width: 250px;
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-weight: 600;
  margin-bottom: 10px;
  color: #333;
  font-size: 14px;
}

.input {
  padding: 12px 15px;
  border: 1px solid #ddd;
  border-radius: 6px;
  background-color: #f9f9f9;
  font-size: 15px;
  width: 100%;
  transition: border 0.3s ease;
}

.input:focus {
  outline: none;
  border-color: #1E88DA;
  background-color: #fff;
}

.input-error {
  border-color: #ff4444;
  background-color: #fff6f6;
}

.error-message {
  color: #ff4444;
  font-size: 13px;
  margin-top: 6px;
  font-weight: 500;
}

.btn-cadastrar {
  margin-top: 25px;
  padding: 14px 28px;
  background-color: #1E88DA;
  color: white;
  border: none;
  border-radius: 6px;
  font-weight: 600;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.3s ease;
  width: 100%;
  max-width: 150px;
  display: block;
  margin-left: 0;
  margin-top: 70px;
}

.btn-cadastrar:hover:not(:disabled) {
  background-color: #1865a0;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-cadastrar:disabled {
  background-color: #95a5a6;
  cursor: not-allowed;
  opacity: 0.8;
}

@media (max-width: 768px) {
  .form-row {
    flex-direction: column;
    gap: 20px;
  }
  
  .form-group {
    flex: 1 1 100%;
  }
  
  .btn-cadastrar {
    max-width: 100%;
  }
}
</style>