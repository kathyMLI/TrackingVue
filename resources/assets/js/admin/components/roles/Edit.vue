<template>
    <div>
        <rol-form :action="action" @submit="update"></rol-form>
    </div>
</template>

<script>
    import resources from '../../services/resources'
    import permission from '../../services/permission'
    import router from '../../routes'
    export default {
        data() {
            return {
                data: {
                    name: '',
                    label: '',
                    permissions: []
                },
                permissions: [],
                resource: 'roles',
                action: 'Editar'
            }
        },
        beforeMount() {
            resources.getResource(this.resource, router.currentRoute.params.id)
                .then((data) => {
                    this.data.name = data.data.name;
                    this.data.label = data.data.label;
                    this.data.permissions = data.data.permissions;
                    Event.fire('dataRol', this.data);
                });
            permission.getResources()
                .then((data) => {
                    this.permissions = data.data;
                    Event.fire('permissionsForm', this.permissions);
                });
        },
        methods: {
            update(rol) {
                resources.updateResource(this.resource, router.currentRoute.params.id, rol)
                    .then((data) => {
                        console.log('Rol Actualizado', data.data);
                        router.push({ name: 'roles'});
                        this.$message({
                            showClose: true,
                            message: 'Rol actualizado con exito',
                            type: 'success'
                        });
                    })
                    .catch((data) => {
                        Event.fire('errorForm', data.response.data);
                        Event.fire('permissionsForm', this.permissions);
                        this.$message({
                            showClose: true,
                            message: 'Oops, error al editar rol',
                            type: 'error'
                        });
                    });
            }
        }
    }
</script>