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
                  <input v-model="email" id="email" type="email" value="seuemail@gmail.com">
              </div>
              <div>
                  <br>
                  <label>Senha</label>
                  <br>
                  <input v-model="password" type="password" id="password">
              </div>
              <div>
                  <span id="loginError"></span>
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
export default {
    name: "Login",
    data(){
        return{
            email: '',
            password: '',
        }
    },
    methods:{
        loginValidation:function(){
            axios.post('http://127.0.0.1:8000/api/validateLogin', {'email': this.email, 'password':this.password})
                .then((response) => {

                })
                .catch(() => {

                })
        }
    }
}
</script>

<style scoped></style>