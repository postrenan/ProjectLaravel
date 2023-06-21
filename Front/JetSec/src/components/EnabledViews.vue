<template>
  <div >
    <div v-if="this.SelectedOption === 1">
      <div  class="section box">
        <div v-for="service in activeServices" class="columns is-vcentered">
          <div class="box column">
            {{ service.title }}<br>
            {{ service.content }}
          </div>
          <button class="button column  is-2 buttonToSwitchState" @click="deleteFunction(service.id)">delete</button>
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
    <div v-if="SelectedOption === 2" class="section box">
      <div v-for="article in activeArticles" class="columns is-vcentered">
        <div class="box column">
          {{ article.title }}<br>
          {{ article.content }}
        </div>
        <button class="button column is-2 buttonToSwitchState" @click="deleteFunction(article.id)">Desativar</button>
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
  props: [`SelectedOption`],
  name: 'EnabledViews',
  data() {
    return {
      currentArticles: [],
      currentServices: [],
      articlesGetted: [],
      activeArticles: [],
      activeServices: [],
      badResponseToDelete: '',
      textError: '',
    }
  },
  created() {

      instance.get('/service')
          .then((response) => {
            this.currentServices = response.data.services;
            this.activeServices = this.currentServices.filter((service) => !service.deleted_at);

          })
          .catch((error) => {
            this.textError = error;
          });

      instance.get('/article')
          .then((response) => {
            this.articlesGetted = response.data.articles;
            this.currentArticles = response.data.articles;
            this.activeArticles = this.currentArticles.filter((article) => !article.deleted_at);
          })
          .catch((error) => {
            this.textError = error;
          })

  },
  methods: {
    deleteFunction(id) {
      if (this.SelectedOption === 1) {
        instance.delete(`/service/${id}` )
            .then((response) => {
              this.$router.go(0);
            })
            .catch((error) => {
              this.badResponseToDelete = error;
            })
      } else {
        instance.delete(`/article/${id}`)
            .then((response) => {
              this.$router.go(0);
            })
            .catch((error) => {
              this.badResponseToDelete = error;
            })
      }
    },
  }
}
</script>
