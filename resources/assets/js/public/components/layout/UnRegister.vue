<style>
    .hero {
        background-color: #C5CAE9;
        color: #FFFFFF;
    }
    .hero-head{
        background-color: #303F9F;
        color: #FFFFFF;
    }
    ul{
        background-color: #303F9F;
    }
    .tabs a {
        color: #FFFFFF;
    }
</style>
<template>
    <section class="hero is-fullheight">
        <div class="hero-head">
            <header class="nav">
                <div class="container">
                    <div class="nav-left">
                        <router-link :to="{ name: 'index' }" class="nav-item">
                            <img src="img/icon.png" alt="icon">
                            <img src="img/logo.png" alt="TrackingApp">
                        </router-link>
                    </div>
                    <div class="nav-right nav-menu">
                        <router-link :to="{ name: 'login' }" class="nav-item">
                            Entrar
                        </router-link>
                        <router-link :to="{ name: 'register' }" class="nav-item">
                            Registro
                        </router-link>
                    </div>
                </div>
            </header>
        </div>
        <div class="hero-body">
            <div class="container has-text-centered">
                <router-view></router-view>
            </div>
        </div>
        <div class="hero-foot">
            <nav class="tabs is-boxed is-one-third is-offset-one-third">
                <div class="container">
                    <ul>
                        <router-link tag="li" :to="{ name: 'index' }"><a>Principal</a></router-link>
                        <router-link tag="li" :to="{ name: 'about' }"><a>TrackingApp</a></router-link>
                        <router-link tag="li" :to="{ name: 'aboutUs' }"><a>¿Quienes somos?</a></router-link>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
</template>
<script>
    export default {
        mounted() {

        }
    }
</script>