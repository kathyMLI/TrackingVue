<template>
    <div>
        <nav class="nav">
            <div class="nav-left nav-menu">
                <router-link :to="{ name: 'index' }" class="nav-item">
                    <img src="img/logo2.png" alt="Aphix">
                </router-link>
            </div>
            <div class="nav-right nav-menu">
                <router-link :to="{ name: 'login' }" class="nav-item">Entrar</router-link>
                <router-link :to="{ name: 'register' }" class="nav-item">Registro</router-link>
            </div>
        </nav>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {

        }
    }
</script>