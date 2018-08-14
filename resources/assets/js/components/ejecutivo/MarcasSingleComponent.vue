<template>
<div>
    <div class="card">
        <div class="list" v-if="!edit">
            <div class="card-body">
                <h3>{{marca.titulo}}</h3>
            </div>
            <div class="card-footer">
                <a href="#" @click.prevent="editar">Editar</a>
                <a href="#" @click.prevent="eliminar(marca.id)">Eliminar</a>
            </div>
        </div>
        <div class="edit" v-if="edit">
            <div class="card-body">
                <div class="form-group">
                    <label for="elem_titulo">Titulo:</label>
                    <input type="text" class="form-control" id="elem_titulo" v-model="marca.titulo">
                </div>
                <button class="btn btn-primary" @click="guardar">Guardar</button>
                <button class="btn btn-danger" @click="cancelar">Calcelar</button>
            </div>
        </div>
    </div>    
</div>
</template>

<script>
    export default {
        props: {
            marca: {
                type: Object
            }
        },
        data: function(){
            return{
                edit: false,
                listables: [],
                editable:'',
                creando: false,
                rutas: {
                    listar: "/marcas",
                    guardarNuevo: "/marcas",
                    guardarEditado: "/marcas/",
                    eliminar: "/marcas/destroy/"
                }
            }
        },
        mounted() {                 
            this.listables = [this.marca]
        },
        methods: {
            editar: function(idx){
                this.editable = this.marca;
                this.edit = true;
            },
            guardar: function(editable){
                axios.post(this.rutas.guardarEditado + this.marca.id, {
                    titulo: this.marca.titulo
                })
                .then((response)=> {
                    this.edit = false;
                });
            },
            eliminar: function(id){
                axios.get(this.rutas.eliminar + id)
                .then((res) => {
                    this.$destroy()
                })
            },
            crear: function(){
                this.creando = true;
                this.edit = true;  
                this.editable = {titulo:''};              
            },
            cancelar: function(){
                this.editable = {titulo:''}; 
                this.creando = false;
                this.edit = false;    
            }        
        }
    }
</script>
