<template>
	<v-app-bar app color="primary">
		<!--<v-toolbar-title>Metal Quizz</v-toolbar-title>-->
		<v-row>
			<v-col md="4" class="hidden-sm-and-down"></v-col>
			<v-col md="4" sm="6" class="text-center">
				<router-link to='/' class="ma-2 app-title">METALQUIZZ</router-link>
			</v-col>
			<v-col md="4" sm="6">
				<v-btn text to='/login' class="ma-2" v-if="!this.$store.state.isLoggedIn"><v-icon left>mdi-login</v-icon> Connexion</v-btn>
            </v-btn>
				<v-btn text to='/register' class="ma-2" v-if="!this.$store.state.isLoggedIn"><v-icon left>mdi-account-plus</v-icon> Inscription</v-btn>

				<v-btn text to='/quiz' class="ma-2" v-if="this.$store.state.isLoggedIn">Jouer !</v-btn>
				<v-btn text text to='/dashboard' class="ma-2" v-if="this.$store.state.isLoggedIn">Tableau de bord</v-btn>
				<v-btn text @click.prevent='logout' class="ma-2" v-if="this.$store.state.isLoggedIn"><v-icon>mdi-logout-variant</v-icon></v-btn>
			</v-col>
		</v-row>
	</v-app-bar>
</template>

<script>
export default {
    data(){
        return{

        }
    },
    methods:{
        logout(){
            axios.post('/api/logout').then(()=>{
            	this.$store.dispatch("logOutUser");
                this.$router.push({ name: "Home"})
            })
        }
    }
}
</script>

<style>
	a:hover {  
		text-decoration: none;
	}
</style>