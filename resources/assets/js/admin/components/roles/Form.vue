<template>
    <div>
        <div>
            <h1 class="title">{{ action }} Rol</h1>
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
                        <label class="label">Nombre legible</label>
                        <p class="control">
                            <input type="text" id="label" v-model="data.label" class="input" v-bind:class="{ 'is-danger': hasErrors('label')}">
                            <span v-if="hasErrors('label')" class="help is-danger">
                                {{ error.label[0] }}
                            </span>
                        </p>
                        <label class="label">Permisos</label>
                        <div v-bind:class="{ 'is-danger': hasErrors('permissions')}">
                            <multiselect v-model="data.permissions" tag-placeholder="Agregar este permiso" placeholder="Selecciona permisos..." track-by="label" label="label" :hide-selected="true" :clear-on-select="false" :close-on-select="false" :multiple="true" :options="permissions">
                            <span v-if="hasErrors('permissions')" class="help is-danger">
                                {{ error.permissions[0] }}
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
            defaultLabel: {
                type: String,
                required: false
            }
        },
        data() {
            return {
                data: {
                    name: '',
                    label: '',
                    permissions: []
                },
                permissions: [],
                error: ''
            }
        },
        mounted() {
            Event.listen('dataRol', (msg) => {
                this.data = msg;
            });
            Event.listen('permissionsForm', (msg) => {
                this.permissions = msg;
            });
            Event.listen('errorForm', (msg) => {
                this.error = msg;
            });
        },
        methods: {
            submit() {
                this.data.permissions = this.parsePermissions();
                this.$emit('submit', this.data);
            },
            parsePermissions() {
                var aux = [];
                for(var i = 0; i < this.data.permissions.length; i++) {
                    aux.push(this.data.permissions[i].id);
                }
                return aux;
            },
            hasErrors(property) {
                return this.error.hasOwnProperty(property) ? true : false;
            }
        }
    }
</script>