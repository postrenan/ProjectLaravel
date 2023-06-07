<template>
  <div id="app">
    <div class="navbar-brand">
      <div class="navbar-item ">
        <router-link to="/"><img src="../assets/rocket.png" alt="Foguete azul"></router-link>
        <h2 class="title"><i>Blog</i> JetMonitoramentos</h2>
      </div>
      <div class="navbar-end">
        <div class="navbar-menu" id="nav-links">
          <ul class="navbar-end " id="navbarForms">
            <div class=" navbar-item has-dropdown button is-rounded is-hoverable botaoDropDown ">
              <a class="navbar-link  navbarDrop button is-rounded">
                Categorias
              </a>
              <div class="navbar-dropdown is-boxed">
                <a class="navbar-item navbarDrop">
                  Venda
                </a>
                <a class="navbar-item navbarDrop">
                  Carreira
                </a>
                <a class="navbar-item navbarDrop">
                  Segurança
                </a>
                <a class="navbar-item navbarDrop">
                  Tecnologia
                </a>
                <a class="navbar-item navbarDrop">
                  Materias educativos
                </a>
              </div>
            </div>
          </ul>
          <div class="level-item">
            <div class="field has-addons ">
              <p class="control">
                <input v-model="searchArticleInput" class="input is-rounded" type="text" placeholder="Find a post">
              </p>
              <p class="control">
                <button @click="findArticle(searchArticleInput)" class="button is-rounded">Buscar</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="keyWordGetted" class=" ">
      <div class="">
        <div class="columns ">
          <div class="column"></div>
          <div class="column is-3  ">
            <div class="content  searchContent" v-for="title in titles">
              <ul class="has-text-right is-lower-alpha">
                <ul>
                  <router-link class="box " :to="{name: 'post', params:{slug: title.slug}}"
                               v-html="title.title"></router-link>
                </ul>
              </ul>
            </div>
            <button class="button  is-small is-rounded" @click="keyWordGetted = false">fechar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="section has-text-centered tituloPagina">
      <h1 class="title">Blog da Jet Monitoramentos</h1>
      <p>O melhor portal de conteúdo sobre o mercado de segurança</p>
    </div>
    <div class="section">
      <h2 class="title">Conteúdos em destaque</h2>
      <div>
        <div class="section columns">
          <div class="tile is-ancestor  column">
            <article class="tile is-child notification has-text-centered ">
              <p class="title" v-html=""/>
              <p class="subtitle" v-html=""/>
              <p class="subtitle" v-html=""/>
            </article>
            <div class="tile is-vertical column is-4">
              <div class="tile">
                <div class="tile is-parent is-vertical">
                  <article class="tile box is-child notification " v-for="article  in currentArticles">
                    <div class="content">
                      <img src="">
                      <p class="" v-html="article.category"/>
                      <router-link :to="{name: 'post', params:{slug: article.slug}}"
                                   v-html="article.title"></router-link>
                    </div>
                  </article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section column has-text-centered">

      <h2 class="title">Post mais recentes</h2>
      <div class="section column is-multiline">
        <article class="column box is-one-third  mosaicService" v-for="article in currentArticles">
          <i class=""></i>
          <router-link :to="{name: 'post', params:{slug: article.slug}}" v-html="article.title"></router-link>
          <router-link :to="{name: 'post', params:{slug: article.slug}}" v-html="article.author"></router-link>
          <router-link :to="{name: 'post', params:{slug: article.slug}}" v-html="article.category"></router-link>
        </article>
      </div>
      <button class="button is-rounded">Carregar mais posts</button>
    </div>
    <div class="section is-centered columns ">
      <div class="section ">
        <div class="columns  newsLetterBox">
          <div class="column ">
            <h2 class="title">Quer saber mais sobre monitoramento e segurança?</h2>
            <p>assine nossa newsletter e fique por dentro </p>
          </div>
          <div class="column is-4 ">
            <div class="columns ">
              <input class="column input is-rounded" type="text" size="8">
              <button class=" column button is-rounded">Cadastrar</button>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {

  name: "Blog",
  data() {
    return {
      currentArticles: '',
      searchArticleInput: '',
      keyWordGetted: false,
      titles: '',
      dbResponseKeys: '',
    }
  },
  created() {
    axios.get('http://127.0.0.1:8000/api/article')
        .then((response) => {
          this.currentArticles = response.data.articles;
        })
        .catch((error) => {
          this.textError = error;
        })
  },

  methods: {
    findArticle(keyWord) {
      axios.get(`http://localhost:8000/api/article?search=${keyWord}`)
          .then((response) => {
            this.keyWordGetted = true;
            this.dbResponseKeys = response.data.articles;
            this.titles = this.dbResponseKeys.map((article) => {
              return {
                title: article.title,
                slug: article.slug,
                content: article.content,
              }
            });
          })
          .catch((error) => {

          })
    }
  },
}

</script>

<style scoped>
* {
  background: #053b44;
  color: white;
}

.title {
  color: #ffffff;
}

.navbarDrop {
  background: white;
}

.tituloPagina {
  font-size: 1.4rem;
  font-family: "Source Code Pro", "SFMono-Regular", Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
  color: #ffffff;
}

.botaoDropDown {
  margin-top: 15px;
}

.navbar-brand {
  margin: 0;
}


.newsLetterBox {
  border-style: solid;
  border-color: #02B9FB;
  border-radius: 25px;
}

.notification {
  background: #053b44;
}

</style>