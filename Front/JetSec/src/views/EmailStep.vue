<template>
<div id="app">
    <div class="section columns is-fullheight is-centered">
        <div class="column is-4">
        </div>
        <div id="main" class="column box has-text-centered">
            <h2>Criação de email</h2>
            <br>
            <div >
                <label>Email</label>
                <br>
                <input v-model="mail1" id="email" type="email" value="seuemail@gmail.com">
            </div>
            <div>
                <br>
                <label>Confirmação de email</label>
                <br>
                <input v-model="mail2" id="email2" type="email">
            </div>
            <div>
                <span v-if="mail1 !== mail2" id="loginError">Verificar se os emails coicidem</span>
            </div>
            <div>
                <br>
                <button v-on:click="mailValidate">Verificar</button>
            </div>
        </div>
        <div class="column is-4">
        </div>
    </div>
</div>
</template>

<script >
import axios from 'axios';
export default {
    name: "EmailStep",
    data(){
        return{
            mail1:"",
            mail2:""
        }
    },
    methods: {
        mailValidate: function(){
            if(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(this.mail1)){
                if(this.mail1 !== this.mail2){
                    console.log('email invalido')
                }else {
                    console.log('email valido');
                    axios.post('http://127.0.0.1:8000/api/emailValidate', this.mail1)
                        .then((response) => {
                            console.log('Mensagem enviada com sucesso!', response.data);
                        })
                        .catch((error) => {
                            console.log('Erro ao enviar dados', error.message);
                        });
                }
            }
        }
    }
}
</script>

<style scoped></style>