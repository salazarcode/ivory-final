<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">    
                <div class="card">     
                    <button class="btn btn-primary" @click="agregarServicio">Agregar Servicio</button>
                </div>
            </div>
            <div class="col-md-8">
                <template v-if="servicios.length == 0">
                    <h1>No hay ningún servicio creado aún</h1>
                </template>
                <template v-else>             
                    Hay algunos    
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
                    listar: "/servicios",
                },
                servicios: '',
                tiposServicios: '',
                tiposCredenciales: ''
            }
        },
        methods: {
            listar: function(){
                axios.get(this.rutas.listar)
                .then((res) => {
                    this.elementos = res.data;

                })
            },
            agregarServicio: function(){
                return 0;
            }
        },
        mounted(){
            axios.get('/credenciales-tipos')
            .then((res) => {
                this.credencialesTipos = res.data;
            });
            
            axios.get('/servicios-tipos')
            .then((res) => {
                this.serviciosTipos = res.data;
            });

            axios.get('/servicios/'+this.marca.id)
            .then((res) => {
                this.servicios = res.data;
            });

        }

    }
</script>
