<template>
  <nav class="navbar">
    <div class="navbar-brand">
      <div class="navbar-item ">
        <router-link to="/"><img src="../assets/rocket.png" alt="Foguete azul"></router-link>
      </div>
      <a class="navbar-burger" id="burger">
        <span></span>
        <span></span>
        <span></span>
      </a>
    </div>
    <div class="navbar-menu NavBar">
      <ul class="navbar-end" id="navbarForms">
        <li class="navbar-item">
          <router-link to="/home">Home</router-link>
        </li>
        <li class="navbar-item">
          <router-link to="/about">Sobre</router-link>
        </li>
        <li class="navbar-item">
          <router-link to="/service">Serviços</router-link>
        </li>
        <li class="navbar-item">
          <router-link target="_blank" to="/blog">Blog</router-link>
        </li>
        <li class="navbar-item">
          <router-link to="/home">Contato</router-link>
        </li>
        <li v-if="!hidden" class="navbar-item" id="clientArea">
          <router-link to="/login">Area do cliente</router-link>
        </li>

      </ul>
    </div>
  </nav>
</template>

<script>

export default {
  name: "HeaderSite",
  data() {
    return {
      email: '',
      verificationLoggin: '',
      hidden: false,
    }
  },
  methods: {},
}
</script>

<style scoped>
.NavBar {
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
}
</style>