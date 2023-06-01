<template>
<div id="app">
    <div class="navbar-brand" >
    <div class="navbar-item ">
      <router-link to="/"><img src="../assets/rocket.png" alt="Foguete azul"></router-link>
      <h2 class="title"><i>Blog</i> JetMonitoramentos</h2>
    </div>
      <div class="navbar-end">
      <div class="navbar-menu" id="nav-links">
        <ul class="navbar-end" id="navbarForms">
          <div class=" navbar-item has-dropdown button is-rounded is-hoverable botaoDropDown  ">
            <a class="navbar-link  navbarDrop button is-rounded" >
              Categorias
            </a>
            <div class="navbar-dropdown is-rounded">
              <a class="navbar-item navbarDrop" >
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
          <div class="field has-addons">
            <p class="control select">
              <input v-model="searchWord" class="input is-rounded " type="text" placeholder="Find a post" >
                <select >
                  <option></option>
                </select>

            </p>
            <p class="control">
              <button class="button" @click="findWord(searchWord)">Buscar</button>
            </p>
          </div>
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

        <article class="tile is-child notification has-text-centered " v-for="article  in currentArticles" v-if="article.id === 1" >

          <p class="">{{article.title}}</p>
          <p class="">{{article.content}}</p>
          <p class="">{{article.author}}</p>
          <p class="">{{article.category}}</p>
        </article>
        <div class="tile is-vertical column is-4">
          <div class="tile">
            <div class="tile is-parent is-vertical">
              <article class="tile is-child notification " v-for="article  in currentArticles">
                <div class="content">
                  <img>
                  <p class="">{{article.category}}</p>
                  <p class="">{{article.title}}</p>
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
      <article class="column is-one-third box mosaicService" v-for="article in currentArticles" v-if="article.id !== 12" >
        <i class=""></i>
        <p class="">{{article.title}}</p>
        <p class="">{{article.content}}</p>
        <p class="">{{article.author}}</p>
        <p class="">{{article.category}}</p>
      </article>
    </div>
    <button class="button">Carregar mais posts</button>
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
          <button class=" column button">Cadastrar</button>
        </div>

      </div>
    </div>
    </div>

  </div>
</div>
</template>

<script >
import axios from 'axios';
export default {

  name:"Blog",
  data(){
    return{
      currentArticles: '',
      arrayArticles: [],
      searchWord: '',
      articleFinded:'',

    }
  },
  created() {
    axios.get('http://127.0.0.1:8000/api/ArticlesStorage')
        .then((response) => {
          this.currentArticles = response.data;
          this.arrayArticles = response.data;
        })
        .catch((error) => {
          this.textError = error;
        })


  },
  methods:{
    findWord(searchWord){
     axios.post(`http://127.0.0.1:8000/api/ArticlesStorage/${searchWord}`)
         .then((response)=>{
            this.articleFinded =response.data;
         })
         .catch((error) =>{

         })
    }
  },
}

</script>

<style scoped>
*{
  background: #053b44;
  color: #ffffff;
}

.title{
  color: #ffffff;
}
.navbarDrop{
  background:  #053b44;
  color: white;
}

.tituloPagina{
  font-size: 1.4rem;
  font-family: "Source Code Pro", "SFMono-Regular", Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
  color: #ffffff;
}

.botaoDropDown{
  margin-top: 15px;
  background-color:  #053b44;
  color:white;
}

.navbar-brand{
  margin: 0;
}

.newsLetterBox{
  border-style: solid;
  border-color: #02B9FB;
  border-radius: 25px;
}

.notification{
  background: #053b44;
}

</style>