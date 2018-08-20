<template>
<div>
    <div>
        <div class="card">
            <template v-if="!isEditing">
                <div class="card-body">
                    {{tipoServicio.titulo}} - 
                    <a href="#" @click.prevent="setCredenciales">
                        Credenciales
                    </a> 
                </div>
            </template> 
            <template v-else>   
                <div class="card-header">
                    {{tipoServicio.titulo}}
                </div> 
                <div class="card-body dark">
                    <credenciales-single
                        v-for="(elem, index) in tiposCredenciales" 
                        :key="index"
                        :servicio="servicio"
                        :tipo="elem"
                    />
                </div>       
                <div class="card-footer">
                    <button class="btn btn-success" @click="guardar">Guardar</button>  
                    <button class="btn btn-danger" @click="cancelar">Cancelar</button> 
                </div>   
            </template> 
        </div>    
        <br>
    </div>
</div>
</template>

<script>
    import CredencialesSingle from './CredencialesSingleComponent';
    export default {
        name: "servicios-single",
        props: {
            servicio: Object
        },
        data(){
            return {
                isEditing: false
            }
        },
        components: {
            CredencialesSingle
        },
        methods: {
            setCredenciales: function(){
                this.isEditing = true;
            },
            cancelar: function(){
                this.isEditing = false;
            },
            guardar: function(){
                //procedimiento de guardar
                this.isEditing = false;
            }
        },
        computed: {
            tipoServicio: function(){
                let tipo = this.$store.state.tiposServicios.find((elem)=>{
                    return elem.id == this.servicio.serviciotipo_id
                });
                return tipo
            },
            tiposCredenciales: function(){
                return this.$store.state.tiposCredenciales
            }
        }
    }
</script>
