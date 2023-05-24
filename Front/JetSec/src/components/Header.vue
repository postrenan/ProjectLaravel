<template>
    <nav class="navbar" >
        <div class="navbar-brand" >
            <div class="navbar-item ">
                <img src="" alt="">
            </div>
            <a class="navbar-burger" id="burger">
                <span ></span>
                <span></span>
                <span></span>
            </a>
        </div>
        <div class="navbar-menu" id="nav-links">
            <ul class="navbar-end" id="navbarForms">
                <li class="navbar-item"><router-link to="/home">Home</router-link></li>
                <li class="navbar-item"><router-link to="/about">Sobre</router-link></li>
                <li class="navbar-item"><router-link to="/service">Serviços</router-link></li>
                <li class="navbar-item"><router-link to="/home">Contato</router-link></li>
                <li class="navbar-item" id="clientArea"><router-link to="/login">Area do cliente</router-link></li>
            </ul>
        </div>
    </nav>
</template>

<script >


import {mapGetters, mapMutations} from "vuex";
import axios from "axios";
import Cookies from "js-cookie";
import router from "@/router";

export default {
    name: "HeaderSite",
  data(){
    return{
      email: '',
  }
  methods:{

    }
  },
}
</script>

<style scoped>
ul {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}
</style>