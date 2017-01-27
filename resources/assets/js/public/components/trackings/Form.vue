<template>
    <div>
        <div>
            <h1 class="title">{{ action }} Paquete</h1>
            <hr>
        </div>
        <div>
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <form>
                        <label class="label">Codigo</label>
                        <p class="control">
                            <input type="text" id="code" v-model="data.code" class="input" v-bind:class="{ 'is-danger': hasErrors('code')}" v-if="action != 'Editar'">
                            <input type="text" id="code" v-model="data.code" class="input" v-bind:class="{ 'is-danger': hasErrors('code')}" disabled v-else>
                        </p>
                        <span v-if="hasErrors('code')" class="help is-danger">
                                {{ error.code[0] }}
                            </span>
                        <label class="label">Descripcion</label>
                        <p class="control">
                            <textarea id="message" class="textarea" v-model="data.description" v-bind:class="{ 'is-danger': hasErrors('description')}"></textarea>
                        </p>
                        <span v-if="hasErrors('description')" class="help is-danger">
                                {{ error.description[0] }}
                            </span>
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
            defaultCode: {
                type: String,
                required: false
            },
            defaultDescription: {
                type: String,
                required: false
            }
        },
        data() {
            return {
                data: {
                    code: '',
                    description: ''
                },
                error: '',
                roles: []
            }
        },
        beforeMount(){
            if (this.defaultCode != null) {
                this.data.code = this.defaultCode
            }
            if (this.defaultDescription != null) {
                this.data.description = this.defaultDescription
            }
        },
        mounted() {
            Event.listen('dataTracking', (msg) => {
                this.data = msg;
            });
            Event.listen('errorForm', (msg) => {
                this.error = msg;
            });
        },
        methods: {
            submit() {
                this.$emit('submit', this.data);
            },
            hasErrors(property) {
                return this.error.hasOwnProperty(property) ? true : false;
            }
        }
    }
</script>