<template>
      <div class="">
        <div class="">
            <div class=""><h1>Register an account</h1></div>
            <div class="">
                <label class="" for="name">Name</label>
                <span class="0" v-if="errors.name">{{errors.name[0]}}</span>
                <input class="" placeholder="Name" type="text" v-model="form.name" >
            </div>
            <div class="">
                <label for="email">Your e-mail</label>
                <input class="" placeholder="Email" type="email" v-model="form.email">
            </div>
            <div class="">
                <label for="password">Password</label>
                <input class="" placeholder="Password" type="password" v-model="form.password" name="password">
            </div>
            <div class="">
                <label for="confirm_password">Confirm Password</label>
                <input class="" placeholder="Confirm Password" type="password" v-model="form.password_confirmation" name="password_confirmation">
            </div>
            <div class="">
                <button @click.prevent="saveForm" type="submit" class="">Register</button>
            </div>
        </div> 
    </div>
</template>
<script>
export default {
    data(){
        return{
            form:{
                name: '',
                email: '',
                password:'',
                password_confirmation:''
            },
            errors:[]
        }
    },
    methods:{
        saveForm(){
            axios.post('/api/register', this.form).then(() =>{
                console.log('saved');
            }).catch((error) =>{
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>