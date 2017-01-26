<template>
    <trackingForm :action="action" @submit="create"></trackingForm>
</template>
<script>
    import trackingService from '../../services/trackingService'
    import router from '../../routes'
    export default {
        data() {
            return {
                resource: 'trackings',
                action: 'Crear',
                error: '',
                me: {}
            }
        },
        mounted() {
            Event.listen('me', (msg) => { this.me = msg});
        },
        methods: {
            create(tracking) {
                trackingService.createResource(this.me.id, tracking)
                    .then((data) => {
                        console.log('creado');
                        router.push({ name: 'trackings' });
                    })
                    .catch((data) => {
                        Event.fire('errorForm', data.response.data);
                    });
            }
        }
    }
</script>