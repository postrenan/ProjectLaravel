<template>
  <div id="app">
    <div class="section columns has-text-centered box">
      <div class="column">
        <h2 v-if="SelectedOption === 1" @click="setPanel(insertArticle)" class="button">{{this.SelectedOption.addButtonLabel}}</h2>
      </div>
      <div class="column">
        <h2 v-if="SelectedOption === 1" @click="setPanel(activeArticle)" class="button">{{this.SelectedOption.viewEnabledButtonLabel}}</h2>
      </div>
      <div class="column">
        <h2 v-if="SelectedOption === 1" @click="setPanel(disableArticle)" class="button">{{this.SelectedOption.viewDisabledButtonLabel}}</h2>
      </div>
    </div>
    <div v-if="currentCard === 1" class="section">
     <!-- <CreateViews :SelectedOption="this.SelectedOption"/>-->
    </div>
    <div v-if="currentCard === 2" class="section">
      <!-- <EnabledViews :SelectedOption="this.SelectedOption"/>-->
    </div>
    <div v-if="currentCard === 3" class="section">
     <!-- <DisabledViews ::SelectedOption="this.SelectedOption"/>-->
    </div>
  </div>
</template>

<script>
import CreateViews from "@/components/CreateViews.vue";
import EnabledViews from "@/components/EnabledViews.vue";
import DisabledViews from "@/components/DisabledViews.vue";
export default {
  props: [`SelectedOption`],
  name: "BlogManager",
  components: {
    DisabledViews,
    EnabledViews,
    CreateViews,

  },
  mounted(){
    console.log(this.SelectedOption.addButtonLabel);
  },
  data() {
    return {
      editorConfig: {},
      insertService: 1,
      activeService: 2,
      disableService: 3,
      currentCard:0,
    }
  },
  methods: {
    setPanel(value) {
      this.currentCard = value;
    },
  },
}
</script>

<style scoped>
.section {
  margin: 0;
}

h2 {
  margin: 0 5px;

}

#app {
  background: #9ddbea;
  min-height: 40rem;
}

ul {
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
}

.buttonToSwitchState {
  margin: 5px;
}
</style>