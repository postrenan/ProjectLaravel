<template>
  <div id="app">
    <div class="section columns is-fullheight  is-centered">
      <div v-if="!nextStep" id="main" class="column is-half  box has-text-centered">
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
          <button class="button is-rounded is-light" @click="loginValidation">Logar</button>
        </div>
        <div>
          <br>
          <button @click="createAccountStep" class="button is-rounded is-light " >criar uma conta </button>

        </div>
      </div>
      <div v-else-if="nextStep">
        <EmailStep/>
      </div>
    </div>
  </div>
</template>

<script>
import router from '@/router';
import {mapGetters, mapMutations} from 'vuex';
import Cookies from 'js-cookie'
import {instance} from '@/main';
import EmailStep from "@/components/EmailStep.vue";
export default {
  name: "Login",
  components: {EmailStep},
  data() {
    return {
      email: '',
      password: '',
      verifyLog: false,
      nextStep: false,

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
      'setUser',
    ]),
    loginValidation: function () {
      instance.get('/user', {params: {email: this.email, password: this.password}})
          .then((response) => {
            this.setUser(response.data.user);
            Cookies.set('passwordUser', this.password);
            Cookies.set('email', this.email);
            Cookies.set('logged', true);
            this.setLoggedIn(true);
            router.push({path: '/client-area'});
          })
          .catch((error) => {
            this.verifyLog = true;
          })
    },
    createAccountStep (){
      this.nextStep = true;
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