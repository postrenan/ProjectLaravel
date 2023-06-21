<template>
  <div id="app">
    <div class="section columns has-text-centered box">
      <div class="column">
        <h2 @click="setPanel(insertService)" class="button">{{ SelectedOption.addButtonLabel }}</h2>
      </div>
      <div class="column">
        <h2 @click="setPanel(activeService)" class="button">{{ SelectedOption.viewEnabledButtonLabel }}</h2>
      </div>
      <div class="column">
        <h2 @click="setPanel(disableService)" class="button">{{ SelectedOption.viewDisabledButtonLabel }}</h2>
      </div>
    </div>
    <div class="section">
      <component :SelectedOption="SelectedOption.id" :is="currentCardComponent"/>
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
  data() {
    return {
      editorConfig: {},
      insertService: 0,
      activeService: 1,
      disableService: 2,
      currentCard: 3,
      currentCardComponent: null,
      valueSelected: this.SelectedOption,
      componentsName: [CreateViews, EnabledViews, DisabledViews]
    }
  },
  methods: {
    setPanel(value) {
      this.currentCardComponent = this.componentsName[value];
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