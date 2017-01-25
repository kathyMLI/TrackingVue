<template>
    <rol-form :action="action" @submit="create"></rol-form>
</template>

<script >
    import resources from '../../services/resources'
    import permission from '../../services/permission'
    import router from '../../routes'
    export default {
        data() {
            return {
                permissions: [],
                resource: 'roles',
                action: 'Crear'
            }
        },
        beforeMount() {
            permission.getResources()
                .then((data) => {
                    this.permissions = data.data;
                    Event.fire('permissionsForm', this.permissions);
                });
        },
        methods: {
            create(rol) {
                resources.createResource(this.resource, rol)
                    .then((data) => {
                        router.push({ name: 'roles' });
                        this.$message({
                            showClose: true,
                            message: 'Rol creado con exito',
                            type: 'success'
                        });
                    })
                    .catch((data) => {
                        Event.fire('errorForm', data.response.data);
                        Event.fire('permissionsForm', this.permissions);
                        this.$message({
                            showClose: true,
                            message: 'Oops, error al crear rol',
                            type: 'error'
                        });
                    });
            }
        }
    }
</script>