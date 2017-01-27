<template>
    <trackingForm :action="action" @submit="update"></trackingForm>
</template>
<script>
    import resources from '../../services/resources'
    import router from '../../routes'
    export default {
        data() {
            return {
                data: {
                    code: '',
                    description: ''
                },
                resource: 'trackings',
                action: 'Editar'
            }
        },
        beforeMount() {
            resources.getResource(this.resource, router.currentRoute.params.id)
                .then((data) => {
                    this.data.code = data.data[0].code;
                    this.data.description = data.data[0].pivot.description;
                    Event.fire('dataTracking', this.data);
                });
        },
        methods: {
            update(tracking) {
                resources.updateResource(this.resource, router.currentRoute.params.id, tracking)
                    .then((data) => {
                        router.push({ name: 'trackings'});
                    })
                    .catch((data) => {
                        Event.fire('errorForm', data.response.data);
                    });
            }
        }
    }
</script>