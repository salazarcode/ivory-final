<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    {{tipoCredencial.titulo}}
                </div>
                <div class="col-md-8">
                    <input type="text" 
                    class="form-control" 
                    :placeholder="tipoCredencial.titulo" 
                    v-model="credencial.valor"
                    @blur="guardar"
                >
                </div>
            </div>
        </div>
        <br>
    </div>
</template>

<script>
    export default {
        name: "credenciales-single",
        props: {
            servicio: Object,
            tipoCredencial: Object
        },
        data(){
            return {
                credencial: {valor: ''},
                rutas: {
                    retrieve: "/credenciales/",
                    guardar: '/credenciales'
                }
            }
        },
        methods: {
            guardar: function(){     
                if(this.credencial.hasOwnProperty("id"))
                {
                    axios.post(this.rutas.guardar, {
                        id: this.credencial.id,
                        valor: this.credencial.valor
                    })
                    .then((res)=> {
                        this.credencial = res.data
                    });
                }
                else
                {
                    axios.post(this.rutas.guardar, {
                        servicio_id: this.servicio.id,
                        credencialtipo_id: this.tipoCredencial.id,
                        valor: this.credencial.valor
                    })
                    .then((res)=> {
                        this.credencial = res.data
                    });
                    
                }
            }
        },
        created(){
            axios.get(this.rutas.retrieve + this.servicio.id + '/' + this.tipoCredencial.id)
            .then((res) => {
                this.credencial = res.data
            })
        }
    }
</script>
