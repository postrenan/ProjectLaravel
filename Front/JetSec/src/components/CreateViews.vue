<template>
  <div id="app">
    <div class="section box">
      <div class="box">
        <label>insira o titulo </label><br>
        <input v-model="newTitle" type="text"></input>
      </div>
      <div class="box">
        <label>Insira o texto</label>
        <ckeditor :editor="editor" v-model="newContent" :config="editorConfig"></ckeditor>
      </div>
      <div class="box">
        <label>Insira a categoria</label><br>
        <input v-model="newCategory" type="text">
      </div>
      <div>
        <button @click="newArticle" class="button">Criar</button>
      </div>
      <div>
        <br>
        <h2 class="box" v-if="textError!== ''">{{ textError }}<br>Já existe esse titulo </h2>
      </div>
      <div>
        <br>
        <h2 class="box" v-if="sendData">Novo artigo criado com sucesso</h2>
      </div>
    </div>
    <div class="section box">
      <div class="box">
        <label>insira o titulo </label><br>
        <ckeditor :editor="editor" v-model="newTitle" :config="editorConfig"></ckeditor>
      </div>
      <div class="box">
        <label>Insira o texto</label>
        <ckeditor :editor="editor" v-model="newContent" :config="editorConfig"></ckeditor>
      </div>
      <div>
        <button @click="newService" class="button">Criar</button>
      </div>
      <div>
        <br>
        <h2 class="box" v-if="textError!== ''">{{ textError }}</h2>
      </div>
      <div>
        <br>
        <h2 class="box" v-if="sendData">Novo serviço criado com sucesso</h2>
      </div>
    </div>
  </div>
</template>
<script >
import CKEditor from "@ckeditor/ckeditor5-vue2";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import {instance} from "@/main";
import Cookies from "js-cookie";

export default {
  name: 'CreatedViews',
  components: {
    ckeditor: CKEditor.component
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {},
      newTitle: '',
      newCategory: '',
      newContent: '',
      textError: '',
    }
  },
  methods: {
    newArticle() {
      this.textError = '';
      instance.post('/article', {
        'title': this.newTitle,
        'content': this.newContent,
        'category': this.newCategory,
        'author': Cookies.get('userName'),
      })
          .then((response) => {
            this.sendData = true;
            setTimeout(() => {
              this.sendData = false;
            }, 2000,)
            this.editorDataText = '';
            this.newTitle = '';
            this.newCategory = '';
          })
          .catch((error) => {
            this.textError = error;
            setTimeout(() => {
              this.textError = '';
            }, 2000,)
          })
    }
  },
  newService() {
    this.textError = '';
    if (this.newTitle !== '' && this.newContent !== '') {
      instance.post('/Service', {
        'title': this.newTitle,
        'content': this.newContent
      })
          .then((response) => {

            this.sendData = true;
            this.newContent = '';
            this.newTitle = '';
          })
          .catch((error) => {
            this.textError = error;
          })
    } else {
      this.textError = 'os campos não podem estar vazio';
    }
  },
}
</script>


<style scoped>

</style>