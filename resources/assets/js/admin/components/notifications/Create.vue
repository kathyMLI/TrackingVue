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
    import notificationService from '../../services/notificationService'
    import router from '../../routes'
    export default {
        data() {
            return {
                data: {}
            }
        },
        methods: {
            submit() {
                notificationService.sendAnnouncement(this.data)
                    .then((data) => {
                        this.$message({
                            showClose: true,
                            message: 'Anuncio enviado con exito',
                            type: 'success'
                        });
                        router.push({ name: 'home' });
                    })
            }
        }
    }
</script>