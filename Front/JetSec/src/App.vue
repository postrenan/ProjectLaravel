<template>
  <div id="app">
    <HeaderSite v-if="!$route.meta.hideHeader"/>
    <router-view/>
    <FooterSite/>
  </div>
</template>

<script>
import HeaderSite from "./components/Header.vue";
import FooterSite from "./components/Footer.vue";

export default {
  name: "app",
  data() {
    return {}
  },
  components: {
    HeaderSite,
    FooterSite,
  },
  mounted() {
  },
};
</script>
