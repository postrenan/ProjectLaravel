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
    <div class=" ">
      <div class="column is-5 box ">
        <p class=" column box"  >nome de usuario: {{nameUser}}<input v-model="newName" v-if="currentReplace" class="box" type="text"></p>

        <p class="column box">email: {{email}}<input v-model="newEmail" v-if="currentReplace" class="box" type="text"></p>

        <p class="column box">senha: {{password}}<input v-model="newPassword" v-if="currentReplace" class="box" type="text"></p>

        <p class="column box">data de criação da conta: {{created_at}}</p><br>
        <span v-if="warningData !== ''"  class="column">{{warningData}}</span>
        <div class="box">
          <div class="columns">
            <button class="button column" @click="closeTable">Fechar</button>
            <button  v-if="!currentReplace" @click="replaceData()" class="button box">Alterar</button>
            <button v-else @click="dataChange" class="button box">Confirmar troca</button>
            <button class="button is-danger column" @click="deleteUser">DELETAR CONTA</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</template>

<script >
import Cookies from "js-cookie";
import axios from 'axios';
import { ValidationProvider } from 'vee-validate';
import router from "@/router";
export default {
    components: {
      ValidationProvider
    },
    name: "ClientArea",
  data(){
    return{
      email: '',
      hiddenTable: true,
      verifyLog: false,
      nameUser: '',
      password: '',
      created_at: '',
      currentReplace: false,
      newPassword: '',
      newEmail: '',
      newName: '',
      warningData: '',
    }
  },
  mounted() {
    this.email = Cookies.get('email');
  },
  methods:{
      userTable:function(){
        this.hiddenTable = false;
        axios.get(`http://127.0.0.1:8000/api/getUserAfterValidate/${this.email}`)
            .then((response) => {
              if(response) {
                this.nameUser = response.data.name;
                this.created_at = response.data.created_at;
                this.password = Cookies.get('passwordUser');
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
        Cookies.remove('passwordUser')
        Cookies.set('otherPages', true);
      },
      replaceData:function(){
        this.currentReplace = true;
      },
      deleteUser:function(){

        axios.delete(`http://localhost:8000/api/deleteUser/${this.email}`)
        .then((response) => {
          Cookies.remove('email');
          Cookies.remove('logged');
          Cookies.remove('passwordUser')
         router.push({path:'/Login'});
        })
        .catch((error) => {
          //todo arrumar
        })
        },
      dataChange:function(){
        this.currentReplace = false;

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