
<template>
  <div id="#app">
    <div class="section ">
      <h1 v-if="setErrorMsg">{{errorMessage}}</h1>
      <div v-for="article in dbResponsePost">
        <p class="tag is-rounded" v-html="article.category"/>
        <h1 class="title" v-html="article.title"/>
        <p class="subtitle" v-html="article.author"/>
        <p v-html="article.created"/>
        <p class="content has-text-justified" v-html="article.content"></p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default{
  props: ['slug'],
  name: 'post',
  data(){
    return{
      postSlug: '',
      dbResponsePost: '',
      errorMessage: '',
      setErrorMsg: false,
    }
  },
  created(){
    this.postSlug = this.$router.currentRoute.params.slug
    axios.get(`http://localhost:8000/api/article-page?search=${this.postSlug}`, )
        .then((response) => {
          this.dbResponsePost = response.data.article;
          this.setErrorMsg = false;
          this.titles = this.dbResponsePost.map((article) => {
            return {
              title: article.title,
              content: article.content,
              author: article.author,
              category: article.category,
              created : article.created_at,
            }
          });
        })
        .catch((error) =>{
            this.setErrorMsg = true;
            this.errorMessage = error;
        })

  },
  methods:{

  },
}
</script>

<style scoped>

</style>