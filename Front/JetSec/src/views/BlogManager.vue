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
        <h2 @click="" class="button ">Adicionar artigo</h2>
      </div>
      <div class="column">
        <h2 @click="" class="button">Artigos postados</h2>
      </div>
      <div class="column">
        <h2 @click=""  class="button">Artigos desativados</h2>
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
          <button @click="" class="button">Criar</button>
        </div>
        <div>
          <br>
          <h2 class="box" v-if="textError!== ''">{{textError}}</h2>
        </div>
        <div>
          <br>
          <h2 class="box" v-if="sendData">Novo serviço criado com sucesso</h2>
        </div>
      </div>
    </div>
    <div v-if="currentCard === 2" class="section">
      <div class="section box">
        <div v-for="service in currentServices" class="columns">
          <div class="box column">
            {{service.title}}<br>
            {{service.content}}
          </div>
          <button class="button column is-vcentered is-2" @click="">delete</button>
        </div>
        <div v-if="badResponseToDelete !== ''">
          <p class="box">{{badResponseToDelete}}</p>
        </div>
        <div>
          <br>
          <h2 class="box" v-if="textError!== ''">{{textError}}</h2>
        </div>
      </div>
    </div>
    <div v-if="currentCard === 3" class="section">
      <div class="section box ">
        <div v-for="service in disabledServices" class="columns">
          <div class="box column">
            {{service.title}}<br>
            {{service.content}}
          </div>
          <button class="button column is-vcentered is-2" @click="">Ativar</button>
        </div>
        <div v-if="badResponseToActive !== ''">
          <p class="box">{{badResponseToActive}}</p>
        </div>
      </div>
      <div>
        <br>
        <h2 class="box" v-if="textError!== ''">{{textError}}</h2>
      </div>
    </div>
  </div>
</template>

<script>
export default{
  name:"BlogManager",

}

</script>


<style scoped>

</style>