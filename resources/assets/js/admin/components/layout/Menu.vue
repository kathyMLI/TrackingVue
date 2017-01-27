<template>
    <div>
        <section class="hero is-info">
            <div class="hero-head">
                <header class="nav">
                    <div class="container">
                        <div class="nav-left">
                            <a class="nav-item">
                                <img src="img/logo2.png" alt="Aphix">
                            </a>
                        </div>
                        <div class="nav-right nav-menu">
                            <router-link :to="{ name: 'home' }" class="nav-item">Home</router-link>
                            <router-link :to="{ name: 'users' }" class="nav-item">Administracion</router-link>
                            <a class="nav-item" @click="logOut()">Salir</a>
                        </div> 
                    </div>
                </header>
            </div>
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
                            <router-link tag="li" :to="{ name: 'trackings' }"><a>Paquetes</a></router-link>
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
        },
        methods: {
            logOut() {
                this.$emit('logOut');
            }
        }
    }
</script>