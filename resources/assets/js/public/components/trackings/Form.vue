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
                        <div class="field">
                            <label class="label">Código</label>
                            <p class="control">
                                <input type="text" id="code" v-model="data.code" class="input" v-bind:class="{ 'is-danger': hasErrors('code')}" v-if="action != 'Editar'">
                                <input type="text" id="code" v-model="data.code" class="input" v-bind:class="{ 'is-danger': hasErrors('code')}" disabled v-else>
                            </p>
                            <span v-if="hasErrors('code')" class="help is-danger">
                                {{ error.code[0] }}
                            </span>
                        </div>
                        <div class="field">
                            <label class="label">Compañia</label>
                            <p class="control">
                                <span class="select">
                                    <select v-model="data.platform">
                                        <option v-for="platform in platforms" :value="platform.id">{{ platform.name }}</option>
                                    </select>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <label class="label">Descripción</label>
                            <p class="control">
                                <textarea id="message" class="textarea" v-model="data.description" v-bind:class="{ 'is-danger': hasErrors('description')}"></textarea>
                            </p>
                            <span v-if="hasErrors('description')" class="help is-danger">
                                {{ error.description[0] }}
                            </span>
                        </div>
                        <div class="field is-grouped">
                            <p class="control">
                                <button class="button" @click="submit()">
                                    Envíar
                                </button>
                            </p>
                            <p class="control">
                                <button class="button is-link">Cancel</button>
                            </p>
                        </div>
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
            }
        },
        data() {
            return {
                data: {
                    code: '',
                    description: '',
                    platform: ''
                },
                error: '',
                platforms: []
            }
        },
        mounted() {
            Event.listen('dataTracking', (msg) => {
                this.data = msg;
            });
            Event.listen('errorForm', (msg) => {
                this.error = msg;
            });
            Event.listen('dataPlatforms', (msg) => {
                this.platforms = msg;
            })
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