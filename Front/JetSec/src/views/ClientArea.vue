<template>
<div id="app">
    <nav class="section navbar columns">
        <h2 class="column is-10">Seja bem-vindo a area do cliente</h2>
        <router-link class="button" to="/home">Home</router-link>

        <router-link class="button" to="/login">Logout</router-link>

    </nav>

        <div class="section">
          <div class="box columns">
            <div class="column">
              <p >sistemas de segurança em uso: </p>
            </div>
            <div class="column">
              <p >faturas:</p>
            </div>
            <div class="column">
              <p >sistemas em uso: </p>
            </div>
          </div>
        </div>
</div>
</template>

<script >
export default {
    name: "ClientArea",
}
</script>

<style scoped>
  .section {
  margin: 0px;
  }

  #app{
    background: #0f6674;
    min-height: 40rem;
  }
</style>