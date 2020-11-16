<template>
    <v-card width="600" class="mx-auto">
        <v-card-title>On se connaît ?</v-card-title>
        <v-divider></v-divider>
        <v-card-text>
            <form>
                <v-text-field 
                    v-model="email" 
                    label="Votre adresse e-mail"
                    :error-messages="emailErrors"
                    prepend-icon="mdi-mail"
                    @blur="$v.email.$touch()"
                    color="#fff"
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
                    color="#fff"
                    required
                />
                <v-btn 
                    block
                    @click="loginUser" 
                    color="primary"
                    :loading="submitting"
                    class="mt-6"
                    >
                Connexion
                </v-btn>
                <v-btn 
                    block
                    to="/register"
                    color="secondary"
                    class="mt-4"
                    >
                Pas encore inscrit ?
                </v-btn>
            </form>
        </v-card-text>
    </v-card>
</template>

<script>

import Vue from 'vue';
import { required, minLength, email, sameAs } from "vuelidate/lib/validators";
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);
import { logIn } from "../utils";

export default {
    data(){
        return{
            email: '',
            password: '',
            showPassword : false,
            submitting : false
        }
    },
    methods:{
        loginUser(){
            this.submitting = true;
            this.$v.$touch();
            let postData = new FormData();
            postData.append('email', this.email);
            postData.append('password', this.password);
            axios.post('/api/login', postData).then(() =>{
                logIn();
                this.$store.dispatch("updateLoggedUser");
                this.$router.push({ name: "Dashboard"}); 
             })
            .finally((e) => {
                this.submitting = false;
            })
            .catch((error) =>{
                console.log(error);
                this.errors = error.response.data.errors;
            })
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