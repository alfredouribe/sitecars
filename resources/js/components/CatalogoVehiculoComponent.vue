<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                catalogoVehiculos: []
            }
        },
        mounted() {

        },
        created(){

        },
        methods:{
            obtieneCatalogoVehiculos(){
                axios.get('/catalogo-vehiculos')
                .then(res => {
                    this.catalogoVehiculos = res.data;
                })
            }
                    
        }
    }
</script>
