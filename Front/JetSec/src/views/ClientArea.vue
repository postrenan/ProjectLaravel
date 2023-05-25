<template>
<div id="app">
  <nav class="navbar" >
    <div class="navbar-brand" >
      <div class="navbar-item ">
        <router-link to="/"><img src="../assets/rocket.png" alt="Foguete azul"></router-link>
      </div>
    </div>
    <div class="navbar-menu" id="nav-links">
      <ul class="navbar-end" id="navbarForms">
        <li class="navbar-item"><router-link to="/home">Home</router-link></li>
        <li class="navbar-item"><router-link to="/about">Sobre</router-link></li>
        <li class="navbar-item"><router-link to="/service">Serviços</router-link></li>
        <li class="navbar-item"><router-link to="/home">Contato</router-link></li>
        <li @CLICK="removeCookie" class="navbar-item" id="clientArea"><router-link to="/home">Logout</router-link></li>
      </ul>
    </div>
  </nav>

  <div class="section columns has-text-centered">
    <h2 class="column-is-1 box">Olá {{email}}</h2>
    <h2 class="column-is-2  button box" @click="userTable">Meu dados</h2>
  </div>

  <div class="section">
    <div class="columns box">
      <div class="column">
        <p >sistemas de segurança em uso: 20 unidades</p>
      </div>
      <div class="column">
        <p >faturas: 0 pendentes</p>
      </div>
      <div class="column">
        <p >sistemas em uso: 2 </p>
      </div>
    </div>
  </div>
  <div v-if="!hiddenTable" class="section">
    <div class="columns ">
      <div class="column is-3 box ">
        <p class="box">nome de usuario: {{nameUser}}</p>
        <p class="box">email: {{email}} </p>
        <div  class="box">
          <p>senha: {{password}}</p>
          <h2 >alterar</h2>
        </div>
        <p  class="box">data de criação da conta: {{created_at}}</p><br>
        <span v-if="verifyLog">verifica se o email e senha estão corretos</span>
        <h2 class="button" @click="closeTable">Fechar</h2>
      </div>
    </div>
  </div>

</div>
</template>

<script >
import Cookies from "js-cookie";
import axios from 'axios';
export default {

    name: "ClientArea",
  data(){
    return{
      email: '',
      hiddenTable: true,
      verifyLog: false,
      nameUser: '',
      password: '',
      created_at: '',
    }
  },
  mounted() {
    this.email = Cookies.get('email');
  },
  methods:{
      userTable:function(){
        this.hiddenTable = false;
        axios.get('http://127.0.0.1:8000/api/validateLogin')
            .then((response) => {
              if(response) {
                this.nameUser = response.data.name;
                this.created_at = response.data.created_at;
                this.password = Cookies.get('senha');
                console.log(this.created_at);
                console.log(response.data);
              }
              else{
                this.verifyLog = true;
              }
            })
            .catch((error) => {
              this.verifyLog = true;
            })
      },
      closeTable:function(){
        this.hiddenTable = true;
      },
      removeCookie:function(){
        Cookies.remove('email');
        Cookies.remove('logged');
        Cookies.set('otherPages', true);
      },
  },
}
</script>

<style scoped>
  .section {
  margin: 0;
  }

  h2{
    margin: 0 5px;
  }

  #app{
    background: #0f6674;
    min-height: 40rem;
  }

  ul {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
  }
</style>