<template>
    <div style="margin-top: 24px">
        <div class="row mb-3">
            <div class="col-md-12">
                <button type="button"  class="btn btn-primary" @click="modalForm()">Nuevo Usuario</button>
            </div>
        </div>

        <vue-good-table :columns="columns" :rows="usuarios" :search-options="{ enabled: true, placeholder: 'Buscar...'  }">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'activo'">
                    <p class="text-success" v-if="props.row.activo">Activo</p>
                    <p class="text-danger" v-else>Desactivado</p>
                </span>

                <span v-else-if="props.column.field == 'opciones'">
                    <button type="button" class="btn btn-danger" v-if="props.row.activo" @click="cambia_status_usuario_cliente(props.row.id, 0)"><i class="fa fa-trash"></i> Desactivar</button>
                    <button type="button" class="btn btn-success" v-else @click="cambia_status_usuario_cliente(props.row.id, 1)">Activar</button>
                </span>

                <span v-else>
                    {{props.formattedRow[props.column.field]}}
                </span>
            </template>
        </vue-good-table>


        <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm">Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="save_usuario_cliente">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" v-model="usuario.nombres" maxlength="191" id="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email*</label>
                            <input type="text" class="form-control" v-model="usuario.email" maxlength="191" id="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" class="form-control" v-model="usuario.password" maxlength="191" id="password" required>
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
        props: {
            id: 0,
            idusuario: 0
        },
        data(){
            return{
                usuarios: [],
                usuario: {
                    id: '',
                    nombres: '',
                    email: '',
                    password: '',
                    idCliente: '',
                    idUsuario: '',
                    activo: '',
                    created_at: '',
                    updated_at: ''
                },
                columns: [
                    {
                        label: 'Id',
                        field: 'id',
                    },
                    {
                        label: 'Nombre',
                        field: 'name',
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
            this.get_usuarios_cliente()
        },
        methods: {
            get_usuarios_cliente(){
                let params = {
                    id: this.id
                }
                axios.post("/api/get_usuarios_cliente", params)
                .then( res => {
                    this.usuarios = res.data
                })
            },
            save_usuario_cliente(){
                let params = {
                    nombres: this.usuario.nombres,
                    email: this.usuario.email,
                    password: this.usuario.password,
                    idCliente: this.id,
                    idUsuario: this.idusuario
                }

                axios.post("/api/save_usuario_cliente", params)
                .then( res => {
                    this.get_usuarios_cliente()
                    $("#modalForm").modal('hide')
                })
            },
            modalForm(){
                $("#modalForm").modal('show')
            },
            cambia_status_usuario_cliente(id, status){
                const params = {
                    "id":id,
                    "status": status
                }

                axios.post("/api/cambia_status_usuario_cliente", params)
                .then( res => {
                    this.get_usuarios_cliente()
                })
            }
        }
    }
</script>


<style scoped>

</style>