<template>
  <div id="app">
    <nav class="navbar">
      <div class="navbar-brand">
        <div class="navbar-item ">
          <router-link to="/"><img src="../assets/rocket.png" alt="Foguete azul"></router-link>
        </div>
      </div>
      <div class="navbar-menu" id="nav-links">
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
            <router-link to="/blog">Blog</router-link>
          </li>
          <li class="navbar-item">
            <router-link to="/home">Contato</router-link>
          </li>
          <li class="navbar-item" id="clientArea">
            <router-link to="/home">Logout</router-link>
          </li>
        </ul>
      </div>
    </nav>
    <div class="section columns has-text-centered ">
      <div class="column">
        <h2 @click="setPanel(insertService)" class="button ">Adicionar serviço</h2>
      </div>
      <div class="column">
        <h2 @click="setPanel(activeService)" class="button">Serviços ativos</h2>
      </div>
      <div class="column">
        <h2 @click="setPanel(disableService)" class="button">Serviços desativados</h2>
      </div>
    </div>
    <div v-if="currentCard === 1" class="section">
      <div class="section box">
        <div class="box">
          <label>insira o titulo </label><br>
          <ckeditor :editor="editor" v-model="editorDataTitle" :config="editorConfig"></ckeditor>
        </div>
        <div class="box">
          <label>Insira o texto</label>
          <ckeditor :editor="editor" v-model="editorDataText" :config="editorConfig"></ckeditor>
        </div>
        <div>
          <button @click="newService" class="button">Criar</button>
        </div>
        <div>
          <br>
          <h2 class="box" v-if="textError!== ''">{{ textError }}</h2>
        </div>
        <div>
          <br>
          <h2 class="box" v-if="sendData">Novo serviço criado com sucesso</h2>
        </div>
      </div>
    </div>
    <div v-if="currentCard === 2" class="section">
      <div class="section box">
        <div v-for="service in currentServices" class="columns is-vcentered">
          <div class="box column">
            {{ service.title }}<br>
            {{ service.content }}
          </div>
          <button class="button column  is-2 buttonToSwitchState" @click="deleteService(service.id)">delete</button>
        </div>
        <div v-if="badResponseToDelete !== ''">
          <p class="box">{{ badResponseToDelete }}</p>
        </div>
        <div>
          <br>
          <h2 class="box" v-if="textError!== ''">{{ textError }}</h2>
        </div>
      </div>
    </div>
    <div v-if="currentCard === 3" class="section">
      <div class="section box ">
        <div v-for="service in disabledServices" class="columns is-vcentered">
          <div class="box column">
            {{ service.title }}<br>
            {{ service.content }}
          </div>
          <button class="button column is-2 buttonToSwitchState" @click="undoService(service.id)">Ativar</button>
        </div>
        <div v-if="badResponseToActive !== ''">
          <p class="box">{{ badResponseToActive }}</p>
        </div>
      </div>
      <div>
        <br>
        <h2 class="box" v-if="textError!== ''">{{ textError }}</h2>
      </div>
    </div>
  </div>
</template>


<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue2';
import axios from 'axios';

export default {
  name: "Crud",
  components: {
    ckeditor: CKEditor.component
  },
  data() {
    return {
      editor: ClassicEditor,
      editorDataTitle: '',
      editorDataText: '',
      editorConfig: {},
      insertService: 1,
      activeService: 2,
      disableService: 3,
      currentCard: '',
      newContent: '',
      textError: '',
      sendData: false,
      currentServices: [],
      disabledServices: [],
      id: '',
      content: '',
      title: '',
      godResponseToDelete: false,
      badResponseToDelete: '',
      badResponseToActive: '',

    }
  },
  methods: {
    setPanel(value) {
      this.currentCard = value;
      this.sendData = false;
      this.textError = '';
      this.badResponseToDelete = '';

      if (this.currentCard === this.activeService || this.currentCard === this.disableService) {
        axios.get('http://127.0.0.1:8000/api/Service')
            .then((response) => {
              if (response.data.enabled) {
                this.currentServices = response.data.enabled;
              }
              if (response.data.disables) {
                this.disabledServices = response.data.disables;
              }
            })
            .catch((error) => {
              this.textError = error;
            })
      }

    },
    newService() {
      this.textError = '';
      if (this.editorDataTitle !== '' && this.editorDataText !== '') {
        axios.post('http://127.0.0.1:8000/api/Service', {
          'title': this.editorDataTitle,
          'content': this.editorDataText
        })
            .then((response) => {

              this.sendData = true;
              this.editorDataText = '';
              this.editorDataTitle = '';
            })
            .catch((error) => {
              this.textError = error;
            })
      } else {
        this.textError = 'os campos não podem estar vazio';
      }
    },
    deleteService(serviceId) {
      axios.delete(`http://127.0.0.1:8000/api/${serviceId}`)
          .then((response) => {
            this.currentCard = 0;
          })
          .catch((error) => {
            this.badResponseToDelete = error;
          })
    },
    undoService(serviceId) {
      axios.post(`http://127.0.0.1:8000/api/${serviceId}`)
          .then((response) => {
            this.currentCard = 0;
            //todo arrumar para dar um reload e recarregar sem esse serviço
          })
          .catch((error) => {
            this.badResponseToActive = error;
          })

    },
  },
}
</script>

<style scoped>
.section {
  margin: 0;
}

h2 {
  margin: 0 5px;

}

#app {
  background: #9ddbea;
  min-height: 40rem;
}

ul {
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
}

.buttonToSwitchState{
  margin: 5px;
}
</style>