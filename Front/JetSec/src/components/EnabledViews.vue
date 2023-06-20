<template>
  <div id="app">
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
</template>

<script>
import {instance} from "@/main";
export default {
  name: 'EnabledViews',
  data() {
    return {
      currentArticles: [],
      currentServices: [],
      articlesGetted: [],
      activeArticles: [],
    }
  },
  methods:{
    deleteArticle(articleId) {
      instance.delete(`/article/${articleId}`)
          .then((response) => {
            this.currentCard = 0;
          })
          .catch((error) => {
            this.badResponseToDelete = error;
          })
    },
  }
}
</script>

<!--  if (this.currentCard === this.activeArticle || this.currentCard === this.disableArticle) {
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
-->