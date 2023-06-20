<template>
  <div id="app">
    <div class="section columns has-text-centered box">
      <div class="column">
        <h2 v-if="SelectedOption === 1" @click="setPanel(insertArticle)" class="button">Adicionar artigo</h2>
        <h2 v-else @click="setPanel(insertService)" class="button ">Adicionar serviço</h2>
      </div>
      <div class="column">
        <h2 v-if="SelectedOption === 1" @click="setPanel(activeArticle)" class="button">Artigos ativos</h2>
        <h2 v-else @click="setPanel(activeService)" class="button">Serviços ativos</h2>
      </div>
      <div class="column">
        <h2 v-if="SelectedOption === 1" @click="setPanel(disableArticle)" class="button">Artigos desativados</h2>
        <h2 v-else @click="setPanel(disableService)" class="button">Serviços desativados</h2>
      </div>
    </div>

    <div v-if="currentCard === 4" class="section">
      <div class="section box">
        <div class="box">
          <label>insira o titulo </label><br>
          <input v-model="newTitle" type="text"></input>
        </div>
        <div class="box">
          <label>Insira o texto</label>
          <ckeditor :editor="editor" v-model="editorDataText" :config="editorConfig"></ckeditor>
        </div>
        <div class="box">
          <label>Insira a categoria</label><br>
          <input v-model="newCategory" type="text">
        </div>
        <div>
          <button @click="newArticle" class="button">Criar</button>
        </div>
        <div>
          <br>
          <h2 class="box" v-if="textError!== ''">{{ textError  }}<br>Já existe esse titulo </h2>
        </div>
        <div>
          <br>
          <h2 class="box" v-if="sendData">Novo artigo criado com sucesso</h2>
        </div>
      </div>
    </div>
    <div v-if="currentCard === 5" class="section">
      <div class="section box">
        <div v-for="article in activeArticles" class="columns is-vcentered">
          <div class="box column">
            {{ article.title }}<br>
            {{ article.content }}
          </div>
          <button class="button column is-2 buttonToSwitchState" @click="deleteArticle(article.id)">Desativar</button>
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
    <div v-if="currentCard === 6" class="section">
      <div class="section box ">
        <div v-for="articles in disabledArticles" class="columns is-vcentered">
          <div class="box column">
            {{ articles.title }}<br>
            {{ articles.content }}
          </div>
          <button class="button column  is-2 buttonToSwitchState" @click="undoArticle(articles.id)">Ativar</button>
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


import CKEditor from "@ckeditor/ckeditor5-vue2";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import {instance} from "@/main";
import Cookies from "js-cookie";


export default {
  props: [`SelectedOption`],
  name: "BlogManager",
  components: {
    ckeditor: CKEditor.component
  },
  mounted(){
    console.log(this.SelectedOption.addButtonLabel);
  },
  data() {
    return {
      editor: ClassicEditor,
      editorDataText: '',
      editorDataTitle:'',
      editorConfig: {},

      insertService: 1,
      activeService: 2,
      disableService: 3,
      insertArticle: 4,
      activeArticle: 5,
      disableArticle: 6,
      newTitle: '',
      newCategory: '',
      currentCard: '',
      newContent: '',
      textError: '',
      sendData: false,
      currentArticles: [],
      disabledArticles: [],
      currentServices: [],
      disabledServices: [],
      id: '',
      content: '',
      title: '',
      godResponseToDelete: false,
      badResponseToDelete: '',
      badResponseToActive: '',
      articlesGetted: [],
      activeArticles: [],
    }
  },
  methods: {
    setPanel(value) {
      this.currentCard = value;
      this.sendData = false;
      this.textError = '';
      this.badResponseToDelete = '';

      if (this.currentCard === this.activeArticle || this.currentCard === this.disableArticle) {
        instance.get('/article')
            .then((response) => {
              this.articlesGetted = response.data.articles;
              this.currentArticles = response.data.articles;
              this.activeArticles = this.currentArticles.filter((article) => !article.deleted_at);
              this.disabledArticles = this.currentArticles.filter((article) => article.deleted_at);
            })
            .catch((error) => {
              this.textError = error;
            })
      }
      if (this.currentCard === this.activeService || this.currentCard === this.disableService) {
        instance.get('/Service')
            .then((response) => {
              if (response.data.enabled) {
                this.currentServices = response.data.enabled;
              }
              if (response.data.disabled) {
                this.disabledServices = response.data.disabled;
              }
            })
            .catch((error) => {
              this.textError = error;
            })
      }
    },
    newArticle() {
      this.textError = '';
      instance.post('/article', {
        'title': this.newTitle,
        'content': this.editorDataText,
        'category': this.newCategory,
        'author': Cookies.get('userName'),
      })
          .then((response) => {
            this.sendData = true;
            setTimeout(() => {
              this.sendData = false;
            }, 2000,)
            this.editorDataText = '';
            this.newTitle = '';
            this.newCategory = '';
          })
          .catch((error) => {
            this.textError = error;
            setTimeout(() => {
              this.textError = '';
            }, 2000,)
          })
    },
    newService() {
      this.textError = '';
      if (this.editorDataTitle !== '' && this.editorDataText !== '') {
        instance.post('/Service', {
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
    deleteArticle(articleId) {
      instance.delete(`/article/${articleId}`)
          .then((response) => {
            this.currentCard = 0;
          })
          .catch((error) => {
            this.badResponseToDelete = error;
          })
    },
    deleteService(serviceId) {
      instance.delete(`/${serviceId}`)
          .then((response) => {
            this.currentCard = 0;
          })
          .catch((error) => {
            this.badResponseToDelete = error;
          })
    },
    undoArticle(articleId) {
      instance.put(`/article/${articleId}`)
          .then((response) => {
            this.currentCard = 0;
          })
          .catch((error) => {
            this.badResponseToActive = error;
          })
    },
    undoService(serviceId) {
      instance.post(`/${serviceId}`)
          .then((response) => {
            this.currentCard = 0;
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

.buttonToSwitchState {
  margin: 5px;
}
</style>