<template>
    <nav class="navbar navbar-expand-lg bg-body-secondary">
        <div class="container">
            <a class="navbar-brand" @click.prevent href="#">Личный кабинет</a>
                <div class="d-flex">
                    <ul class="navbar-nav d-flex flex-row gap-2">
                        <li class="nav-item" v-if="!accessToken">
                            <router-link :to="{name: 'login.page'}" class="nav-link">Login</router-link>
                        </li>
                        <li class="nav-item" v-if="!accessToken">
                            <router-link :to="{name: 'register.page'}" class="nav-link">SingIn</router-link>
                        </li>
                        <li class="nav-item" v-if="accessToken">
                            <a @click.prevent="logOut" href="#" class="nav-link">LogOut</a>
                        </li>
                    </ul>
                </div>
        </div>
    </nav>

    <router-view></router-view>
</template>

<script>
    import API from "@/api";

    export default {
        name: 'App',

        data(){
            return{
                accessToken: null
            }
        },

        mounted() {
            this.getAccessToken()
        },

        watch: {
            '$route'() {
                this.getAccessToken();
            },
        },

        methods:{
            getAccessToken(){
                this.accessToken = localStorage.getItem('access_token')
            },

            logOut(){
                API.post('/api/auth/logout')
                    .then(res => {
                        localStorage.removeItem('access_token')
                        this.$router.push({name: 'login.page'})
                    })
            }
        },
    }
</script>
