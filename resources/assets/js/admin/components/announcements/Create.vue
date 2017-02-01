<template>
    <div>
        <div>
            <h1 class="title">Nuevo anuncio</h1>
            <hr>
        </div>
        <div>
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <form>
                        <label class="label">Titulo</label>
                        <p class="control">
                            <input type="text" id="title" v-model="data.title" class="input">
                        </p>
                        <label class="label">Mensaje</label>
                        <p class="control">
                            <textarea id="message" class="textarea" v-model="data.message"></textarea>
                        </p>
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
    import resources from '../../services/resources'
    import router from '../../routes'
    export default {
        data() {
            return {
                data: {},
                resource: 'announcements'
            }
        },
        methods: {
            submit() {
                resources.createResource(this.resource, this.data)
                    .then((data) => {
                        router.push({ name: 'announcement' });
                    })
                    .catch((data) => {
                        console.log('ERROR AL CREAR ANUNCIO');
                    });
            }
        }
    }
</script>