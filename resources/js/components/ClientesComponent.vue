<template>
    <div>
        <div class="row mb-3">
            <div class="col-md-3">
                <button type="button"  class="btn btn-primary" @click="modalForm()">Nuevo Cliente</button>
            </div>
        </div>

        <vue-good-table :columns="columns" :rows="clientes" :search-options="{ enabled: true, placeholder: 'Buscar...' }">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'activo'">
                    <p class="text-success" v-if="props.row.activo">Activo</p>
                    <p class="text-danger" v-else>Desactivado</p>
                </span>

                <span v-else-if="props.column.field == 'opciones'">
                    <span style="cursor: pointer" class="text-info" @click="get_cliente(props.row)"><i class="fa fa-pencil"></i> Editar</span>
                    <button type="button" class="btn btn-danger" v-if="props.row.activo" @click="cambiar_status_cliente(props.row.id, 0)"><i class="fa fa-trash"></i> Desactivar</button>
                    <button type="button" class="btn btn-success" v-else @click="cambiar_status_cliente(props.row.id, 1)">Activar</button>
                    <a :href="'/detalle?id=' + props.row.id"  style="text-decoration: none;" class="text-success">
                        <span style="cursor: pointer" class="text-success"><i class="fa fa-pencil"></i> Detalle</span>
                    </a>
                </span>

                <span v-else>
                    {{props.formattedRow[props.column.field]}}
                </span>
            </template>
        </vue-good-table>

        <!-- Modal -->
        <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm">Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="save_cliente">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" v-model="cliente.nombre" id="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="segundoNombre" class="form-label">Segundo Nombre</label>
                            <input type="text" class="form-control" v-model="cliente.segundoNombre" id="segundoNombre" >
                        </div>

                        <div class="mb-3">
                            <label for="apellidoPaterno" class="form-label">Apellido Paterno*</label>
                            <input type="text" class="form-control" v-model="cliente.apellidoPaterno" id="apellidoPaterno" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" v-model="cliente.apellidoMaterno" id="apellidoMaterno" >
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono*</label>
                            <input type="text" class="form-control" v-model="cliente.telefono" id="telefono" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email*</label>
                            <input type="text" class="form-control" v-model="cliente.email" id="email" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        data(){
            return{
                clientes: [],
                cliente: {
                    id:'',
                    nombre: '',
                    segundoNombre: '',
                    apellidoPaterno: '',
                    apellidoMaterno: '',
                    telefono: '',
                    email: '',
                },
                columns: [
                    {
                        label: 'Id',
                        field: 'id',
                    },
                    {
                        label: 'Nombre',
                        field: 'nombre',
                    },
                    {
                        label: 'Segundo Nombre',
                        field: 'segundo_nombre',
                    },
                    {
                        label: 'Apellido Paterno',
                        field: 'apellidoPaterno',
                    },
                    {
                        label: 'Apellido Materno',
                        field: 'apellidoMaterno',
                    },
                    {
                        label: 'Teléfono',
                        field: 'telefono',
                    },
                    {
                        label: 'Email',
                        field: 'email',
                    },
                    {
                        label: 'Estatus',
                        field: 'activo',
                    },
                    {
                        label: 'Opciones',
                        field: 'opciones'
                    }
                    
                    
                ],
            }
        },
        mounted() {
            this.get_clientes()
        },
        methods: {
            get_clientes(){
                axios.get("api/get_clientes")
                .then( res => {
                    this.clientes = res.data
                })
            },
            modalForm(){
                $("#modalForm").modal('show')
                this.reset_cliente()
            },
            save_cliente(){

                let params = {
                    nombre: this.cliente.nombre,
                    segundoNombre: this.cliente.segundoNombre,
                    apellidoPaterno: this.cliente.apellidoPaterno,
                    apellidoMaterno: this.cliente.apellidoMaterno,
                    telefono: this.cliente.telefono,
                    email: this.cliente.email,
                    id: this.cliente.id
                }
                
                axios.post("api/save_cliente", params)
                .then( data => {
                    this.get_clientes()
                    $("#modalForm").modal('hide')

                    this.reset_cliente()
                })
            },
            get_cliente(cliente){
                this.cliente = cliente
                $("#modalForm").modal('show')
            },
            reset_cliente(){
                this.cliente = {}
            },
            cambiar_status_cliente(id, status){
                let params = {
                   id: id,
                   status: status
                }

                axios.post("api/cambiar_status_cliente", params)
                .then( res => {
                    this.get_clientes()
                })
            }
        }
    }
</script>
