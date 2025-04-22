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
                    <button type="button" class="btn btn-info" @click="get_cliente(props.row)"><i class="fa fa-pencil"></i> Editar</button><br><hr>
                    <button type="button" class="btn btn-danger" v-if="props.row.activo" @click="cambiar_status_cliente(props.row.id, 0)">Desactivar</button>
                    <button type="button" class="btn btn-success" v-else @click="cambiar_status_cliente(props.row.id, 1)">Activar</button>
                    <br><hr>
                    <a :href="'/detalle?id=' + props.row.id"  style="text-decoration: none;" class="btn btn-success">
                        <i class="fa fa-eye"></i> Detalle
                    </a>
                </span>

                <span v-else>
                    {{props.formattedRow[props.column.field]}}
                </span>
            </template>
        </vue-good-table>

        <!-- Modal -->
        <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalForm" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm">Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="save_cliente" class="row">
                        <div class="mb-3 col-md-6">
                            <label for="nombre" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" v-model="cliente.nombre" maxlength="50" id="nombre" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="segundoNombre" class="form-label">Segundo Nombre</label>
                            <input type="text" class="form-control" v-model="cliente.segundoNombre" maxlength="50" id="segundoNombre" >
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="apellidoPaterno" class="form-label">Apellido Paterno*</label>
                            <input type="text" class="form-control" v-model="cliente.apellidoPaterno" maxlength="50" id="apellidoPaterno" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" v-model="cliente.apellidoMaterno" maxlength="50" id="apellidoMaterno" >
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="telefono" class="form-label">Teléfono*</label>
                            <input type="text" class="form-control" v-model="cliente.telefono" maxlength="15" id="telefono" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email*</label>
                            <input type="text" class="form-control" v-model="cliente.email" maxlength="60" id="email" required>
                        </div>

                        <div class="col-md-6 offset-md-6 text-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

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
            $.LoadingOverlay("show");
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
                $.LoadingOverlay("hide");
                $("#modalForm").modal('hide')
                this.$toast.success(data.data.message);
                this.reset_cliente()
            }).catch( error => {
                $.LoadingOverlay("hide");
                this.$toast.error("¡Error!");
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
            let message = ''
            
            if(status){
                message = 'El cliente volverá a tener acceso al sistema'    
            } else {
                message = 'El cliente perderá todo el acceso al sistema'
            }

            Swal.fire({
                title: '¿Estás seguro?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.LoadingOverlay("show");
                    axios.post("api/cambiar_status_cliente", params)
                    .then( res => {
                        $.LoadingOverlay("hide");
                        this.$toast.success(res.data.message);
                        this.get_clientes()
                    }).catch( error => {
                        $.LoadingOverlay("hide");
                        this.$toast.error("¡Error!");
                    })
                }
            });

            
        }
    }
}
</script>
