<template>
  <div id="app">
    <div class="section columns is-fullheight is-centered">
      <div class="column is-4">
      </div>
      <div id="main" class="column box has-text-centered">
        <h2>Login</h2>
        <br>
        <div>
          <label>Email</label>
          <br>
          <input v-model="email" id="email" type="email">
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
          <router-link to="/email-step">criar uma conta</router-link>
        </div>
      </div>
      <div class="column is-4">
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import router from '@/router';
import {mapGetters, mapMutations} from 'vuex';
import Cookies from 'js-cookie'

export default {
  name: "Login",
  data() {
    return {
      email: '',
      password: '',
      verifyLog: false,
    }
  },
  computed: {
    ...mapGetters({
      getLog: 'loggedIn',
    }),
  },
  methods: {
    ...mapMutations([
      'setLoggedIn',
    ]),
    loginValidation: function () {
      axios.get('http://localhost:8000/api/user', {params:{email: this.email, password: this.password}})
          .then((response) => {
            if (response) {
              Cookies.set('passwordUser', this.password);
              Cookies.set('email', response.data.emailUser);
              Cookies.set('logged', true);
              this.setLoggedIn(true);
              router.push({path: '/client-area'});
            } else {
              this.verifyLog = true;
            }
          })
          .catch((error) => {
            this.verifyLog = true;
          })
    },
  },
};

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