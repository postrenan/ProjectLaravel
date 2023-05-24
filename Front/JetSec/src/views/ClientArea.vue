<template>
<div id="app">
        <div class="section columns ">
          <h2 class="column-is-1 box">Olá {{email}}</h2>
        </div>
        <div class="section">
          <div class="columns box">
            <div class="column">
              <p >sistemas de segurança em uso: </p>
            </div>
            <div class="column">
              <p >faturas:</p>
            </div>
            <div class="column">
              <p >sistemas em uso: </p>
            </div>
          </div>
        </div>
</div>
</template>

<script >
import Cookies from "js-cookie";
export default {
    name: "ClientArea",
  data(){
    return{
      email: '',
    }
  },
  mounted() {

    this.email = Cookies.get('email');
    console.log(this.email);
  }
}
</script>

<style scoped>
  .section {
  margin: 0px;
  }

  #app{
    background: #0f6674;
    min-height: 40rem;
  }
</style>