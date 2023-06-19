<template>
  <div id="app">
    <div class="navbar-brand">
      <div class="navbar-item ">
        <router-link to="/"><img src="../assets/rocket.png" alt="Foguete azul"></router-link>
        <h2 class="title has-text-light"><i>Blog</i> JetMonitoramentos</h2>
      </div>
      <div class="navbar-end">
        <div class="navbar-menu" id="nav-links">
          <div class="level-item">
            <div class="field has-addons ">
              <h2 class="control">
                <input v-model="searchArticleInput" class="input is-rounded" type="text"
                       placeholder="Procure um artigo">
              </h2>
              <h2 class="control">
                <button @click="findArticle(searchArticleInput)" v-if="this.searchArticleInput.length >= 3" class="button  is-rounded">Buscar</button>
              </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="keyWordGetted" class=" ">
      <div class="columns ">
        <div class="column"></div>
        <div class="column is-2 has-text-centered">
          <div class="content  searchContent" v-for="title in titles">
                <router-link class="box has-text-light searchInput has-text-centered" :to="{name: 'post', params:{slug: title.slug}}" v-html="title.title"></router-link>
          </div>
          <button class="button is-small is-rounded " @click="keyWordGetted = false">fechar</button>
        </div>
      </div>
    </div>
    <div class="section has-text-centered has-text-light pageTitle">
      <h1 class="title is-1 has-text-light">Monitora Blog</h1>
      <h2 class="has-text-light">O melhor portal de conteúdo sobre o mercado de segurança</h2>
    </div>
    <div class="section ">
      <h2 class="title has-text-centered  has-text-light">Conteúdos em destaque</h2><br>
      <div class="columns is-centered">
        <article class="column is-3 has-text-centered box topPost" v-for="(article, index) in highlightsPost" v-if="highlightsPost.length">
          <router-link :to="{name: 'post', params:{slug: article.slug}}">
            <h3 class="title has-text-light" v-html="article.title">{{ article.title }}</h3>
          </router-link>
          <br>
<!--          TODO: Text overflow ellipsis-->
<!--          TODO: CÓDIGO DUPLICADO-->
          <router-link :to="{name: 'post', params:{ slug: article.slug }}"><h3 v-html="article.content.substring(3,100)" class="content has-text-light"></h3> </router-link>
          <br>
          <router-link :to="{name: 'post', params:{ slug: article.slug }}" class="tag is-rounded"><p>{{ article.date }}</p></router-link>
        </article>
      </div>
    </div>
    <div class="section  has-text-centered ">
      <h2 class="title is-2 has-text-light">Todos os post</h2>
      <div class="is-multiline columns is-centered">
        <article class="is-one-fifth-desktop box mosaicService column " v-for="(article, index) in articles" v-if="article.deleted == null">
          <router-link :to="{name: 'post', params:{slug: article.slug}}"><h3 v-html="article.title" class="title has-text-light"></h3></router-link>
          <br>
          <router-link :to="{name: 'post', params:{slug: article.slug}}"><h3 v-html="article.content.substring(3,170)" class="content has-text-light" ></h3></router-link>
          <br>
          <router-link :to="{name: 'post', params:{slug: article.slug}}"><h3>{{ article.date }}</h3></router-link>
        </article>

      </div>
    </div>
    <div class="section is-centered columns">
      <div class="section newsLetterBox">
        <div class="columns  is-vcentered">
          <div class="column has-text-centered msgNewsLetter">
            <h2 class="title has-text-light">Quer saber mais sobre monitoramento e segurança?</h2>
            assine nossa newsletter e fique por dentro
          </div>
          <div class="column is-4  ">
            <div class="columns is-vcentered">
              <input placeholder="meuemail@email.com" class="column input is-rounded " type="text" size="3">
              <button v-model="emailNewsLetter" @click="sendEmail" class="column is-3 button is-small is-rounded buttonNews">Cadastrar
              </button>
            </div>
            <span v-if="emailHasSend">Email cadastrado com sucesso</span>
            <span v-if="emailHasFailed">Email não valido</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import axios from 'axios';
import {instance} from '@/main'
export default {

  name: "Blog",
  data() {
    return {
      currentArticles: '',
      searchArticleInput: '',
      keyWordGetted: false,
      titles: '',
      dbResponseKeys: '',
      articles: [],
      emailNewsLetter: '',
      emailHasSend: false,
      emailHasFailed: false,
      moreArticles: '',
      highlightsPost: [],
      articlesLimit: 10,
      setY: 218,
    }
  },
   async created() {
     await instance.get('/article')
        .then((response) => {
          this.currentArticles = response.data.articles;
          this.articles = this.currentArticles.map((article) => {
            return {
              title: article.title,
              slug: article.slug,
              content: article.content,
              date: article.created_at,
            }
          });
        })
        .catch((error) => {
          this.textError = error;
        });
    window.addEventListener('scroll', this.handleScroll);

    this.highlightsPost = this.articles.slice(0,2);
  },
  methods: {
    findArticle(keyWord) {
      instance.get(`/article`, { params: { search: keyWord } })
          .then((response) => {
            this.keyWordGetted = true;
            this.dbResponseKeys = response.data.articles;
            this.titles = this.dbResponseKeys.map((article) => {
              return {
                title: article.title,
                slug: article.slug,
                content: article.content,
                date: article.created_at,
              }
            });
          })
          .catch((error) => {

          })
    },
    sendEmail() {
      if (this.emailNewsLetter !== '') {
        this.emailHasSend = true;
      } else {
        this.emailHasFailed = true;
      }
    },
  },
}

</script>

<style scoped>
* {
  background: #053b44;
  color: white;
}

.navbar-brand {
  margin: 0;
}

.newsLetterBox {
  border-style: solid;
  border-color: #02B9FB;
  border-radius: 25px;
}

.box {
  background: #055f70;
}

p {
  color: #000000;
  background-color: #F5F5F5;
}

h3 {
  background-color: #055f70;
}

.mosaicService {
  padding: 5px;
  margin-left: 5px;
  margin-bottom: 24px;
}

.navbar-item {
  color: #000000;
}

.searchInput {
  margin: 25px;
}

ul{
  margin: 0;
}

.buttonNews {
  margin-left: 5px;
  padding: 0 0;
}

.topPost{
  margin:  24px;
}

.level-item{
  margin-right: 15px;
}

</style>