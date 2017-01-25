<template>
    <div>
        <div>
            <nav class="level">
                <p class="level-item has-text-centered">
                    <router-link :to="{ name: 'home' }" class="link is-info">Home</router-link>
                </p>
                <p class="level-item has-text-centered">
                    <router-link :to="{ name: 'trackings' }" class="link is-info">Paquetes</router-link>
                </p>
                <p class="level-item has-text-centered">
                    <img src="img/logo2.png" alt="Aphix">
                </p>
                <p class="level-item has-text-centered">
                    <a class="link is-info" @click='notificationsMenu = true'>Cuenta</a>
                </p>
                <p class="level-item has-text-centered">
                    <a class="link is-info" @click="logOut()">Salir</a>
                </p>
            </nav>
        </div>
        <div>
            <heroMenu></heroMenu>
        </div>
        <div class="container">
            <!-- <div class="notifications">
                <notifications :show="notificationsMenu" @close='notificationsMenu = false' :news="me.notifications" :algo="algo"></notifications>
            </div> -->
            <div class="content column">
                <div class="section">
                    <div class="container">
                        <router-view></router-view>
                    </div>
                </div>
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
                    });
            }
        }
    }
</script>