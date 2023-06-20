<template>
  <div id="app">
    <div class="section columns is-fullheight is-centered">
      <div class="column is-4">
      </div>
      <div id="main" class="column box has-text-centered">
        <h2>Area restrita</h2>
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
          <span v-if="verifyLog">Verificar se o email e senha estão corretos</span>
        </div>
        <div>
          <br>
          <button @click="loginValidation">Logar</button>
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
import {instance} from '@/main';
export default {
  name: "RestrictArea",
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

      instance.get('/user', {params:{email: this.email, password: this.password}})
          .then((response) => {
            Cookies.set('email', response.data.emailUser);
            Cookies.set('logged', true);
            this.setLoggedIn(true);
            router.push({path: '/client-area'});
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
  background: #65030b;
  min-height: 40rem;
}
</style>