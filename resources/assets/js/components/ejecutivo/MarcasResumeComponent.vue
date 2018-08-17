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
                    {{marca.titulo}}
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'marcas-resume',
        data: function(){
            return{
            }
        },
        computed:  {
            marca: function(){
                return this.$store.state.marcaSeleccionada
            }
        }
    }
</script>
