<template>
    <div>
        <h1>Tableau de bord</h1>
        <v-row>
            <v-col>
                {{ this.$store.state.user }}
                <button @click.prevent="logout">Logout</button>
            </v-col>
        </v-row>
    </div>
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
                this.$router.push({ name: "Home"})
            })
        }
    }
}
</script>