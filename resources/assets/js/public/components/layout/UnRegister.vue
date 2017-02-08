<style>
    .hero {
        background-color: #e0f2f1;
        color: #004d40;
    }
    .hero-head{
        background-color: #009688;
        color: #004d40;
    }
    ul{
        background-color: #009688;
        color: #e0f2f1;
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
                        <span class="nav-item">
                            <router-link :to="{ name: 'login' } " class="button is-inverted" >Entrar</router-link>
                        </span>
                        <span class="nav-item">
                            <router-link :to="{ name: 'register' }" >Registro</router-link>
                        </span>
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
            <nav class="tabs is-boxed is-one-third">
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