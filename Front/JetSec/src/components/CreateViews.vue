<template>

  <div class="section box">
    <div class="box">
      <label>insira o titulo </label><br>
      <input v-model="newTitle" type="text">
    </div>
    <div class="box">
      <label>Insira o texto</label>
      <ckeditor :editor="editor" v-model="newContent" :config="editorConfig"></ckeditor>
    </div>
    <div v-if="SelectedOption === 2" class="box">
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

</template>
<script>
import CKEditor from "@ckeditor/ckeditor5-vue2";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import {instance} from "@/main";
import Cookies from "js-cookie";
import {mapGetters} from "vuex";

export default {
  name: 'CreatedViews',
  props: [`SelectedOption`],
  components: {
    ckeditor: CKEditor.component,
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {},
      newTitle: '',
      newCategory: '',
      newContent: '',
      textError: '',
      sendData: false,
    }
  },
  computed: {
    ...mapGetters({
        getUser: 'getUser',
    }),
  },
  methods: {
    newArticle() {
      this.textError = '';
      if (this.SelectedOption === 1) {
        if (this.newTitle !== '' && this.newContent !== '') {
          instance.post('/service', {
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
      } else {
        if (this.newTitle !== '' && this.newContent !== '') {
          instance.post('/article', {
            'title': this.newTitle,
            'content': this.newContent,
            'category': this.newCategory,
            'author': this.getUser.id,
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

      }

    }
  },
}
</script>


<style scoped>

</style>