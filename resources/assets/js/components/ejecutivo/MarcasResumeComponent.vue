<template>
    <div>
        <div class="card">            
            <div v-if="marca != null">
                <div class="card-header">                 
                    {{marca.titulo}}
                </div>
            </div>
            
            <div class="card-body">
                <template v-if="marca == null">
                    <h1>Debes seleccionar una marca a la izquerda</h1>
                </template>
                <template v-else>             
                    <servicios :marca="marca" />      
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    import Servicios from './ServiciosComponent';
    export default {
        name: 'marcas-resume',
        data: function(){
            return{
            }
        },
        components: {
            Servicios
        },
        computed:  {
            marca: function(){
                return this.$store.state.marcaSeleccionada
            }
        }
    }
</script>
