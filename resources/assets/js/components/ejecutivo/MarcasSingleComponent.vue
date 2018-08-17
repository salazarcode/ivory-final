<template>
<div>
    <div class="card">
        <div class="list" v-if="!isEditable">
            <div class="card-body">
                <h3>{{marca.id}} - {{marca.titulo}}</h3>
            </div>
            <div class="card-footer">
                <a href="#" @click.prevent="editar">Editar</a>
                <a href="#" @click.prevent="configurar">Configurar</a>
                <a href="#" @click.prevent="eliminar">Eliminar</a>
            </div>
        </div>
        <div class="edit" v-if="isEditable">
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
        name: "marcas-single",
        props: {
            marca: Object,
            edit: Boolean
        },
        data: function(){
            return{
                listables: [],
                editable:'',                
                creando: false,
                isEditable: false,
                rutas: {
                    listar: "/marcas",
                    guardarNuevo: "/marcas",
                    guardarEditado: "/marcas/",
                    eliminar: "/marcas/destroy/"
                }
            }
        },
        mounted() {                 
            this.listables = [this.marca];
            this.isEditable = this.edit;
        },
        methods: {
            editar: function(idx){
                this.editable = this.marca;
                this.isEditable = true;
            },
            guardar: function(){
                if(this.marca.hasOwnProperty("id"))
                {
                    axios.post(this.rutas.guardarEditado + this.marca.id, {
                        titulo: this.marca.titulo
                    })
                    .then((response)=> {
                        this.isEditable = false;
                    });
                }
                else
                {
                    axios.post(this.rutas.guardarNuevo, {
                        titulo: this.marca.titulo
                    })
                    .then((response)=> {
                        this.isEditable = false;
                        this.$emit('actualizar_listables');
                    });
                }
            },
            eliminar: function(){
                axios.get(this.rutas.eliminar + this.marca.id)
                .then((res) => {
                    this.$emit('delete');
                });
            },
            crear: function(){
                this.creando = true; 
                this.edit = true;  
                this.editable = {titulo:''};              
            },
            cancelar: function(){
                this.editable = {titulo:''}; 
                this.creando = false;
                this.isEditable = false;    
            },
            configurar: function(){
                this.$store.commit('setMarcaSeleccionada', {
                    marca: this.marca
                })
            }
        },
        computed: {
        }
    }
</script>
