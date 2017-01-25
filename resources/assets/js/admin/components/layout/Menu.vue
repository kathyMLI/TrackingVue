<template>
    <div>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                        Vuelerplate
                    </h1>
                    <h2 class="subtitle">
                        Laravel + Vue
                    </h2>
                </div>
            </div>
            <div class="hero-foot" v-if="state != 'home'">
                <nav class="tabs is-boxed">
                    <div class="container">
                        <ul>
                            <router-link tag="li" :to="{ name: 'users' }"><a>Usuarios</a></router-link>
                            <router-link tag="li" :to="{ name: 'roles' }"><a>Roles</a></router-link>
                            <router-link tag="li" :to="{ name: 'announcement' }"><a>Anuncios</a></router-link>
                        </ul>
                    </div>
                </nav>
            </div>
        </section>
    </div>
</template>
<script>
    export default {
        computed: {
            state: function() {
                return this.$route.name;
            }
        }
    }
</script>