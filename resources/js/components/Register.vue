<template>
    <v-card width="600" class="mx-auto">
        <v-card-title>Rejoignez-nous !</v-card-title>
        <v-divider></v-divider>
        <v-card-text>
            <form>
                <v-text-field 
                    v-model="name" 
                    label="Votre pseudonyme"
                    :error-messages="nameErrors"
                    prepend-icon="mdi-account-circle"
                    @blur="$v.name.$touch()"
                    color="#fff"
                    required
                />
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
                <v-text-field
                    v-model="password_confirmation"
                    :type="showPassword ? 'text' : 'password'"
                    :error-messages="passwordConfirmationErrors"
                    label="Confirmation du mot de passe"
                    required
                    @blur="$v.password_confirmation.$touch()"
                    prepend-icon="mdi-lock"
                    color="#fff"
                    @click:append="showPassword = !showPassword"
                />
                <!--<v-file-input label="Photo de profil" color="#fff" />-->
                <v-btn 
                    block
                    @click.prevent="registerUser" 
                    color="primary"
                    :loading="submitting"
                    class="mt-6"
                >
                S'inscrire
                </v-btn>
                <v-btn 
                    block
                    to="/login"
                    color="secondary"
                    class="mt-4"
                >
                Déjà inscrit ?
                </v-btn>
            </form>
        </v-card-text>
    </v-card>
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
            password_confirmation:'',
            showPassword : false,
            submitting : false
        }
    },
    methods:{
        registerUser(){
            this.$v.$touch();
            if(!this.$v.$invalid){
                this.submitting = true;
                let vm = this;
                let postData = new FormData();
                postData.append('name', this.name);
                postData.append('email', this.email);
                postData.append('password', this.password);
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/api/register', postData).then((response) =>{
                        this.handleLogin(postData); // Let's log user if registration was ok
                    })
                    .finally((e) => {
                        this.submitting = false;
                    })
                    .catch((error) =>{
                        this.errors = error.response.data.errors;
                    })
                });
            }else{
                console.log(this.$v.name);
            }
        },
        // TODO - déplacer, à utiliser globalement
        handleLogin(data){
            let vm = this;
            axios.get('/sanctum/csrf-cookie').then(response => {
                let postData = new FormData();
                postData.append('email', vm.email);
                postData.append('password', vm.password);
                axios.post('/api/login', data).then(() =>{
                     this.$router.push({ name: "Dashboard"}); 
                 }).catch((error) =>{
                    console.log(error);
                })
            });
        }
    },
    validations : {
        name : { required },
        email : { required, email },
        password : { required },
        password_confirmation: { required, sameAsPassword: sameAs("password") }
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
        passwordConfirmationErrors() {
            const errors = []; // confirm password ok -> empty errors
            if (!this.$v.password_confirmation.$dirty) return errors;
            !this.$v.password_confirmation.sameAsPassword && errors.push("Les deux mots de passe doivent correspondre.");
            !this.$v.password_confirmation.required && errors.push("Vous devez saisir une seconde fois votre mot de passe.");
            return errors;
        }
    }
}
</script>