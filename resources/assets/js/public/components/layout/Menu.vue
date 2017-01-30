<template>
    <div>
        <section class="hero is-primary">
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
                            <router-link :to="{ name: 'trackings' }" class="nav-item">Administracion</router-link>
                            <router-link :to="{ name: 'accountSettings' }" class="nav-item">Cuenta</router-link>
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
            <div class="hero-foot" v-if="showFoot">
                <nav class="tabs is-boxed">
                    <div class="container">
                        <ul>
                            <router-link tag="li" :to="{ name: 'trackings' }"><a>Seguimiento</a></router-link>
                            <a>Estadisticas</a>
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
            showFoot: function() {
                if(this.$route.name.indexOf('home') != -1 || this.$route.name.indexOf('account') != -1) {
                    return false;
                }
                return true;
            }
        },
        methods: {
            logOut() {
                this.$emit('logOut');
            }
        }
    }
</script>