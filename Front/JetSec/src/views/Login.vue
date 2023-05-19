<template>
    <div id="app">
        <div class="section columns is-fullheight is-centered">
          <div class="column is-4">
          </div>
          <div id="main" class="column box has-text-centered">
              <h2>Login</h2>
              <br>
              <div >
                  <label>Email</label>
                  <br>
                  <input v-model="email" id="email" type="email" >
              </div>
              <div>
                  <br>
                  <label>Senha</label>
                  <br>
                  <input v-model="password" type="password" id="password">
              </div>
              <div>
                  <span v-if="verifyLog">verifica se o email e senha estão corretos</span>
              </div>
              <div>
                  <br>
                  <button @click="loginValidation">Logar</button>
              </div>
              <div>
                  <br>
                  <router-link to="EmailStep">criar uma conta</router-link>
              </div>
          </div>
          <div class="column is-4">
          </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import router from "@/router";
export default {
    name: "Login",
    data(){
        return{
            email: '',
            password: '',
            verifyLog: false,
        }
    },
    methods:{
        loginValidation:function(){
            axios.post('http://127.0.0.1:8000/api/validateLogin', {email: this.email, password:this.password})
                .then((response) => {
                  if(response.data === 200) {
                      router.push({path: '/ClientArea'});
                  }
                  else{
                    this.verifyLog = true;
                  }
                })
                .catch((error) => {
                })
        }
    }
}
</script>

<style scoped></style>