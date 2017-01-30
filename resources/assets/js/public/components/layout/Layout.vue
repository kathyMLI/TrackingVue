<template>
    <div>
        <div>
            <heroMenu @logOut="logOut"></heroMenu>
        </div>
        <div class="container">
            <div class="content column">
                <section class="section">
                    <div class="container">
                        <router-view></router-view>
                    </div>
                </section>
            </div>
        </div>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>

<script>
    import auth from '../../helpers/auth'
    import router from '../../routes'
    import resources from '../../services/resources'
    export default {
        data() {
            return {
                asideMenu: false,
                notificationsMenu: false,
                me: []
            }
        },
        beforeMount() {
            auth.setAuthHeader(localStorage.getItem('token'));
            resources.me()
                .then(({data}) => {
                    this.me = data;
                });
        },
        computed: {
            notificationsSize: function() {
                return _.filter(this.me.notifications, (n) => {
                    return !n.read_at
                }).length;
            }
        },
        methods: {
            logOut() {
                auth.logOut();
                router.push({ name: 'login'});
            }
        },
        watch: {
            '$route' (to, from) {
                resources.me()
                    .then(({data}) => {
                        this.me = data;
                        Event.fire('me', this.me);
                    });
            }
        }
    }
</script>