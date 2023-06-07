<template>
  <div id="App">
    <section class="columns is-vcentered section" id="forms-section">
      <div class="column has-text-centered title" id="titleForm">
        <h2>
          <strong>Quando o assunto é segurança, aqui você encontra tudo o que
            precisa.</strong
          >
        </h2>
      </div>
      <div class="column has-text-centered " id="formBox">
        <form id="myForm" class="box">
          <p>Solicite um contato</p>
          <div class="field">
            <label class="required-field">Nome</label><br>
            <input class=" " v-model="name" type="text"/>
          </div>
          <div class="field">
            <label class="required-field">Telefone<br/></label>
            <input class=" " v-model="phone" type="number" name="phone" id="phone"/>
          </div>
          <div class="field">
            <label class="required-field">Endereço de E-mail</label>
            <input class="" v-model="mail" type="email" name="email" id="email"/>
          </div>
          <div class="field ">
            <label class="required-field ">Mensagem:</label><br>
            <textarea class=" " v-model="msg" type="text" name="textarea" id="textarea"></textarea>
          </div>
          <div>
            <span id="errorMessage"></span>
          </div>
          <div class="column has-text-centered">
            <span v-if="hidden">Preencha todos os campos para enviar o formulário!</span>
            <span v-if="confirmation">O formulário foi enviado com sucesso!</span>
            <span v-if="errorSend">O formulário não foi enviado, motivo: {{ errorMsg }}</span>
          </div>
          <div class="column has-text-centered">
            <input v-if="phone !== '' && mail !=='' && name !== '' && msg !== ''" class="button is-success"
                   @click="formSend" type="button" value="Enviar"/>
          </div>
        </form>
      </div>
    </section>
    <section
        class="section columns is-vcentered is-centered is-gapless"
        id="CareSection"
    >
      <div class="column has-text-centered" id="columImage">
        <img src="" id="imageCare" alt=""/>
      </div>
      <div class="column">
        <h2 class="title has-text-centered">O cuidado que você merece</h2>
        <p class="has-text-justified">
          Há mais de <strong>25 ANOS </strong>cuidar da sua segurança é a nossa
          missão. Para minimizar riscos e evitar surpresas desagradáveis, você
          precisa ter a estratégia correta, e para isso estamos aqui.Venha fazer
          parte da família <strong>Strong Security</strong> você também!
        </p>
        <div class="column has-text-centered">
          <button class="button is-rounded is-success">
            <router-link to="/About">Conheça a Jet</router-link>
          </button>
        </div>
      </div>
    </section>
    <section class="section servicos">
      <div class="columns has-text-centered is-mobile is-centered">
        <div class="column"></div>
        <div class="column" id="sectionPreve">
          <p class="title">A melhor estratégia de segurança é a prevenção</p>
          <p>
            Se você possui alguma dúvida relacionada a segurança, nossa equipe
            está à disposição para te ajudar.
          </p>
          <button class="button is-rounded is-warning">
            <router-link to="/">Saiba mais</router-link>
          </button>
        </div>
        <div class="column"></div>
      </div>
    </section>
    <section class="section" id="Services">
      <p class="column has-text-centered title">Nossos serviços</p>
      <div class=" has-text-centered">
        <div class=" columns is-multiline ">
          <span v-if="errorGetService" class="">{{ serviceErrorMsg }}</span>
          <article class="column is-one-third box mosaicService" v-for="service in currentServices">
            <i class=""></i>
            <p class="title">{{ service.title }}</p>
            <p class="subtitle">{{ service.content }}</p>
          </article>
        </div>
      </div>
      <div class="column has-text-centered">
        <button class="button is-rounded is-success">
          <router-link to="/Service">Saiba mais</router-link>
        </button>
      </div>
    </section>
    <section class="section">
      <p id="textLocation" class="column has-text-centered">
        Localizada em Santa Maria / RS. Na rua Cel. Niederauer, 404 e filial no
        bairro Camobi. Cuidamos da segurança de lares e empresas, totalizando
        mais de 12 mil sistemas de segurança instalados.
      </p>
      <div class="has-text-centered">
        <iframe
            width="1000"
            height="400"
            id="gmap_canvas"
            src="https://maps.google.com/maps?width=775&amp;height=400&amp;hl=en&amp;q=rua%20Cel.%20Niederauer%20santa%20maria+()&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
        ></iframe
        >
      </div>
    </section>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "Home",
  data() {
    return {
      name: '',
      phone: '',
      mail: '',
      msg: '',
      confirmation: false,
      hidden: true,
      errorSend: false,
      errorMsg: '',
      currentServices: [],
      errorGetService: false,
      serviceErrorMsg: '',
    }
  },
  created() {
    axios.get('http://127.0.0.1:8000/api/Service')
        .then((response) => {
          this.currentServices = response.data.enabled;
        })
        .catch((error) => {
          this.errorGetService = true;
          this.serviceErrorMsg = error;
        })
  },
  methods: {
    formSend: function () {
      axios.post('http://127.0.0.1:8000/api/formSaver', {
        'email': this.mail,
        'phone': this.phone,
        'msg': this.msg,
        'name': this.name
      })
          .then((response) => {
            if (response) {
              this.name = '';
              this.phone = '';
              this.mail = '';
              this.msg = '';
              this.confirmation = true;
              this.hidden = false;
            }
          })
          .catch((error) => {
            this.errorSend = true;
            this.errorMsg = error;
          });

    },
  },
}

</script>

<style scoped>
#textLocation {
  padding: 25px;
  margin: 0 200px 0 200px;
}

.servicos {
  padding: 20px;
}

.mosaicService {
  margin: 0 0 24px 0;
}
</style>