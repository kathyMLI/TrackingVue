<style>
    .tabs li.is-active a {
    color: #303F9F;
    }
</style>
<template>
    <div>
        <section class="hero">
            <div class="hero-head">
                <header class="nav">
                    <div class="container">
                        <div class="nav-left">
                            <a class="nav-item">
                                <img src="img/icon.png" alt="icon">
                                <img src="img/logo.png" alt="TrackingApp">
                            </a>
                        </div>
                        <span id="nav-toggle" class="nav-toggle" v-bind:class="{ 'is-active': toggleActive }" @click="toggleActive = !toggleActive">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <div class="nav-right nav-menu" v-bind:class="{ 'is-active': toggleActive }">
                            <router-link :to="{ name: 'trackings' }" class="nav-item">Trackings</router-link>
                            <router-link :to="{ name: 'accountSettings' }" class="nav-item">Cuenta</router-link>
                            <a class="nav-item" @click="logOut()">Salir</a>
                        </div> 
                    </div>
                </header>
            </div>
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                        TrackingApp
                    </h1>
                    <h2 class="subtitle">
                        La aplicación que monitorea y notifica si tus envíos llegaron a sus destinos!
                    </h2>
                </div>
            </div>
            <div class="hero-foot" v-if="showFoot">
                <nav class="tabs is-boxed">
                    <div class="container">
                        <ul>
                            <router-link tag="li" :to="{ name: 'trackings' }">
                                <a>Seguimiento</a>
                            </router-link>
                        </ul>
                    </div>
                </nav>
            </div>
        </section>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                toggleActive: false
            }
        },
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