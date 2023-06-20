<template>
  <div id="app">
    <div class="section columns has-text-centered box">
      <div class="column">
        <h2 @click="setPanel(insertService)" class="button">{{SelectedOption.addButtonLabel}}</h2>
      </div>
      <div class="column">
        <h2 @click="setPanel(activeService)" class="button">{{SelectedOption.viewEnabledButtonLabel}}</h2>
      </div>
      <div class="column">
        <h2 @click="setPanel(disableService)" class="button">{{SelectedOption.viewDisabledButtonLabel}}</h2>
      </div>
    </div>
    <div v-if="currentCard === 1" class="section">
     <CreateViews :SelectedOption="SelectedOption.id"/>
    </div>
    <div v-if="currentCard === 2" class="section">
      <EnabledViews :SelectedOption="SelectedOption.id"/>
    </div>
    <div v-if="currentCard === 3" class="section">
     <DisabledViews ::SelectedOption="SelectedOption.id"/>
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
      insertService: 1,
      activeService: 2,
      disableService: 3,
      currentCard:0,
      valueSelected : this.SelectedOption,
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