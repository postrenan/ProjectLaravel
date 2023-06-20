<template>
<div>
  <div v-if="emailStep" class="section columns is-fullheight is-centered">
    <div id="main" class="column box has-text-centered">
      <h2>Criação de email</h2>
      <br>
      <div>
        <label>Email</label>
        <br>
        <input v-model="mail1" id="email" type="email">
      </div>
      <div>
        <br>
        <label>Confirmação de email</label>
        <br>
        <input v-model="mail2" id="email2" type="email">
      </div>
      <div>
        <span id="loginError">Verificar se os emails coicidem</span>
      </div>
      <div>
        <br>
        <button class="button" v-on:click="validateEmail">Verificar</button>
        <button class="button" >Prosseguir</button>
      </div>
      <div>
        <br>
        <span >O email já está em uso.</span>
      </div>
    </div>
  </div>

  <div v-else class="section columns is-fullheight is-centered">
    <div id="main" class="column box has-text-centered">
      <h2>Criação de senha</h2>
      <br>
      <div>
        <label>Senha</label>
        <br>
        <input v-model="pwd1" id="pwd1" type="password">
      </div>
      <div>
        <br>
        <label>Confirmação de senha</label>
        <br>
        <input v-model="pwd2" id="pwd2" type="password">
      </div>
      <div>
        <span v-if="pwd1 !== pwd2" id="loginError">Verificar se as senhas coicidem</span><br>
        <span
            v-if="passwordWarning = true">As senha devem conter letras minusculas, maiusculas, números e simbolos</span>
      </div>
      <div>
        <br>
        <button class="button" @click="registerData">Criar</button>
      </div>
      <div>
        <br>
        <span v-if="errorCreate">Não foi possivel criar o usuario!<br>tente logar ou crie outro perfil.</span>
      </div>
    </div>
  </div>
</div>

</template>

<script>
import router from '@/router';
import {instance} from '@/main';

export default {
  name: "EmailStep",
  data() {
    return {
      mail1: "",
      mail2: "",
      invalidEmail: true,
      emailInUse: false,
      passwordStep: false,
      emailStep: true,
      pwd1: "",
      pwd2: "",
      errorCreate: false,
      passwordWarning: false,
    }
  },
  methods: {
    validateEmail: function () {
      if (/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(this.mail1)) {
        if (this.mail1 !== this.mail2) {
        } else {
          instance.get('/user-create', {params: {'email': this.mail1}})
              .then((response) => {
                if (response.status === 200) {
                  this.invalidEmail = false;
                  this.emailStep = false;
                  this.passwordStep = true;
                } else {
                  this.emailInUse = true;
                  this.mail1 = "";
                  this.mail2 = "";
                }
              })
              .catch((error) => {
                this.emailInUse = true;
                this.mail1 = "";
                this.mail2 = "";
              });
        }
      }
    },
    registerData: function () {
      this.passwordWarning = true;
      if (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/.test(this.pwd1)) {
        if (this.pwd1 !== this.pwd2) {
          this.passwordWarning = false;
        } else {
          instance.post('/user-create', {'email': this.mail1, 'password': this.pwd1})
              .then((response) => {
                if (response) {
                  this.pwd1 = "";
                  this.pwd2 = "";
                  router.push({path: '/login'});
                } else {
                  this.errorCreate = true;
                }
              })
        }
      }
    }
  },

}
</script>

<style scoped>
#main {
  padding-top: 3rem;
}

.section {
  min-height: 30rem;
  margin: 0;
  padding-top: 9rem;
}

#app {
  background: #0f6674;
  min-height: 40rem;
}
</style>