<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">    
                <div class="card">     
                    <button class="btn btn-primary" @click="agregarServicio">Agregar Servicio</button>
                    
                    <div v-if="creating">
                        <br><br>
                        <div class="card">
                            <div class="card-header">
                                Formulario de creación
                            </div>
                            <div class="card-body">

                                <select name="servicios_tipos" id="servicios_tipos" v-model="servicioSeleccionado">
                                    <option disabled value="">Selecciona...</option>
                                    <option :value="elem.id" v-for="(elem, index) in tiposServicios" :key="index">
                                        {{elem.titulo}}
                                    </option>
                                </select>

                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success" @click="guardarNuevo">Guardar</button>
                                <button class="btn btn-danger" @click="cancelarCreacion">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <template v-if="servicios.length == 0">
                    <h1>No hay ningún servicio creado aún</h1>
                </template>
                <template v-else>             
                    <ul>
                        <servicios-single
                            v-for="(elem, index) in servicios"
                            :key="index"
                            :servicio="elem"
                        />
                    </ul>   
                </template>
            </div>
        </div>
    </div> 

</template>

<script>
    import ServiciosSingle from './ServiciosSingleComponent';
    export default {
        name: 'servicios',
        props: {
            'marca': Object
        },
        components: {
            ServiciosSingle
        },
        data: function(){
            return{                
                rutas: {
                    listar: "/servicios/",
                    guardarNuevo: "/servicios",
                    eliminar: "/servicios/destroy/"
                },
                servicios: '',
                creating: false,
                servicioSeleccionado: ''
            }
        },
        methods: {
            listar: function(){
                axios.get(this.rutas.listar + this.marca.id)
                .then((res) => {
                    this.servicios = res.data;
                })
            },
            agregarServicio: function()
            {
                this.creating = true;
            },
            cancelarCreacion: function()
            {
                this.servicioSeleccionado = '';
                this.creating = false;
            },  
            guardarNuevo: function(){
                axios.post(this.rutas.guardarNuevo, {
                    serviciotipo_id: this.servicioSeleccionado,
                    marca_id: this.marca.id
                })
                .then((response)=> {
                    this.listar();
                    this.cancelarCreacion();
                });
            },
            getTipoById: function(id){
                let result = this.tiposServicios.find((elem)=>{return elem.id == id});
                if(result != undefined)
                    return result.titulo;
                else    
                    return "No se encontró"
            },
            eliminarServicio: function(id){
                axios.get(this.rutas.eliminar + id)
                .then((res) => {
                    this.servicios = res.data;
                })
            }
        },
        mounted(){
            axios.get('/credenciales-tipos')
            .then((res) => {
                this.$store.commit("setTiposCredenciales", {
                    'tiposCredenciales': res.data
                });
            });
            
            axios.get('/servicios-tipos')
            .then((res) => {
                this.$store.commit("setTiposServicios", {
                    'tiposServicios': res.data
                });
            });

            axios.get('/servicios/'+this.marca.id)
            .then((res) => {
                this.servicios = res.data;
            });
        },
        computed: {           
            tiposCredenciales: function(){
                return this.$store.state.tiposCredenciales
            },   
            tiposServicios: function(){
                return this.$store.state.tiposServicios
            }
        }

    }
</script>
