<template>
    <div>
        <h1 class="title">Hemos enviado un correo de verificación</h1>
        <h2>ingresa al correo que has registrado para terminar el registro,
            si tienes problemas para recibir el correo de verificación 
            haz click <a @click="resendMail()">aqui</a>
        </h2>
        <hr>
    </div>
</template>
<script>
    import auth from '../../services/auth'
    export default {
        mounted() {
        },
        methods: {
            resendMail() {
                console.log(this.$route);
                // auth.validate(this.$route.params.id).
                // then((data) => {
                // // console.log('MAIL VALIDADO CON EXITO', data);
                // }).catch((data) => {
                // // console.log('ERROR AL VALIDAR MAIL');
                // });
            }
        }
    }
</script>