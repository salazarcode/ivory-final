<template>
<div>
    <div class="card">
        <select id="credencialesTipos">
            <option v-for="(elem, index) in tiposServicios" :key="index" value="volvo">{{item.titulo}}</option>
        </select>
    </div>    
</div>
</template>

<script>
    export default {
        name: "servicios-single",
        props: {
            servicio: Object,
            tiposServicios: Object,
            tiposCredenciales: Object
        },
        data: function(){
            return{
            }
        },
        mounted() {                 
        },
        methods: {
        },
        computed: {
        }
    }
</script>
