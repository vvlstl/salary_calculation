<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                            <div class="col-md-6">
                                <input id="name" v-model="name" type="text" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
                            <div class="col-md-6">
                                <input id="email" v-model="email" type="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-6">
                                <input id="password" v-model="password" type="password" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password_confirmation" v-model="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Professions</label>
                            <div class="col-md-6">
                                <label>
                                    <select class="form-select" v-model="profession_id" required>
                                        <option disabled selected>Выберите профессию</option>
                                        <option v-for="profession in professions" :value="profession.id">{{profession.name}}</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="alert alert-danger text-center col-md-auto offset-md-4" role="alert" v-if="error">
                                {{ error }}
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button @click.prevent="register" type="submit" class="btn btn-primary">Register</button>
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
        name: 'SingInComponent',

        data(){
            return{
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
                profession_id: null,
                professions: null,
                error: null,
            }
        },

        mounted() {
            this.getProfessions();
        },

        methods: {
            register() {
                axios.post('/api/users', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    profession_id: this.profession_id,
                })
                    .then(res => {
                        localStorage.setItem('access_token', res.data.access_token)
                        this.$router.push({name: 'home.page'})
                    })
                    .catch(error => {
                        this.error = error.response.data.error
                    })
            },
            getProfessions(){
                axios.get('api/users/professions')
                    .then(res => {
                        this.professions = res.data.data
                    })
            }
        },

    }
</script>
