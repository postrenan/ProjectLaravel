<template>
<div id="app">
    <div class="section has-text-centered">

      <h2><strong>O cuidado que você merece</strong></h2>
        <div class="section columns ">
            <div v-for="service in currentServices" class="column box">
              <h2><strong>{{service.title}}</strong></h2>
                <p>{{service.content}}</p>
            </div>

        </div>
        <div class="section columns">

        </div>
    </div>
  <div>
    <router-link class="button" to="/RestrictArea">Area restrita</router-link>
  </div>
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
div .box{
  background-color: #d6e8ee;
  margin: 0 10px 0 10px;

}

</style>