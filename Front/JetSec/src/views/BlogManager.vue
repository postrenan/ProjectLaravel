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
            <label>insira a imagem(em forma de html)</label><br>
            <input type="text" v-model="newImage" ></input>
          </div>
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
      <div v-if="currentCard === 2" class="section">
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
      <div v-if="currentCard === 3" class="section">
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
    </div>
  </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue2';
import axios from 'axios';
import Cookies from 'js-cookie'
import {instance} from '@/main'
export default {
  name: "BlogManager",
  components: {
    ckeditor: CKEditor.component
  },
  data() {
    return {
      editor: ClassicEditor,
      editorDataText: '',
      editorConfig: {},
      insertArticle: 1,
      activeArticle: 2,
      disableArticle: 3,
      newTitle: '',
      newCategory: '',
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
      newImage:'',
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
            }, 2000, )
            this.editorDataText = '';
            this.newTitle = '';
            this.newCategory = '';
          })
          .catch((error) => {
            this.textError = error;
            setTimeout(() => {
              this.textError = '';
            }, 2000, )
          })
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
    undoArticle(articleId) {
      instance.put(`/article/${articleId}`)
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
  min-height: 40rem;
}


.buttonToSwitchState{
  margin: 5px;
}
</style>