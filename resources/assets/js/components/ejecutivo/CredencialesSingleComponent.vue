<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    {{tipo.titulo}}
                </div>
                <div class="col-md-8">
                    <input type="text" 
                    class="form-control" 
                    :placeholder="tipo.titulo" 
                    v-model="value"
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
            tipo: Object
        },
        data(){
            return {
                value: ''
            }
        },
        methods: {
            guardar: function(){
                
            }
        },
        computed: {
        },
        computed: {
        }
    }
</script>
