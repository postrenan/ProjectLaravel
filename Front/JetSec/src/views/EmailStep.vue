<template>
<div id="app">
    <div v-if="emailStep" class="section columns is-fullheight is-centered">
        <div class="column is-4">
        </div>
        <div id="main" class="column box has-text-centered">

            <h2>Criação de email</h2>
            <br>
            <div >
                <label>Email</label>
                <br>
                <input v-model="mail1" id="email" type="email">
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
                <button v-if="invalidEmail" v-on:click="validateEmail">Verificar</button>
                <button v-else >Prosseguir</button>
            </div>

            <div>
                <br>
                <span v-if="emailInUse">O email já está em uso.</span>
            </div>
        </div>
        <div class="column is-4">
        </div>
    </div>

    <div v-if="passwordStep" class="section columns is-fullheight is-centered">
        <div class="column is-4">
        </div>
        <div id="main" class="column box has-text-centered">

            <h2>Criação de senha</h2>
            <br>
            <div >
                <label>Senha</label>
                <br>
                <input v-model="pwd1" id="pwd1" type="password">
            </div>
            <div>
                <br>
                <label>Confirmação de senha</label>
                <br>
                <input v-model="pwd2" id="pwd2" type="password">
            </div>
            <div>
                <span v-if="pwd1 !== pwd2" id="loginError">Verificar se as senhas coicidem</span>
            </div>
            <div>
                <br>
                <button @click="registerData">Criar</button>
            </div>
            <div>
                <br>
                <span v-if="errorCreate">Não foi possivel criar o usuario!<br>tente logar ou crie outro perfil.</span>
            </div>
        </div>
        <div class="column is-4">
        </div>
    </div>
</div>
</template>

<script >
import axios from 'axios';
import router from "@/router";
export default {
    name: "EmailStep",
    data(){
        return{
            mail1:"",
            mail2:"",
            invalidEmail: true,
            emailInUse: false,
            passwordStep: false,
            emailStep: true,
            pwd1:"",
            pwd2:"",
            errorCreate: false,
        }
    },
    methods: {
        validateEmail: function(){
            if(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(this.mail1)){
                if(this.mail1 !== this.mail2){
                    console.log('email invalido')
                }else {
                    axios.post('http://127.0.0.1:8000/api/emailValidate', { 'email': this.mail1 })
                        .then((response) => {
                            console.log(response.data);
                            if(response.status === 200){
                                this.invalidEmail = false;
                                this.emailStep = false;
                                this.passwordStep = true;
                            } else {
                                this.emailInUse = true;
                                this.mail1 ="";
                                this.mail2 = "";
                            }
                        })
                        .catch((error) => {
                            console.log('Erro ao enviar dados', error.message);
                        });
                }
            }
        },
        registerData: function(){

            if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/.test(this.pwd1)){
                if(this.pwd1 !== this.pwd2){
                    console.log('senhas não coicidem');
                } else{
                    axios.post('http://127.0.0.1:8000/api/dataSaver', {'email': this.mail1 ,'password' : this.pwd1})
                        .then((response) => {
                            if(response){
                                this.pwd1 ="";
                                this.pwd2 = "";
                                router.push({path: '/Login'});
                            } else {
                                console.log('error');
                                this.errorCreate = true;
                            }
                        })
                }
            }
        }
    },

}
</script>

<style scoped></style>