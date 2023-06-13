<template>
  <div id="#app">
    <div class="section columns">
      <h1 v-if="setErrorMsg">{{ errorMessage }}</h1>
      <div class="column is-2"></div>
      <div class="column" v-for="article in dbResponsePost">
        <router-link to="/blog"><p class="button is-small is-rounded">Home</p></router-link>
        <h1 class="title has-text-light" v-html="article.title"/>
        <p class="tag is-rounded" v-html="article.category"/>
        <p v-html="article.created"/>
        <div class="columns">
          <div class="column is-2"></div>
          <div><p class="content column has-text-justified" v-html="article.content"/>
            <p class="has-text-centered">Compartilhe esse post</p>
            <div class="has-text-centered">

            </div>
            <h2>Escrito por</h2>
            <div class="box">

              <p class="subtitle" v-html="article.author"/>
            </div>
            <div class="column is-2"></div>
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
  methods: {},
}
</script>

<style scoped>

svg{
  scale: 5%;
}

.section {
  background-color: #053b44;
  color: #FFFFFFFF;
  text-decoration: none;
  min-height: 40rem;
}
</style>