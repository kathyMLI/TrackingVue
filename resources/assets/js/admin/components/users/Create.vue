<template>
    <div>
        <user-form :action="action" @submit="create"></user-form>
    </div>
</template>

<script>
    import resources from '../../services/resources'
    import router from '../../routes'
    export default {
        data() {
            return {
                roles: [],
                error: '',
                resource: 'users',
                action: 'Crear'
            }
        },
        beforeMount() {
            resources.filterResources('roles', '')
                .then((data) => {
                    this.roles = data.data.data;
                    Event.fire('rolesForm', this.roles);
                })
        },
        methods: {
            create(user) {
                resources.createResource(this.resource, user)
                    .then((data) => {
                        router.push({ name: 'users'});
                    })
                    .catch((data) => {
                        Event.fire('errorForm', data.response.data);
                        Event.fire('rolesForm', this.roles);
                    });
            }
        }
    }
</script>