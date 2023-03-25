<template>
    <div class="card">
        <div class="card-body">
            <center class="mt-4">
                <img src="/assets/back/images/profile.png" class="rounded-circle" width="150">
                <h4 class="card-title mt-2">{{ cliente.nombre + ' ' + cliente.segundoNombre + ' ' + cliente.apellidoPaterno + ' ' + cliente.apellidoMaterno }}</h4>
                <h6 class="card-subtitle d-none">Accoubts Manager Amix corp</h6>
                <div class="row text-center justify-content-md-center d-none">
                    <div class="col-4">
                        <a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                            <font class="font-weight-medium">254</font>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="javascript:void(0)" class="link"><i class="icon-picture"></i>
                            <font class="font-weight-medium">54</font>
                        </a>
                    </div>
                </div>
            </center>
        </div>
        <div>
            <hr>
        </div>
        <div class="card-body">
            <small class="text-muted">Email </small>
            <h6>{{ cliente.email }}</h6>
            <small class="text-muted pt-4 db">Teléfono</small>
            <h6>{{ cliente.telefono }}</h6>

        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        props: {
            id: 0
        },
        data(){
            return{
                cliente: {
                    activo: '',
                    apellidoMaterno: '',
                    apellidoPaterno: '',
                    created_at: '',
                    email: '',
                    id: '',
                    nombre: '',
                    segundoNombre: '',
                    telefono: '',
                    updated_at: '',

                }
            }
        },
        mounted() {
            this.get_cliente()
        },
        methods: {
            get_cliente(){
                let params = {
                    id: this.id
                }
                axios.post("/api/get_cliente", params)
                .then( res => {
                    this.cliente = res.data
                })
            }
        }
    }
</script>
