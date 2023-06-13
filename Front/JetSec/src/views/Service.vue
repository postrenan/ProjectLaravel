<template>
  <div id="app">

    <section class="section" id="Services">
      <p class="column has-text-centered title">O cuidado que você merece</p>
      <div class=" has-text-centered">
        <div class=" columns is-multiline is-centered">
          <span v-if="errorInResponse" class="">{{ errorMsg }}</span>
          <article class="column is-one-fifth box mosaicService" v-for="service in currentServices">
            <i class=""></i>
            <p class="title">{{ service.title }}</p>
            <p class="subtitle">{{ service.content }}</p>
          </article>
        </div>
      </div>
    </section>
    <router-link class="button" to="/restrict-area">Area restrita</router-link>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Service",
  data() {
    return {
      currentServices: [],
      errorMsg: '',
      errorInResponse: false,
    }
  },
  created() {
    axios.get('http://127.0.0.1:8000/api/Service')
        .then((response) => {
          this.currentServices = response.data.enabled;
        })
        .catch((error) => {
          this.errorInResponse = true;
          this.errorMsg = error;
        })
  },
}
</script>

<style scoped>
.box {
  background-color: #d6e8ee;
  margin: 10px;
}

</style>