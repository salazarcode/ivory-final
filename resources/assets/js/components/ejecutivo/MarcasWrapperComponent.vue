<template>
    <div class="card">
        <marcas-single v-for="(elem, index) in listables" :key="index" :marca="elem"></marcas-single>
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                listables: [],
                rutas: {
                    listar: "/marcas"
                }
            }
        },
        mounted() {                 
            this.listar();
        },
        methods: {
            listar: function(){
                axios.get(this.rutas.listar)
                .then((res) => {
                    this.listables = res.data;
                })
            }
        }
    }
</script>
