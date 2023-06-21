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
   <CareCard/>
    <section class="section" id="Services">
      <p class="column has-text-centered title">Nossos serviços</p>
      <div class=" has-text-centered ">
        <div class=" columns is-multiline is-centered">
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
import CareCard from '@/components/CareCard.vue';
import {instance} from '@/main';

export default {
  name: "Home",
  components: {CareCard},
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
    instance.get('/service')
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
      instance.post('/form', {
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
            setTimeout(() => {
              this.errorSend = false;
            }, 4000,)

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


.mosaicService {
  margin: 0 5px 24px 0;
}

</style>