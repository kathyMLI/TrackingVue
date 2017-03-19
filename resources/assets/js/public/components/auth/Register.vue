<template>
    <div>
        <div class="heading">
            <h1 class="title">Registro</h1>
            <h2 class="subtitle">Ingresa tus datos</h2>
            <hr>
        </div>
        <div>
            <form>
                <label class="label">Nombre</label>
                <p class="control">
                    <input type="text" id="name" v-model="data.name" class="input" v-bind:class="{ 'is-danger': hasErrors('name')}">
                    <span v-if="hasErrors('name')" class="help is-danger">
                        {{ error.name[0] }}
                    </span>
                </p>
                <label class="label">Correo</label>
                <p class="control">
                    <input type="email" id="email" v-model="data.email" class="input" v-bind:class="{ 'is-danger': hasErrors('email')}">
                    <span v-if="hasErrors('email')" class="help is-danger">
                        {{ error.email[0] }}
                    </span>
                </p>
                <label class="label">Rut</label>
                <p class="control">
                    <input type="text" id="rut" v-rut v-model="auxRut" class="input" v-bind:class="{ 'is-danger': hasErrors('rut')}">
                    <span v-if="hasErrors('rut')" class="help is-danger">
                        {{ error.rut[0] }}
                    </span>
                </p>
                <label class="label">Contraseña</label>
                <p class="control">
                    <input type="password" id="password" v-model="data.password" class="input" v-bind:class="{ 'is-danger': hasErrors('password')}">
                    <span v-if="hasErrors('password')" class="help is-danger">
                        {{ error.password[0] }}
                    </span>
                </p>
                <label class="label">Repita la contraseña</label>
                <p class="control">
                    <input type="password" id="password_confirmation" v-model="data.password_confirmation" class="input" v-bind:class="{ 'is-danger': hasErrors('password_confirmation')}">
                    <span v-if="hasErrors('password_confirmation')" class="help is-danger">
                        {{ error.password_confirmation[0] }}
                    </span>
                </p>
                <br>
                <button class="button is-warning" @click="submit()" v-bind:class="{'is-loading': buttonLoading}">
                    Registrarse
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    import router from '../../routes'
    import auth from '../../helpers/auth'
    import register from '../../services/auth'

    export default {
        data() {
            return {
                data: {
                    name: '',
                    email: '',
                    rut:'',
                    password: '',
                    password_confirmation: ''
                },
                auxRut:'',
                error: '',
                buttonLoading: false
            }
        },
        methods: {
            submit() {
                this.buttonLoading = true;
                this.data.rut = this.auxRut;

                register.register(this.data)
                    .then((data) => {
                        router.push({ name: 'sendmail'});
                    })
                    .catch((data) => {
                        this.error = data.response.data;
                        this.buttonLoading = false;
                    });
            },
            hasErrors(property) {
                return this.error.hasOwnProperty(property) ? true : false;
            }
        }
    }
</script>