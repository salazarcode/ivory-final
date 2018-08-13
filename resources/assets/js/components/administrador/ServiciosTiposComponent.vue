<template>
    <div class="card">
        <div class="card-header">Tipos de Servicios</div>

        <div class="card-body">
            <div class="list" v-if="!edit">
                <table class="table table-bordered table-dark">
                    <tr v-for="(elem, index) in servicios_tipos" :key="index">
                        <td>{{elem.titulo}}</td>
                        <td><a href="#" @click.prevent="editar(index)">Editar</a></td>
                        <td><a href="#" @click.prevent="eliminar(elem.id)">Eliminar</a></td>
                    </tr>
                </table>
                <button class="btn btn-success" @click="crear">Crear</button>
            </div>
            
            <div class="edit" v-if="edit">
                <div class="form-group">
                <label for="elem_titulo">Titulo:</label>
                <input type="text" class="form-control" id="elem_titulo" v-model="editable.titulo">
                </div>
                <button class="btn btn-primary" @click="guardar(editable)">Guardar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                edit: false,
                servicios_tipos: [],
                editable:'',
                creando: false
            }
        },
        mounted() {                 
            this.listar();
        },
        methods: {
            listar: function(){
                axios.get('/servicios-tipos')
                .then((res) => {
                    this.servicios_tipos = res.data;
                })
            },
            editar: function(idx){
                this.editable = this.servicios_tipos[idx];
                this.edit = true;
            },
            guardar: function(editable){
                if(this.creando){                    
                    axios.post('/servicios-tipos', {
                        titulo: editable.titulo
                    })
                    .then((response)=> {
                        this.listar();
                        this.edit = false;
                        this.creando = false;
                    });
                }else{
                    axios.post('/servicios-tipos/' + editable.id, {
                        titulo: editable.titulo
                    })
                    .then((response)=> {
                        this.listar();
                        this.edit = false;
                    });
                }
            },
            eliminar: function(id){
                axios.get('/servicios-tipos/destroy/'+ id)
                .then((res) => {
                    this.listar();
                })
            },
            crear: function(){
                this.creando = true;
                this.edit = true;  
                this.editable = {titulo:''};              
            }
        }

    }
</script>
