<template>
    <div class="card">
        <button class="btn btn-primary" @click="crearMarca">Crear Marca</button><br>
        <div ref="marcasContainer">
            <marcas-single 
                v-for="(elem, index) in listables" 
                :key="index" 
                :marca="elem"
                :edit="false"
                v-on:delete="onDeleteMarca"
                v-on:actualizar_listables="onActualizarListables"
            >
            </marcas-single>
        </div>

        
    </div>
</template>

<script>
    import MarcasSingle from './MarcasSingleComponent';
    import Vue from 'vue';
    export default {
        name: 'marcas',
        components: {
            'marcas-single': MarcasSingle
        },
        data: function(){
            return{
                listables: [],
                rutas: {
                    listar: "/marcas",
                    guardarNuevo: "/marcas",
                },
                creandoMarca: false
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
            onDeleteMarca: function(){
                this.listar();
            },
            onActualizarListables: function(){
                this.listar();
            },
            crearMarca: function(response){
                axios.post(this.rutas.guardarNuevo, {
                    titulo: "Título por defecto"
                })
                .then((response)=>{
                    if(response.data.hasOwnProperty("code") && response.data.code == 99)
                    {
                        console.log(response.data)
                    }
                    else
                    {
                        this.listables.push(response.data)
                    }
                });

            }
        }
    }
</script>
