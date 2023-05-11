<template>
  <div id="app">
      <HeaderSite />
      <router-view />
      <FooterSite />
  </div>
</template>

<script >
import HeaderSite from "./components/Header.vue";
import FooterSite from "./components/Footer.vue";
export default {
    name: "App",
    components: {
        HeaderSite,
        FooterSite,
    },
};
</script>

<style scoped>
</style>
