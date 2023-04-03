<template>
    <div style="margin-top: 24px">
        <div class="row mb-3">
            <div class="col-md-12">
                <button type="button"  class="btn btn-primary" @click="modalFormTratamiento()">Nuevo Tratamiento / Abono</button>
            </div>
        </div>

        <vue-good-table :columns="columns" :rows="tratamientos" :search-options="{ enabled: true, placeholder: 'Buscar...'  }">
            <template slot="table-row" slot-scope="props">

                <span v-if="props.column.field == 'fecha'">
                    <p>{{ props.row.fecha | formatearFecha }}</p>
                </span>

                <!-- <span v-else-if="props.column.field == 'opciones'">
                    <button type="button" class="btn btn-danger" v-if="props.row.activo" @click="cambia_status_usuario_cliente(props.row.id, 0)"><i class="fa fa-trash"></i> Desactivar</button>
                    <button type="button" class="btn btn-success" v-else @click="cambia_status_usuario_cliente(props.row.id, 1)">Activar</button>
                </span> -->

                <span v-else>
                    {{props.formattedRow[props.column.field]}}
                </span>
            </template>
        </vue-good-table>


        <div class="modal fade" id="modalTratamiento" tabindex="-1" aria-labelledby="modalForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm">Nuevo Tratamiento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="save_tratamiento">
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha*</label>
                            <input type="date" class="form-control" v-model="tratamiento.fecha" id="fecha" required>
                        </div>

                        <div class="mb-3">
                            <label for="tratamiento" class="form-label">Tratamiento*</label>
                            <textarea maxlength="500" class="form-control" v-model="tratamiento.tratamiento" id="tratamiento" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="costo" class="form-label">Costo*</label>
                            <input type="number" min="0" step="0.01" class="form-control" v-model="tratamiento.costo" id="costo" required>
                        </div>

                        <div class="mb-3">
                            <label for="abono" class="form-label">Abono*</label>
                            <input type="number" min="0" step="0.01" class="form-control" v-model="tratamiento.abono" id="abono" required>
                        </div>

                        <div class="mb-3">
                            <label for="pago" class="form-label">Pago*</label>
                            <input type="number" min="0" step="0.01" class="form-control" v-model="tratamiento.pago" id="pago" required>
                        </div>

                        <div class="mb-3">
                            <label for="firma" class="form-label">Firma*</label>
                            <input type="text" maxlength="100" class="form-control" v-model="tratamiento.firma" id="firma" required>
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
                        label: 'Fecha',
                        field: 'fecha',
                    },
                    {
                        label: 'Tratamiento',
                        field: 'tratamiento',
                    },
                    {
                        label: 'Costo',
                        field: 'costo',
                    },
                    {
                        label: 'Abono',
                        field: 'abono',
                    },
                    {
                        label: 'Pago',
                        field: 'pago',
                    },
                    {
                        label: 'Firma',
                        field: 'firma',
                    },
                    {
                        label: 'Registra',
                        field: 'name',
                    },
                    // {
                    //     label: 'Opciones',
                    //     field: 'opciones'
                    // }
                    
                    
                ],
                tratamientos: [],
                tratamiento: {
                    id: '',
                    fecha: '',
                    tratamiento: '',
                    costo: '',
                    abono: '',
                    pago: '',
                    firma: '',
                    paciente_id: '',
                    user_id: '',
                    created_at: '',
                    updated_at: ''
                }
            }
        },
        mounted() {
            this.get_tratamientos()
        },
        methods: {
            get_tratamientos(){
                let params = {
                    id: this.id
                }
                axios.post("/api/get_tratamientos", params)
                .then( res => {
                    this.tratamientos = res.data
                })
            },
            save_tratamiento(){
                let params = {
                    fecha: this.tratamiento.fecha,
                    tratamiento: this.tratamiento.tratamiento,
                    costo: this.tratamiento.costo,
                    abono: this.tratamiento.abono,
                    pago: this.tratamiento.pago,
                    firma: this.tratamiento.firma,
                    idPaciente: this.id,
                    idUsuario: this.idusuario
                }

                axios.post("/api/save_tratamiento", params)
                .then( res => {
                    this.get_tratamientos()
                    $("#modalTratamiento").modal('hide')
                })
            },
            modalFormTratamiento(){
                $("#modalTratamiento").modal('show')
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
        },
        filters: {
            calcularEdad: function (fechaNacimiento) {
                let edad = new Date().getFullYear() - new Date(fechaNacimiento).getFullYear();
                let diferenciaMeses = new Date().getMonth() - new Date(fechaNacimiento).getMonth();
                if (diferenciaMeses < 0 || (diferenciaMeses === 0 && new Date().getDate() < new Date(fechaNacimiento).getDate())) {
                    edad--;
                }
                return edad;
            },
            formatearFecha(fechaOriginal) {
                const fecha = new Date(fechaOriginal)
                const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
                return fecha.toLocaleDateString('es-ES', opciones)
            }
        }
    }
</script>


<style scoped>

</style>