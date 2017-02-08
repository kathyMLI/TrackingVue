<template>
    <div>
        <div v-if="ready == false">
            <h1 class="title">Estamos procesando tu petición</h1>
            <hr>
        </div>
        <div v-else>
            <h1 class="title">Email verificado con éxito</h1>
            <h2>Bienvenido, empieza a disfrutar de TrackingApp</h2>
            <hr>
        </div>
    </div>
</template>
<script>
    import auth from '../../services/auth'
    export default {
        data() {
            return {
                ready: false
            }
        },
        mounted() {
            console.log(this.$route);
            auth.validate(this.$route.params.id, {
                'validation_token': this.$route.query.validation_token
            }).then((data) => {
                this.ready = true;
                console.log('MAIL VALIDADO CON EXITO', data);
            }).catch((data) => {
                console.log('ERROR AL VALIDAR MAIL');
            });
        }
    }
</script>