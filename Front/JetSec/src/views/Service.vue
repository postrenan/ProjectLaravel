<template>
<div id="app">

      <section class="section" id="Services">
        <p class="column has-text-centered title">O cuidado que você merece</p>
        <div class=" has-text-centered">
          <div class=" columns is-multiline ">
            <article class="column is-one-fifth box mosaicService" v-for="service in currentServices" >
              <i class=""></i>
              <p class="title">{{service.title}}</p>
              <p class="subtitle">{{service.content}}</p>
            </article>
          </div>
        </div>
      </section>
    <router-link class="button" to="/RestrictArea">Area restrita</router-link>
</div>
</template>

<script >
import axios from "axios";

export default {
  name: "Service",
  data(){
    return{
      currentServices: [],
    }
  },
  created() {
    axios.get('http://127.0.0.1:8000/api/Service')
        .then((response) => {
          this.currentServices = response.data;
        })
        .catch((error) => {

        })
  },
}
</script>

<style scoped>
.box{
  background-color: #d6e8ee;
  margin: 10px;
}

</style>