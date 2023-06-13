<script >
export default {
    name: "Footer-site",
};
</script>

<template>
    <div class="footer columns has-text-centered">
        <div class="column">
          <router-link class="icon is-large" to="/"><img src="../assets/rocket.png" alt="Foguete azul"></router-link>
        </div>
        <div class="column">
            <h3><strong>Fone</strong></h3>
            <p>(55) 3030 6060</p>
        </div>
        <div class="column">
            <h3><strong>Endereço</strong></h3>
            <p>Rua Cel. Niederauer, 404<br />Santa Maria - RS</p>
        </div>
        <div class="column">
            <h3><strong>Horario de funcionamento</strong></h3>
            <p>24 horas</p>
        </div>
        <div class="column">
            <h3><strong>Redes sociais</strong></h3>
          <a href="https://www.facebook.com/jetimob/?locale=pt_BR"><i class="fa-brands fa-facebook fa-2xl iconImg"></i></a>
          <a href="https://www.instagram.com/jetimob_/"><i class="fa-brands fa-instagram fa-2xl iconImg"></i></a>
          <a href="https://wa.me/55997038314"><i class="fa-brands fa-whatsapp fa-2xl iconImg"></i></a>
        </div>
    </div>
</template>

<style scoped>
.footer{
  height: 13rem;
}

.iconImg{
  margin: 2px;
}

a{
  color:#000000;
  text-decoration: none;
}

.iconImg:hover{
  color: #1c7430;
}

</style>