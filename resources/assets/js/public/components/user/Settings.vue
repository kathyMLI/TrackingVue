<template>
    <div class="">
        <div class="columns">
            <div class="column is-one-third is-offset-one-third">
                <div class="heading">
                    <h1 class="title">Configuracion de cuenta</h1>
                </div>
                <div>
                    <div>
                        <h3>Cambio de nombre</h3>
                        <hr>
                        <div class="control is-grouped">
                            <p class="control is-expanded">
                                <input class="input" type="email" placeholder="Nuevo Nombre" v-bind:class="{ 'is-danger': hasErrors('email') }">
                                <span class="help is-danger" v-if="hasErrors('email')">{{ error.email[0] }}</span>
                            </p>
                            <p class="control">
                                <button class="button is-primary" @click="submit()">Cambiar</button>
                            </p>
                        </div>
                        <br>
                    </div>
                    <div>
                        <h3>Cambio de contraseña</h3>
                        <hr>
                        <label class="label">Contraseña antigua</label>
                        <p class="control">
                            <input class="input" type="password" placeholder="Password" v-bind:class="{ 'is-danger': hasErrors('password') }">
                        </p>
                        <label class="label">Nueva contraseña</label>
                        <p class="control">
                            <input class="input" type="password" placeholder="Password">
                        </p>
                        <label class="label">Repita la nueva contraseña</label>
                        <p class="control">
                            <input class="input" type="password" placeholder="Password">
                        </p>
                        <div class="control is-grouped">
                            <p class="control">
                                <button class="button is-primary" @click="submit()">Cambiar</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                error: ''
            }
        },
        methods: {
            hasErrors(property) {
                return this.error.hasOwnProperty(property) ? true : false;
            }
        }
    }
</script>