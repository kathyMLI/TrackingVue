<style>
    .trackingapp{
        color: #212121;
        font-size: 48px;
    }
    .media {
        padding-left: 20px;
    }
    .description {
        color: #757575;
    }
</style>
<template>
    <div class="columns">
        <div class="column is-one-third is-offset-one-third">
            <div class="tile is-vertical is-ancestor">
                <div class="media">
                    <div class="media-left">
                        <figure class="image" style="height: 100px; width: 100px;">
                            <img src="img/icon.png" alt="icon" class="icon">
                        </figure>
                    </div>
                    <div class="media-content">
                        <h1 class="trackingapp">
                            TrackingApp
                        </h1>         
                    </div>            
                </div>
                <div class="tile is-parent">
                    <p class="description">La aplicación que monitorea y notifica si tus envíos llegaron a sus destinos!</p>    
                </div>
            </div>            
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        }
    }
</script>
