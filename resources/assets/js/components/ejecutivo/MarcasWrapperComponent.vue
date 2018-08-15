<template>
    <div class="card">
        <marcas-single 
            v-for="(elem, index) in listables" 
            :key="index" 
            :marca="elem"
            v-on:delete="onDeleteMarca"
        >
        </marcas-single>
    </div>
</template>

<script>
    import MarcasSingle from './MarcasSingleComponent';
    export default {
        name: "marcas-wrapper",
        components: {
            'marcas-single': MarcasSingle
        },
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
            },
            onDeleteMarca: function(id){
                let index = this.listables.find((elem) => {
                    return elem.id == id
                });
                this.listables.splice(index, 1);
            }
        }
    }
</script>
