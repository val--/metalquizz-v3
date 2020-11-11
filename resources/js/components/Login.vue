<template>
    <div>
        <v-card width="600" class="mx-auto mt-5">
            <v-card-title>
                <h1>Connexion</h1>
            </v-card-title>
            <v-card-text>
                <v-form>
                    <v-text-field 
                        v-model="email" 
                        label="Votre adresse e-mail"
                        :error-messages="emailErrors"
                        prepend-icon="mdi-mail"
                        @blur="$v.email.$touch()"
                        required
                    />
                    <v-text-field 
                        v-model="password" 
                        label="Mot de passe"
                        :error-messages="passwordErrors"
                        prepend-icon="mdi-lock" 
                        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'" 
                        type="password" 
                        :type="showPassword ? 'text' : 'password'" 
                        @click:append="showPassword = !showPassword"
                        required
                    />
                </v-form>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <v-btn @click="loginUser" color="success">Login</v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>

import Vue from 'vue';
import { required, minLength, email, sameAs } from "vuelidate/lib/validators";
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

export default {
    data(){
        return{
            email: '',
            password: '',
            showPassword : false
        }
    },
    methods:{
         loginUser(){
            this.$v.$touch;
            let postData = new FormData();
            postData.append('email', this.email);
            postData.append('password', this.password);
            /*axios.post('/api/login', postData).then(() =>{
                 this.$router.push({ name: "Dashboard"}); 
             }).catch((error) =>{
             	console.log(error);
         		this.errors = error.response.data.errors;
            })*/
         }
    },
    validations : {
        email : { required, email },
        password : { required },
    },
    computed: {
        emailErrors () {
            const errors = [];
            if (!this.$v.email.$dirty) return errors; // email ok -> empty errors
            !this.$v.email.email && errors.push('Votre adresse doit être au format e-mail.');
            !this.$v.email.required && errors.push('Vous devez saisir une adresse e-mail.');
            return errors;
        },
        passwordErrors () {
            const errors = [];
            if (!this.$v.password.$dirty) return errors; // password ok -> empty errors
            !this.$v.password.required && errors.push('Vous devez saisir un mot de passe.');
            return errors;
        }
    }
}
</script>