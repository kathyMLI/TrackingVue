<template>
    <div>
        <div>
            <h1 class="title">{{ action }} Usuario</h1>
            <hr>
        </div>
        <div>
            <div class="columns">
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
                        <label class="label">Roles</label>
                        <div v-bind:class="{ 'is-danger': hasErrors('roles')}">
                            <multiselect v-model="data.roles" tag-placeholder="Agregar este rol" placeholder="Selecciona roles..." label="label" track-by="label" :hide-selected="true" :clear-on-select="false" :close-on-select="false" :multiple="true" :options="roles">
                            <span v-if="hasErrors('roles')" class="help is-danger">
                                {{ error.roles[0] }}
                            </span>
                        </div>
                        <br>
                        <button class="button is-primary" @click="submit()">
                            Enviar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            action: {
                type: String,
                required: true
            },
            defaultName: {
                type: String,
                required: false
            },
            defaultEmail: {
                type: String,
                required: false
            },
            defaultRoles: {
                type: Array,
                required: false
            }
        },
        data() {
            return {
                data: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    roles: ''
                },
                error: '',
                roles: []
            }
        },
        beforeMount(){
            if (this.defaultName != null) {
                this.data.name = this.defaultName
            }
            if (this.defaultEmail != null) {
                this.data.email = this.defaultEmail
            }
            if (this.defaultRoles != null) {
                this.data.roles = this.defaultRoles
            }
        },
        mounted() {
            Event.listen('dataUser', (msg) => {
                this.data = msg;
            });
            Event.listen('errorForm', (msg) => {
                this.error = msg;
            });
            Event.listen('rolesForm', (msg) => {
                this.data.roles = '';
                this.roles = msg;
            });
        },
        methods: {
            submit() {
                this.data.roles = this.parseRoles();
                this.$emit('submit', this.data);
            },
            parseRoles() {
                var aux = [];
                for(var i = 0; i < this.data.roles.length; i++) {
                    aux.push(this.data.roles[i].name);
                }
                return aux
            },
            hasErrors(property) {
                return this.error.hasOwnProperty(property) ? true : false;
            }
        }
    }
</script>