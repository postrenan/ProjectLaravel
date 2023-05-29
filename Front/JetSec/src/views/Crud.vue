<template>
  <div id="app">
    <nav class="navbar" >
      <div class="navbar-brand" >
        <div class="navbar-item ">
          <router-link to="/"><img src="../assets/rocket.png" alt="Foguete azul"></router-link>
        </div>
      </div>
      <div class="navbar-menu" id="nav-links">
        <ul class="navbar-end" id="navbarForms">
          <li class="navbar-item"><router-link to="/home">Home</router-link></li>
          <li class="navbar-item"><router-link to="/about">Sobre</router-link></li>
          <li class="navbar-item"><router-link to="/service">Serviços</router-link></li>
          <li class="navbar-item"><router-link to="/home">Contato</router-link></li>
          <li  class="navbar-item" id="clientArea"><router-link to="/home">Logout</router-link></li>
        </ul>
      </div>
    </nav>
    <div class="section columns has-text-centered ">
      <div class="column">
        <h2 @click="setPanel(insertService)" class="button ">Adicionar serviços</h2>
      </div>
      <div class="column">
        <h2 @click="setPanel(activeService)" class="button">Serviços ativos</h2>
      </div>
      <div class="column">
        <h2 @click="setPanel(disableService)" class="button">Serviços desativados</h2>
      </div>
    </div>
    <div v-if="currentCard === 1"  class="section">
      <div class="section box">
        <div class="box">
          <label>insira o titulo </label><br>
          <ckeditor :editor="editor" v-model="editorDataTitle" :config="editorConfig"></ckeditor>
        </div>
        <div class="box">
          <label>Insira o texto</label>
          <ckeditor :editor="editor" v-model="editorDataText" :config="editorConfig"></ckeditor>
        </div>
        <div>
          <button class="button">Criar</button>
        </div>
      </div>
    </div>
      <div v-if="currentCard === 2" class="section">
        <div class="section box">

        </div>
      </div>
    <div v-if="currentCard === 3" class="section">
      <div class="section box">
      </div>
    </div>
  </div>
</template>


<script >
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue2';

export default {
  name: "Crud",
  components: {
    ckeditor: CKEditor.component
  },
  data(){
    return{
      editor: ClassicEditor,
      editorDataTitle: '',
      editorDataText: '',
      editorConfig: {
      },
      insertService: 1,
      activeService: 2,
      disableService: 3,
      currentCard: '',
    }
  },
  mounted() {
  },
  methods:{
    setPanel:function(value){
       this.currentCard = value;
      if(value === 1){
        axios.get('http://127.0.0.1:8000/api/')
      }
      if(value === 2){

      }
      if(value === 3){

       }
    },
  },
}
</script>

<style scoped>
.section {
  margin: 0;
}

h2{
  margin: 0 5px;

}

#app{
  background: #9ddbea;
  min-height: 40rem;
}

ul {
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
}
</style>