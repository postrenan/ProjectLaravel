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
            <router-link to="/home">Contato</router-link>
          </li>
          <li class="navbar-item" id="clientArea">
            <router-link to="/home">Logout</router-link>
          </li>
        </ul>
      </div>
    </nav>
    <div class="main">
      <div class="section columns has-text-centered ">
        <div class="column">
          <h2 @click="setPanel(insertArticle)" class="button ">Adicionar artigo</h2>
        </div>
        <div class="column">
          <h2 @click="setPanel(activeArticle)" class="button">Artigos ativos</h2>
        </div>
        <div class="column">
          <h2 @click="setPanel(disableArticle)" class="button">Artigos desativados</h2>
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
          <div class="box">
            <label>Insira o autor</label>
            <ckeditor :editor="editor" v-model="editorDataSign" :config="editorConfig"></ckeditor>
          </div>
          <div class="box">
            <label>Insira a categoria</label>
            <ckeditor :editor="editor" v-model="editorDataCategory" :config="editorConfig"></ckeditor>
          </div>
          <div>
            <button @click="newArticle" class="button">Criar</button>
          </div>
          <div>
            <br>
            <h2 class="box" v-if="textError!== ''">{{ textError }}</h2>
          </div>
          <div>
            <br>
            <h2 class="box" v-if="sendData">Novo artigo criado com sucesso</h2>
          </div>
        </div>
      </div>
      <div v-if="currentCard === 2" class="section">
        <div class="section box">
          <div v-for="article in activeArticles" class="columns">
            <div class="box column">
              {{ article.title }}<br>
              {{ article.content }}
            </div>
            <button class="button column is-vcentered is-2" @click="deleteArticle(article.id)">delete</button>
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
          <div v-for="articles in disabledArticles" class="columns">
            <div class="box column">
              {{ articles.title }}<br>
              {{ articles.content }}
            </div>
            <button class="button column is-vcentered is-2" @click="undoArticle(articles.id)">Ativar</button>
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
  </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue2';
import axios from 'axios';

export default {
  name: "BlogManager",
  components: {
    ckeditor: CKEditor.component
  },
  data() {
    return {
      editor: ClassicEditor,
      editorDataTitle: '',
      editorDataText: '',
      editorDataSign: '',
      editorDataCategory: '',
      editorConfig: {},
      insertArticle: 1,
      activeArticle: 2,
      disableArticle: 3,
      currentCard: '',
      newContent: '',
      textError: '',
      sendData: false,
      currentArticles: [],
      disabledArticles: [],
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
        axios.get('http://127.0.0.1:8000/api/article')
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
    },
    newArticle() {
      this.textError = '';

      axios.post('http://127.0.0.1:8000/api/article', {
        'title': this.editorDataTitle,
        'content': this.editorDataText,
        'author': this.editorDataSign,
        'category': this.editorDataCategory,
      })
          .then((response) => {
            this.sendData = true;
            this.editorDataText = '';
            this.editorDataTitle = '';
            this.editorDataSign = '';
            this.editorDataCategory = '';
          })
          .catch((error) => {
            this.textError = error;
          })
    },
    deleteArticle(articleId) {
      axios.delete(`http://127.0.0.1:8000/api/article/${articleId}`)
          .then((response) => {
            this.currentCard = 0;
          })
          .catch((error) => {
            this.badResponseToDelete = error;
          })
    },
    undoArticle(articleId) {
      axios.put(`http://127.0.0.1:8000/api/article/${articleId}`)
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

.main {
  background-color: #1c7430;

}

</style>