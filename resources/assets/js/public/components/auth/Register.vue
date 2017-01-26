<template>
    <section class="section">
        <div class="container has-text-centered">
            <div class="columns">
                <div class="column is-one-third is-offset-one-third">
                    <div class="heading">
                        <h1 class="title">Register</h1>
                        <h2 class="subtitle">Ingrese sus datos</h2>
                        <div class="column is-half is-offset-one-quarter">
                            <form>
                                <label class="label">Name</label>
                                <p class="control">
                                    <input type="text" id="name" v-model="data.name" class="input" v-bind:class="{ 'is-danger': hasErrors('name')}">
                                    <span v-if="hasErrors('name')" class="help is-danger">
                                        {{ error.name[0] }}
                                    </span>
                                </p>
                                <label class="label">Email Address</label>
                                <p class="control">
                                    <input type="email" id="email" v-model="data.email" class="input" v-bind:class="{ 'is-danger': hasErrors('email')}">
                                    <span v-if="hasErrors('email')" class="help is-danger">
                                        {{ error.email[0] }}
                                    </span>
                                </p>
                                <label class="label">Rut</label>
                                <p class="control">
                                    <input type="text" id="rut" v-rut v-model="data.rut" class="input" v-bind:class="{ 'is-danger': hasErrors('rut')}">
                                    <span v-if="hasErrors('rut')" class="help is-danger">
                                        {{ error.rut[0] }}
                                    </span>
                                </p>
                                <label class="label">Password</label>
                                <p class="control">
                                    <input type="password" id="password" v-model="data.password" class="input" v-bind:class="{ 'is-danger': hasErrors('password')}">
                                    <span v-if="hasErrors('password')" class="help is-danger">
                                        {{ error.password[0] }}
                                    </span>
                                </p>
                                <label class="label">Confirm Password</label>
                                <p class="control">
                                    <input type="password" id="password_confirmation" v-model="data.password_confirmation" class="input" v-bind:class="{ 'is-danger': hasErrors('password_confirmation')}">
                                    <span v-if="hasErrors('password_confirmation')" class="help is-danger">
                                        {{ error.password_confirmation[0] }}
                                    </span>
                                </p>
                                <br>
                                <button class="button is-primary" @click="submit()">
                                    Enviar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import router from '../../routes'
    import auth from '../../helpers/auth'
    export default {
        props: {
            defaultName: {
                type: String,
                required: false
            },
            defaultEmail: {
                type: String,
                required: false
            },
            defaultRut: {
                type: String,
                required: false
            }
        },
        data() {
            return {
                data: {
                    name: '',
                    email: '',
                    rut:'',
                    password: '',
                    password_confirmation: ''
                },
                error: '',
                roles: ['user']
            }
        },
        beforeMount(){
            if (this.defaultName != null) {
                this.data.name = this.defaultName
            }
            if (this.defaultEmail != null) {
                this.data.email = this.defaultEmail
            }
            if (this.defaultRut != null) {
                this.data.rut = this.defaultRut
            }
        },
        mounted() {
            Event.listen('dataUser', (msg) => {
                this.data = msg;
            });
            Event.listen('errorForm', (msg) => {
                this.error = msg;
            });
        },
        methods: {
            submit() {
                this.$emit('submit', this.data);
                var credentials = {
                    email: this.data.email,
                    password: this.data.password
                }
                auth.login(credentials)
                    .then((data) => {
                        localStorage.setItem('token', data.data.token);
                        auth.user.authenticated = true;
                        auth.setAuthHeader(localStorage.getItem('token'));
                        router.push({ name: 'home'});
                    })
                    .catch((data) => {
                        this.error = data.response.data;
                        this.hasError = true;
                    });
            },
            hasErrors(property) {
                return this.error.hasOwnProperty(property) ? true : false;
            }
        }
    }
</script>