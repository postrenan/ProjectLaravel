<template>
  <div>
    <div  v-if="SelectedOption === 1">
      <div class="section box ">
        <div v-for="service in disabledServices" class="columns is-vcentered">
          <div class="box column">
            {{ service.title }}<br>
            {{ service.content }}
          </div>
          <button class="button column is-2 buttonToSwitchState" @click="undoFunction(service.id)">Ativar</button>
        </div>
        <div v-if="badResponseToActive !== ''">
          <p class="box">{{ badResponseToActive }}</p>
        </div>
      </div>
      <div v-if="textError !== ''">
        <br>
        <h2 class="box">{{ textError }}</h2>
      </div>
    </div>
    <div v-if="SelectedOption === 2">
      <div  class="section box ">
        <div v-for="articles in disabledArticles" class="columns is-vcentered">
          <div class="box column">
            {{ articles.title }}<br>
            {{ articles.content }}
          </div>
          <button class="button column  is-2 buttonToSwitchState" @click="undoFunction(articles.id)">Ativar</button>
        </div>
        <div v-if="badResponseToActive !== ''" >
          <p class="box">{{ badResponseToActive }}</p>
        </div>
      </div>
      <div v-if="textError !== ''">
        <br>
        <h2  class="box">{{ textError }}</h2>
      </div>
    </div>
  </div>

</template>

<script>
import {instance} from "@/main";

export default {
  props: [`SelectedOption`],
  name: 'DisabledViews',
  data() {
    return {
      disabledArticles: [],
      disabledServices: [],
      badResponseToActive: '',
      textError: '',
    }
  },
  mounted(){
      instance.get('/service')
          .then((response) => {
            this.currentServices = response.data.services;
            this.disabledServices = this.currentServices.filter((service) => service.deleted_at);
          })
          .catch((error) => {
            this.textError = error;
          });
      instance.get('/article')
          .then((response) => {
            this.currentArticles = response.data.articles;
            this.disabledArticles = this.currentArticles.filter((article) => article.deleted_at);
          })
          .catch((error) => {
            this.textError = error;
          })

  },
  methods: {
    undoFunction(id) {
      if(this.SelectedOption === 1){
        instance.put(`/service/${id}`)
            .then((response) => {
              this.$router.go(0);
            })
            .catch((error) => {
              this.badResponseToActive = error;
            })
      }else{
        instance.put(`/article/${id}`)
            .then((response) => {
              this.$router.go(0);
            })
            .catch((error) => {
              this.badResponseToActive = error;
            })
      }
    },
  }
}
</script>