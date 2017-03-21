<template>
    <div>
        <div class="container has-text-centered">
            <div class="columns">
                <div class="column is-one-third is-offset-one-third">
                    <div class="heading">
                        <h1 class="title">Entrar</h1>
                        <h2 class="subtitle">Ingrese sus datos</h2>
                        <hr>
                    </div>
                    <div>
                        <label class="label">Correo</label>
                        <p class="control">
                            <input class="input" type="email" placeholder="Email" v-model="credentials.email" v-bind:class="{ 'is-danger': hasErrors('email') }">
                            <span class="help is-danger" v-if="hasErrors('email')">{{ error.email[0] }}</span>
                        </p>
                        <label class="label">Contraseña</label>
                        <p class="control">
                            <input class="input" type="password" placeholder="Password" v-model="credentials.password" v-bind:class="{ 'is-danger': hasErrors('password') }">
                            <span class="help is-danger" v-if="hasErrors('password')">{{ error.password[0] }}</span>
                        </p>
                        <p class="control">
                            <label class="checkbox">
                                <input type="checkbox">
                                Remember me
                            </label>
                        </p>
                        <div class="control is-grouped">
                            <p class="control">
                                <button class="button" @click="submit()" v-bind:class="{'is-loading': buttonLoading}">Entrar</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import router from '../../routes'
    import auth from '../../helpers/auth'
    export default {
        data() {
            return {
                credentials: {
                    email: '',
                    password: ''
                },
                error: '',
                buttonLoading: false
            }
        },
        methods: {
            submit() {
                this.buttonLoading = true;

                var credentials = {
                    email: this.credentials.email,
                    password: this.credentials.password
                }
                auth.login(credentials)
                    .then((data) => {
                        localStorage.setItem('token', data.data.token);
                        auth.user.authenticated = true;
                        auth.setAuthHeader(localStorage.getItem('token'));
                        router.push({ name: 'home'});
                    })
                    .catch((data) => {
                        this.buttonLoading = false;
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