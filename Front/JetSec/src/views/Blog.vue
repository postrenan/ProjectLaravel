<template>
  <div id="app">
    <div class="navbar-brand">
      <div class="navbar-item ">
        <router-link to="/"><img src="../assets/rocket.png" alt="Foguete azul"></router-link>
        <h2 class="title has-text-light"><i>Blog</i> JetMonitoramentos</h2>
      </div>
      <div class="navbar-end">
        <div class="navbar-menu" id="nav-links">
          <ul class="navbar-end " id="navbarForms">
            <div class=" navbar-item has-dropdown button is-rounded is-hoverable botaoDropDown ">
              <a class="navbar-link   button is-rounded">
                Categorias
              </a>
              <div class="navbar-dropdown is-boxed">
                <a class="navbar-item">
                  Venda
                </a>
                <a class="navbar-item">
                  Carreira
                </a>
                <a class="navbar-item">
                  Segurança
                </a>
                <a class="navbar-item">
                  Tecnologia
                </a>
                <a class="navbar-item">
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
    <div class="section has-text-centered has-text-light tituloPagina">
      <h1 class="title is-1 has-text-light">Blog da Jet Monitoramentos</h1>
      <p class="has-text-light">O melhor portal de conteúdo sobre o mercado de segurança</p>
    </div>
    <div class="section">
      <h2 class="title has-text-light">Conteúdos em destaque</h2>
      <div>
        <div class="section columns">
          <div class="tile is-ancestor column">
            <article class="tile is-child  has-text-centered box "
                     v-for="(article, index) in currentArticles" v-if="index <= 0">
              <img alt="imagem interessante sobre algo " src="https://www.jetimob.com/blog/content/images/size/w1200/2023/06/predio_comercial.webp">
              <router-link :to="{name: 'post', params:{slug: article.slug}}" class="has-text-light"
                           v-html="article.title"></router-link>
              <router-link :to="{name: 'post', params:{slug: article.slug}}" class="has-text-light "
                           v-html="article.category"></router-link>
              <router-link :to="{name: 'post', params:{slug: article.slug}}" class="has-text-light"
                           v-html="article.author"></router-link>
            </article>
            <div class="tile is-vertical column is-4">
              <div class="tile">
                <div class="tile is-parent is-vertical">
                  <article class="tile box is-child  " v-for="(article, index)  in currentArticles"
                           v-if="index <= 3">
                    <div class="content has-text-light">
                      <router-link :to="{name: 'post', params:{slug: article.slug}}" class="has-text-light"
                                   v-html="article.category"></router-link>
                      <router-link :to="{name: 'post', params:{slug: article.slug}}" class="has-text-light"
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
      <h2 class="title is-2 has-text-light">Post mais recentes</h2>
      <div class="section column is-multiline">
        <article class="column box is-one-third  " v-for="article in currentArticles">
          <i class=""></i>
          <router-link :to="{name: 'post', params:{slug: article.slug}}" v-html="article.title"></router-link>
          <router-link :to="{name: 'post', params:{slug: article.slug}}" v-html="article.author"></router-link>
          <router-link :to="{name: 'post', params:{slug: article.slug}}" v-html="article.category"></router-link>
        </article>
      </div>
      <button class="button is-rounded">Carregar mais posts</button>
    </div>
    <div class="section is-centered columns  ">
      <div class="section newsLetterBox">
        <div class="columns  is-vcentered ">
          <div class="column has-text-centered msgNewsLetter">
            <h2 class="title has-text-light">Quer saber mais sobre monitoramento e segurança?</h2>
            <p >assine nossa newsletter e fique por dentro </p>
          </div>
          <div class="column is-4  ">
            <div class="columns ">
              <input class="column input is-rounded " type="text" size="8">
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

.box {
  background: #055f70;
}

.navbar-item {
  color: #000000;
}

</style>