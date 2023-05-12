<template>
    <div id="app">
        <div class="section columns is-fullheight is-centered">
          <div class="column is-4">
          </div>
          <div id="main" class="column box has-text-centered">
              <h2>Login</h2>
              <div >
                  <label>Email</label>
                  <input id="email" type="email" value="seuemail@gmail.com">
              </div>
              <div>
                  <label>Senha</label>
                  <input type="password" id="password">
              </div>
              <div>
                  <span id="loginError"></span>
              </div>
              <div>
                  <button >Logar</button>
              </div>
              <div>

                  <br>
                  <a >criar uma conta</a>
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