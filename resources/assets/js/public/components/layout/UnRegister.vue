<template>
    <section class="hero is-primary is-fullheight">
        <div class="hero-head">
            <header class="nav">
                <div class="container">
                    <div class="nav-left">
                        <router-link :to="{ name: 'index' }" class="nav-item">
                            <img src="img/logo2.png" alt="Aphix">
                        </router-link>
                    </div>
                    <div class="nav-right nav-menu">
                        <span class="nav-item">
                            <router-link :to="{ name: 'login' } " class="button is-primary is-inverted" >Entrar</router-link>
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
            <nav class="tabs is-boxed is-fullwidth">
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