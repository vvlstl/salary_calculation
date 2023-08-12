<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                            <div class="col-md-6">
                                <input v-model="email" id="email" type="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input v-model="password" id="password" type="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="alert alert-danger text-center col-md-auto offset-md-4" role="alert" v-if="error">
                                {{ error }}
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button @click.prevent="login" type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: 'LoginComponent',

        data() {
            return {
                email: null,
                password: null,
                error: null,
            }
        },

        methods:{
            login(){
                axios.post('/api/auth/login', {email: this.email, password: this.password})
                    .then(res => {
                        localStorage.setItem('access_token', res.data.access_token)
                        this.$router.push({name: 'home.page'})
                    })
                    .catch(error => {
                        this.error = error.response.data.error
                    })
            }
        }

    }
</script>
