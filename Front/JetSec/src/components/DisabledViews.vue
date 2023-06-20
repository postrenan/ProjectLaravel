<template>
  <div id="app">
    <div class="section box ">
      <div v-for="articles in disabledArticles" class="columns is-vcentered">
        <div class="box column">
          {{ articles.title }}<br>
          {{ articles.content }}
        </div>
        <button class="button column  is-2 buttonToSwitchState" @click="undoArticle(articles.id)">Ativar</button>
      </div>
      <div>
        <p class="box">{{ badResponseToActive }}</p>
      </div>
    </div>
    <div>
      <br>
      <h2 class="box">{{ textError }}</h2>
    </div>
    <div class="section box ">
      <div v-for="service in disabledServices" class="columns is-vcentered">
        <div class="box column">
          {{ service.title }}<br>
          {{ service.content }}
        </div>
        <button class="button column is-2 buttonToSwitchState" @click="undoService(service.id)">Ativar</button>
      </div>
      <div>
        <p class="box">{{ badResponseToActive }}</p>
      </div>
    </div>
    <div>
      <br>
      <h2 class="box">{{ textError }}</h2>
    </div>
  </div>
</template>

<script>
import {instance} from "@/main";

export default {
  name: 'DisabledViews',
  data() {
    return {
      disabledArticles: [],
      disabledServices: [],
    }
  },
  methods: {
    undoArticle(articleId) {
      instance.put(`/article/${articleId}`)
          .then((response) => {
            this.currentCard = 0;
          })
          .catch((error) => {
            this.badResponseToActive = error;
          })
    },
  }
}
</script>

<style scoped>

</style>