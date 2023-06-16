<template>
  <div id="#app">
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
          <h2 class="box" v-if="textError !== ''">{{ textError }}</h2>
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
import axios from "axios";
import CKEditor from "@ckeditor/ckeditor5-vue2";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import { useStore } from '/home/renan/DesenvolvimentoPraticas/Project/Front/JetSec/src/main.js';

export default{
  setup() {
    const store = useStore();

    const sharedData = computed(() => store.data);

    const updateData = () => {
      const newData = 'Novos dados';
      store.setData(newData); // Chama a ação para atualizar o estado
    };

    return {
      sharedData,
      updateData
    };
  },
  name: "OptionsActions",
  components: {
    ckeditor: CKEditor.component
  },
  data(){
  return{
    editor: ClassicEditor,
    editorDataTitle: '',
    editorDataText: '',
    editorConfig: {},
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
  methods:{
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