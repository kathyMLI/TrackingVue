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
                                <input class="input" type="text" placeholder="Nuevo Nombre" v-model="data.name" >
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
                            <input class="input" type="password" placeholder="Contraseña" v-model="data.oldPass" v-bind:class="{ 'is-danger': hasErrors('password') }">
                        </p>
                        <label class="label">Nueva contraseña</label>
                        <p class="control">
                            <input class="input" type="password" placeholder="Contraseña" v-model="data.newPass" v-bind:class="{ 'is-danger': hasErrors('password') }">
                        </p>
                        <label class="label">Repita la nueva contraseña</label>
                        <p class="control"v-bind:class="{ 'is-danger': hasErrors('password') }">
                            <input class="input" type="password" placeholder="Contraseña">
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
    import resources from '../../services/resources'
    import router from '../../routes'
    export default {
        data() {
            return {
                data: {
                    passConfirmation: '',
                    oldPass: '',
                    newPass: '',
                    name: ''
                },
                error: ''
            }
        },
        beforeMount() {
            resources.getResource('users', router.currentRoute.params.id)
                .then((data) => {
                    Event.fire('dataUser', this.data);
                });
        },
        methods: {
            hasErrors(property) {
                return this.error.hasOwnProperty(property) ? true : false;
            },
            submit() {
                resources.updateResource('users', router.currentRoute.params.id, this.data)
                    .then((data) => {
                        router.push({ name: 'users'});
                    })
                    .catch((data) => {
                        Event.fire('errorForm', data.response.data);
                    });
            }
        }
    }
</script>