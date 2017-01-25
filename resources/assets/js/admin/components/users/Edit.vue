<template>
    <div>
        <user-form :action="action" @submit="update"></user-form>
    </div>
</template>

<script>
    import resources from '../../services/resources'
    import router from '../../routes'
    export default {
        data() {
            return {
                data: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    roles: []
                },
                roles: [],
                resource: 'users',
                action: 'Editar'
            }
        },
        beforeMount() {
            resources.getResource(this.resource, router.currentRoute.params.id)
                .then((data) => {
                    this.data.name = data.data.name;
                    this.data.email = data.data.email;
                    this.data.roles = data.data.roles;
                    this.$Progress.finish();
                    Event.fire('dataUser', this.data);
                });
            resources.getResources('roles')
                .then((data) => {
                    this.roles = data.data.data;
                    Event.fire('rolesForm', this.roles);
                })
        },
        methods: {
            update(user) {
                resources.updateResource(this.resource, router.currentRoute.params.id, user)
                    .then((data) => {
                        router.push({ name: 'users'});
                        this.$message({
                            showClose: true,
                            message: 'Usuario actualizado con exito',
                            type: 'success'
                        });
                    })
                    .catch((data) => {
                        Event.fire('errorForm', data.response.data);
                        Event.fire('rolesForm', this.roles);
                        this.$message({
                            showClose: true,
                            message: 'Oops, error al editar usuario',
                            type: 'error'
                        });
                    });
            }
        }
    }
</script>