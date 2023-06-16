<template>
  <div id="#app">
    <div class="section columns has-text-centered ">
      <div class="column">
        <h2 @click="setPanel(insertOption)" class="button ">Adicionar</h2>
      </div>
      <div class="column">
        <h2 @click="setPanel(activeOption)" class="button">Ativos</h2>
      </div>
      <div class="column">
        <h2 @click="setPanel(disableOption)" class="button">Desativados</h2>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { useStore } from '/home/renan/DesenvolvimentoPraticas/Project/Front/JetSec/src/main.js';
export default {
  setup() {
    const store = useStore();

    const sharedData = computed(() => store.data);

    const updateData = () => {
      const newData = 'Novos dados';
      store.setData(newData); // Chama a ação para atualizar o estado
    };

    return {
      sharedData,
      updateData
    };
  },
  name: "Selector",
  data() {
    return {
      insertOption: 1,
      activeOption: 2,
      disableOption: 3,
    }
  },
  methods: {
    setPanel(value){
      this.currentCard = value;
        if (this.currentCard === this.activeOption || this.currentCard === this.disableOption) {
          axios.get('http://127.0.0.1:8000/api/Service')
              .then((response) => {
                if (response.data.enabled) {
                  this.currentServices = response.data.enabled;
                }
                if (response.data.disabled) {
                  this.disabledServices = response.data.disabled;
                }
              })
              .catch((error) => {
                this.textError = error;
              })
        }
      }
  }
}
</script>


<style scoped>

</style>