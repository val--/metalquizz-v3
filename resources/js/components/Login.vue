<template>
     <div class="">
        <div class="">
            <div class=""><h1>Login to your account</h1></div>
            <div class="">
                <label for="email">Your e-mail</label>
                <input class="" placeholder="Email" type="email" v-model="form.email">
            </div>
            <div class="">
                <label for="password">Password</label>
                <input class="" placeholder="Password" type="password" v-model="form.password" name="password">
            </div>
            <div class="">
                <button @click.prevent="loginUser" type="submit" class="">Login</button>
            </div>
        </div> 
    </div>
</template>
<script>
export default {
    data(){
        return{
            form:{
                email: '',
                password: ''
            },
            errors: []
        }
    },
    methods:{
         loginUser(){
             axios.post('/api/login', this.form).then(() =>{
                 this.$router.push({ name: "Dashboard"}); 
             }).catch((error) =>{
             	console.log(error);
         		this.errors = error.response.data.errors;
            })
         }
    }
}
</script>