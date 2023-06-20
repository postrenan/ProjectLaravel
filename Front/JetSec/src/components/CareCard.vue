<template>
  <div id="#app">
    <section
        class="section columns is-vcentered is-centered is-gapless"
        id="CareSection"
    >
      <div class="column has-text-centered" id="columImage">
        <img src="https://www.jetimob.com/blog/content/images/size/w600/2023/06/o_que_e_habite-se.webp" id="imageCare"
             alt=""/>
      </div>
      <div class="column">
        <h2 class="title has-text-centered">O cuidado que você merece</h2>
        <p class="has-text-justified careText">
          Há mais de <strong>25 ANOS </strong>cuidar da sua segurança é a nossa
          missão. Para minimizar riscos e evitar surpresas desagradáveis, você
          precisa ter a estratégia correta, e para isso estamos aqui.Venha fazer
          parte da família <strong>Strong Security</strong> você também!
        </p>
        <div class="column has-text-centered">
          <button class="button is-rounded is-success">
            <router-link to="/About">Conheça a Jet</router-link>
          </button>
        </div>
      </div>
    </section>
    <section class="section servicos">
      <div class="columns has-text-centered is-mobile is-centered">
        <div class="column"></div>
        <div class="column" id="sectionPreve">
          <p class="title">A melhor estratégia de segurança é a prevenção</p>
          <p>
            Se você possui alguma dúvida relacionada a segurança, nossa equipe
            está à disposição para te ajudar.
          </p>
          <button class="button is-rounded is-warning">
            <router-link to="/">Saiba mais</router-link>
          </button>
        </div>
        <div class="column"></div>
      </div>
    </section>
  </div>
</template>

<script>
  export default {
    name: "CareCard",
  }
</script>


<style scoped>

.careText{
  margin: 15px;
}


.servicos {
  padding: 20px;
}
</style>