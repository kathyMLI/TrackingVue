<style>
    article{
        color: #004d40;
    }
    .content: {
        color: #004d40;
    }
</style>
<template>
    <div>
        <div class="columns container has-text-centered ">
            <article class="tile is-vertical">
                <div class="content">
                    <h1 class="title">¿Qué es TrackingApp?</h1>
                    <div class="column content is-half is-offset-one-quarter">
                        <p>TrackingApp la manera más fácil de monitorear tus envíos, solo debes ingresar tu código de envío y nuestra aplicación hará el resto.</p>

                        <p>Nosotros te notificaremos mediante el correo que registres cada vez que tu envío cambie de estado. De esta manera no tendrás que preocuparte de revisar tu envío, sabrás al instanse cuando tu envío llege a su destino.</p> 
                    </div>
                </div>
                <h1 class="title"></h1>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
    	data() {
            return {
                data:{
                    rut: '',
                    rutNumber:'123456789' 
                }                  
            }
        },
        mounted() {
        }
    }
</script>