<template>
    <div>
        <v-card width="600" class="mx-auto mt-5">
            <v-card-title>
                <h1>Inscription</h1>
            </v-card-title>
            <v-card-text>
                <v-form>
                    <v-text-field 
                        v-model="name" 
                        label="Votre pseudonyme"
                        :error-messages="nameErrors"
                        prepend-icon="mdi-account-circle"
                        @blur="$v.name.$touch()"
                        required
                    />
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
                    <v-text-field
                        v-model="confirmPassword"
                        :type="showPassword ? 'text' : 'password'"
                        :error-messages="confirmPasswordErrors"
                        label="Confirmation du mot de passe"
                        required
                        @blur="$v.confirmPassword.$touch()"
                        prepend-icon="mdi-lock"
                        @click:append="showPassword = !showPassword"
                    />
                </v-form>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <v-btn @click="registerUser" color="success">S'inscrire</v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>

import Vue from 'vue';
import { required, minLength, email, sameAs, sameAsPass } from "vuelidate/lib/validators";
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

export default {
    data(){
        return{
            name: '',
            email: '',
            password:'',
            confirmPassword:'',
            showPassword : false
        }
    },
    methods:{
        registerUser(){
            this.$v.$touch;
            /*axios.post('/api/register', this.form).then(() =>{
                console.log('saved');
            }).catch((error) =>{
                this.errors = error.response.data.errors;
            })*/
        }
    },
    validations : {
        name : { required },
        email : { required, email },
        password : { required },
        confirmPassword: { sameAsPassword: sameAs("password") }
    },
    computed: {
        nameErrors () {
            const errors = [];
            if (!this.$v.name.$dirty) return errors; // name ok -> empty errors
            !this.$v.name.required && errors.push('Vous devez saisir un pseudo.');
            return errors;
        },
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
        },
        confirmPasswordErrors() {
            const errors = []; // confirm password ok -> empty errors
            if (!this.$v.confirmPassword.$dirty) return errors;
            !this.$v.confirmPassword.sameAsPassword &&
            errors.push("Les deux mots de passe doivent correspondre.");
            return errors;
        }
    }
}
</script>