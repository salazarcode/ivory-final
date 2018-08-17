<template>
    <div class="card">
        <div class="card-header">Users</div>

        <div class="card-body">
            <div class="list" v-if="!edit">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Max. Marcas</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users" :key="index">
                            <td>{{user.name}}</td>
                            <td>{{user.email}}</td>
                            <td>{{user.limite}}</td>
                            <td><a href="#" @click.prevent="editar(index)">Editar</a></td>
                            <td><a href="#" @click.prevent="eliminar(user.id)">Eliminar</a></td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-success" @click="crear">Crear</button>
            </div>
            
            <div class="edit" v-if="edit">
                <div class="form-group">
                    <label for="usr_name">Name:</label>
                    <input type="text" class="form-control" id="usr_name" v-model="editable.name">
                </div>

                <div class="form-group">
                    <label for="usr_email">Email:</label>
                    <input type="text" class="form-control" id="usr_email" v-model="editable.email">
                </div>

                <div class="form-group">
                    <label for="usr_limite">Límite:</label>
                    <input type="number" class="form-control" id="usr_limite" v-model="editable.limite">
                </div>

                <button class="btn btn-primary" @click="guardar(editable)">Guardar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "users-component",
        data: function(){
            return{
                edit: false,
                users: [],
                editable:'',
                creando: false
            }
        },
        mounted() {                 
            this.listar();
        },
        methods: {
            listar: function(){
                axios.get('/users')
                .then((res) => {
                    this.users = res.data;
                })
            },
            editar: function(idx){
                this.editable = this.users[idx];
                this.edit = true;
            },
            guardar: function(editable){
                if(this.creando){                    
                    axios.post('/users', {
                        name: editable.name,
                        email: editable.email
                    })
                    .then((response)=> {
                        this.listar();
                        this.edit = false;
                        this.creando = false;
                    });
                }else{
                    axios.post('/users/' + editable.id, {
                        name: editable.name,
                        email: editable.email,
                        limite: editable.limite
                    })
                    .then((response)=> {
                        this.listar();
                        this.edit = false;
                    });
                }
            },
            eliminar: function(id){
                axios.get('/users/destroy/'+ id)
                .then((res) => {
                    this.listar();
                })
            },
            crear: function(){
                this.creando = true;
                this.edit = true;  
                this.editable = {name:'', email:''};              
            }
        }

    }
</script>
