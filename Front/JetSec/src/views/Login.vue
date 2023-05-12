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
                  <input id="email" type="email" value="seuemail@gmail.com">
              </div>
              <div>
                  <br>
                  <label>Senha</label>
                  <br>
                  <input type="password" id="password">
              </div>
              <div>
                  <span id="loginError"></span>
              </div>
              <div>
                  <br>
                  <button >Logar</button>
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
export default {
    name: "Login",
}
</script>

<style scoped></style>