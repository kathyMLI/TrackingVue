<template>
    <trackingForm :action="action" @submit="create"></trackingForm>
</template>
<script>
    import resources from '../../services/resources'
    import router from '../../routes'
    export default {
        data() {
            return {
                resource: 'trackings',
                action: 'Crear',
                error: ''
            }
        },
        beforeMount() {
            resources.getResources('platforms')
                .then((data) => {
                    console.log(data.data);
                    Event.fire('dataPlatforms', data.data);
                })
        },
        methods: {
            create(tracking) {
                console.log(tracking);
                resources.createResource(this.resource, tracking)
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