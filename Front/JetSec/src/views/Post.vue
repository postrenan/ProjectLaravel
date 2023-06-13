<template>
  <div id="#app">
    <div class="section columns">
      <h1 v-if="setErrorMsg">{{ errorMessage }}</h1>
      <div class="column is-2"></div>
      <div class="column" v-for="article in dbResponsePost">
        <router-link to="/blog"><p class="button is-small is-rounded  is-success is-light">Home</p></router-link>
        <h1 class="title has-text-light" v-html="article.title"/>
        <p class="tag is-rounded is-primary is-light" v-html="article.category"/>
        <p v-html="article.created"/>
        <div class="columns">
          <div class="column is-2"></div>
          <div class="is-centered">
            <p class="content column  has-text-justified" v-html="article.content"/>
            <p v-if="!validateCopy" class="has-text-centered">Compartilhe esse post</p>
            <p v-if="validateCopy" class="subtitle has-text-centered has-text-light ">Link copiado com sucesso</p>
            <div class="has-text-centered ">
              <a href="https://www.instagram.com/jetimob_/"><i class="fa-brands fa-instagram  shareIcons"></i></a>
              <a @click="copyURL"><i class="fa-solid fa-link shareIcons"></i></a>
              <a href="https://www.facebook.com/jetimob/?locale=pt_BR"><i class="fa-brands fa-facebook  shareIcons"></i></a>
              <a href="https://wa.me/55997038314"><i class="fa-brands fa-whatsapp shareIcons"></i></a>
            </div>
            <h2 class="title has-text-light">Escrito por</h2>
            <div class=" columns is-vcentered  boxAuthor">
                <a class="fa-solid fa-user fa-xl  iconAuthor"></a>
                <p class="subtitle column  is-5 " v-html="article.author"/>
            </div>
            <div class="column is-4"></div>
          </div>
        </div>
      </div>
      <div class="column is-2"></div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  props: ['slug'],
  name: 'post',
  data() {
    return {
      postSlug: '',
      dbResponsePost: '',
      errorMessage: '',
      setErrorMsg: false,
      validateCopy: false,
    }
  },
  created() {
    this.postSlug = this.$router.currentRoute.params.slug
    axios.get(`http://localhost:8000/api/article-page?search=${this.postSlug}`,)
        .then((response) => {
          this.dbResponsePost = response.data.article;
          this.setErrorMsg = false;
          this.titles = this.dbResponsePost.map((article) => {
            return {
              title: article.title,
              content: article.content,
              author: article.author,
              category: article.category,
              created: article.created_at,
            }
          });
        })
        .catch((error) => {
          this.setErrorMsg = true;
          this.errorMessage = error;
        })

  },
  methods: {
    copyURL(){
      navigator.clipboard.writeText(`http://localhost:8000/api/article-page?search=${this.postSlug}`);

      setTimeout(() => {
        this.validateCopy = true;
      }, 1000, )
      setTimeout(() => {
        this.validateCopy = false;
      }, 5000, )

    }

  },
}
</script>

<style scoped>
.section {
  background-color: #4eb2c2;
  color: #FFFFFFFF;
  text-decoration: none;
  min-height: 40rem;
}

.shareIcons{
  margin: 10px;
  padding: 10px;
  background-color: #095a69;
  background-size: 20px;
  border-radius: 40px;
}

a{
  color:#ffffff;
  text-decoration: none;
}

.shareIcons:hover{
  background-color: #01cdf1;
}

.boxAuthor{
  padding: 5px;
}

.iconAuthor{
  border-radius: 50px;
  color: #ffffff;
  padding: 10px;
  margin: 2px;
}
</style>