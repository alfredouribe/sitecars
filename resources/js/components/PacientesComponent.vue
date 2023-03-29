<template>
    <div style="margin-top: 24px">
        <div class="row mb-3">
            <div class="col-md-12">
                <button type="button"  class="btn btn-primary" @click="modalForm()">Nuevo Paciente</button>
            </div>
        </div>

        <vue-good-table :columns="columns" :rows="pacientes" :search-options="{ enabled: true, placeholder: 'Buscar...', compactMode }">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'foto'">
                    <span v-if="props.row.foto == ''">Sin foto</span>
                    <img v-else :src="'/images/pacientes/' + props.row.foto" width="100px">
                </span>

                

                <span v-else-if="props.column.field == 'opciones'">
                    <a :href="'paciente?id=' + props.row.id" type="button" class="btn btn-outline-primary"><i class="fa fa-eye"></i>Revisar</a>
                </span>

                <span v-if="props.column.field == 'sexo'">
                    <span v-if="props.row.sexo == 'M'">Masculino</span>
                    <span v-if="props.row.sexo == 'F'">Femenino</span>
                    <span v-if="props.row.sexo == 'O'">Otro</span>
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
                    <h5 class="modal-title" id="modalForm">Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="save_paciente" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" v-model="paciente.nombre" maxlength="30" id="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="snombre" class="form-label">Segundo Nombre</label>
                            <input type="text" class="form-control" v-model="paciente.segundo_nombre" maxlength="30" id="snombre">
                        </div>

                        <div class="mb-3">
                            <label for="paterno" class="form-label">Paterno*</label>
                            <input type="text" class="form-control" v-model="paciente.paterno" maxlength="30" id="paterno" required>
                        </div>

                        <div class="mb-3">
                            <label for="materno" class="form-label">Materno</label>
                            <input type="text" class="form-control" v-model="paciente.materno" maxlength="30" id="materno">
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono*</label>
                            <input type="text" class="form-control" v-model="paciente.telefono" maxlength="10" id="telefono" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email*</label>
                            <input type="text" class="form-control" v-model="paciente.email" maxlength="50" id="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Sexo*</label>
                            <select class="form-control" v-model="paciente.sexo" required>
                                <option selected disabled>Selecciona una opción</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                                <option value="O">Otro</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha de Nacimiento*</label>
                            <input type="date" class="form-control" v-model="paciente.fecha_nacimiento" id="fecha" required>
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
        components: {
            
        },
        props: {
            id: 0,
            idusuario: 0
        },
        data(){
            return{
                pacientes: [],
                paciente: {
                    id: '',
                    nombre: '',
                    segundo_nombre: '',
                    paterno: '',
                    materno: '',
                    telefono: '',
                    email: '',
                    fecha_nacimiento: '',
                    foto: '',
                    cliente_id: '',
                    user_id: '',
                    created_at: '',
                    updated_at: ''
                },
                columns: [
                    {
                        label: 'Id',
                        field: 'id',
                    },
                    {
                        label: 'Foto',
                        field: 'foto',
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
                        field: 'paterno',
                    },
                    {
                        label: 'Apellido Materno',
                        field: 'materno',
                    },
                    // {
                    //     label: 'Sexo',
                    //     field: 'sexo',
                    // },
                    // {
                    //     label: 'Fecha de Nacimiento',
                    //     field: 'fecha_nacimiento',
                    //     type: 'date',
                    //     dateInputFormat: 'yyyy-MM-dd',
                    //     dateOutputFormat: 'dd-MM-yyyy',
                    // },
                    {
                        label: 'Teléfono',
                        field: 'telefono',
                    },
                    {
                        label: 'Email',
                        field: 'email',
                    },
                    {
                        label: 'Opciones',
                        field: 'opciones'
                    }
                    
                    
                ],
            }
        },
        mounted() {
            this.get_pacientes()
        },
        methods: {
            get_pacientes(){
                let params = {
                    id: this.id
                }
                axios.post("/api/get_pacientes", params)
                .then( res => {
                    this.pacientes = res.data
                })
            },
            save_paciente(){
                let params = {
                    nombre: this.paciente.nombre,
                    segundo_nombre: this.paciente.segundo_nombre,
                    paterno: this.paciente.paterno,
                    materno: this.paciente.materno,
                    telefono: this.paciente.telefono,
                    email: this.paciente.email,
                    fecha_nacimiento: this.paciente.fecha_nacimiento,
                    cliente_id: this.id,
                    user_id: this.idusuario,
                    sexo: this.paciente.sexo

                }

                axios.post("/api/save_paciente", params)
                .then( res => {
                    //window.location.reload()
                    this.get_pacientes()
                    $("#modalForm").modal('hide')
                    this.paciente = {}
                })
            },
            modalForm(){
                $("#modalForm").modal('show')
            },
        }
    }
</script>


<style scoped>

</style>