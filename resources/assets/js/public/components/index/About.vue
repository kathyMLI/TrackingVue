<template>
    <div>
    	<div class="panel-heading">VueRut directive test</div>
        <div class="panel-block">
        	<input v-model="data.rut" v-rut type="text" class="input">
        	<h4>{{data.rut}}</h4>
        </div>
        <div class="panel-heading">VueRut Filter test</div>
        <div class="panel-block">
        	<p>{{ data.rutNumber | rut}}</p>
        </div>
    </div>
</template>

<script>
    export default {
    	data() {
            return {
                data:{
                    rut: '',
                    rutNumber:'123456789' 
                }                  
            }
        },
        mounted() {
        }
    }
</script>