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
    <div>
        <section class="hero is-medium">
            <div class="hero-head">
                <header class="container">
                    <div class="nav">
                        <div class="nav-left">
                            <router-link :to="{ name: 'index' }" class="nav-item is-brand">
                                <img src="img/icon.png" alt="icon">
                                <img src="img/logo.png" alt="TrackingApp">
                            </router-link>
                        </div>
                        <span id="nav-toggle" class="nav-toggle" v-bind:class="{ 'is-active': toggleActive }" @click="toggleActive = !toggleActive">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <div class="nav-right nav-menu" v-bind:class="{ 'is-active': toggleActive }">
                            <a class="nav-item" @click="modalView = !modalView">Entrar</a>
                        </div>
                    </div>
                </header>
            </div>
            <div class="hero-body">
                <div class="container has-text-centered">
                    <router-view></router-view>
                </div>
            </div>
        </section>
        <div class="modal" v-bind:class="{ 'is-active': modalView}">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                    <loginIndex></loginIndex>
                </div>
            </div>
            <button class="modal-close" @click="modalView = !modalView"></button>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="content has-text-centered">
                    <strong>TrackingApp</strong>. <a href="app#/about">Acerca de nosotros</a>
                </div>
            </div>
        </footer>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                toggleActive: false,
                modalView: false
            }
        },
        mounted() {

        }
    }
</script>