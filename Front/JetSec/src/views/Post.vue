
<template>
  <div id="#app">
    <div class="section">
      <div class="header">

      </div>
      <div class="content">

      </div>
      <div class="author">

      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default{
  props: ['slug'],
  name: 'post',
  data(){
    return{
      postSlug: '',
      dbResponseKeys: [],
    }
  },
  created(){

    this.postSlug = this.$router.currentRoute.params.slug
    console.log(this.postSlug);
    axios.get(`http://localhost:8000/api/article/${this.postSlug}`)
        .then((response) =>{
              this.dbResponseKeys = response.data.articles;
              console.log(this.dbResponseKeys)

        })
        .catch((error) =>{

        })
  },
  methods:{

  },
}
</script>

<style scoped>

</style>