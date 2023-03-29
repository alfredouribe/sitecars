<template>
    <div>
        <div class="card-body">
            <button class="btn btn-info" @click="modalForm()"><i class="fa fa-pencil"></i> Editar</button>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-3 fw-bold">
                    Dirección
                </div>
                <div class="col-md-3">
                    {{ paciente_dato_general.direccion }}
                </div>

                <div class="col-md-3 fw-bold">
                    Ocupación
                </div>
                <div class="col-md-3">
                    {{ paciente_dato_general.ocupacion }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 fw-bold">
                    Escolaridad
                </div>
                <div class="col-md-3">
                    {{ paciente_dato_general.escolaridad }}
                </div>

                <div class="col-md-3 fw-bold">
                    Estado Civil
                </div>
                <div class="col-md-3">
                    {{ paciente_dato_general.estado_civil }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 fw-bold">
                    Lugar de Nacimiento
                </div>
                <div class="col-md-3">
                    {{ paciente_dato_general.lugar_nacimiento }}
                </div>

                <div class="col-md-3 fw-bold">
                    Religión
                </div>
                <div class="col-md-3">
                    {{ paciente_dato_general.religion }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 fw-bold">
                    Tutor
                </div>
                <div class="col-md-3">
                    {{ paciente_dato_general.tutor }}
                </div>

                <div class="col-md-3 fw-bold">
                    Motivo de Consulta
                </div>
                <div class="col-md-3">
                    {{ paciente_dato_general.motivo_consulta }}
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalFormInfo" tabindex="-1" aria-labelledby="modalForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm">Información Personal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="save_info_general_paciente">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Dirección*</label>
                            <textarea type="text" class="form-control" v-model="paciente_dato_general.direccion" maxlength="500" id="direccion" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Ocupación*</label>
                            <input type="text" class="form-control" v-model="paciente_dato_general.ocupacion" maxlength="100" id="ocupacion" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Escolaridad*</label>
                            <input type="text" class="form-control" v-model="paciente_dato_general.escolaridad" maxlength="150" id="escolaridad" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Estado Civil*</label>
                            <input type="text" class="form-control" v-model="paciente_dato_general.estado_civil" maxlength="100" id="estado_civil" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Lugar de Nacimiento*</label>
                            <input type="text" class="form-control" v-model="paciente_dato_general.lugar_nacimiento" maxlength="150" id="lugar_nacimiento" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Religión*</label>
                            <input type="text" class="form-control" v-model="paciente_dato_general.religion" id="religion" maxlength="150" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Tutor</label>
                            <input type="text" class="form-control" v-model="paciente_dato_general.tutor" id="tutor" maxlength="100">
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Motivo de Consulta*</label>
                            <textarea type="text" class="form-control" v-model="paciente_dato_general.motivo_consulta" id="motivo_consulta" maxlength="500" required></textarea>
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

import axios from 'axios'

export default {
    components: {

    },
    props: {
        id: 0,
        idusuario: 0,
    },
    data: function () {
        return {
            paciente_dato_general:{
                id: '',
                direccion: '',
                ocupacion: '',
                escolaridad: '',
                estado_civil: '',
                lugar_nacimiento: '',
                religion: '',
                tutor: '',
                motivo_consulta: '',
                paciente_id: '',
                user_id: '',
                created_at: '',
                updated_at: ''
            }
        }
    },
    methods: {
        get_paciente_info_general(){
            let params = {
                idPaciente: this.id,
                idUsuario: this.idusuario
            }

            axios.post("/api/get_paciente_info_general", params)
            .then( res => {
                this.paciente_dato_general = res.data
            })
        },
        modalForm(){
            $("#modalFormInfo").modal('show')
        },
        save_info_general_paciente(){
            let params = {
                id: this.paciente_dato_general.id,
                direccion: this.paciente_dato_general.direccion,
                ocupacion: this.paciente_dato_general.ocupacion,
                escolaridad: this.paciente_dato_general.escolaridad,
                estado_civil: this.paciente_dato_general.estado_civil,
                lugar_nacimiento: this.paciente_dato_general.lugar_nacimiento,
                religion: this.paciente_dato_general.religion,
                tutor: this.paciente_dato_general.tutor ? this.paciente_dato_general.tutor : '',
                motivo_consulta: this.paciente_dato_general.motivo_consulta,
            }

            axios.post("/api/save_info_general_paciente", params)
            .then(res => {
                $("#modalFormInfo").modal('hide')
            })
        }
    },
    mounted() {
        this.get_paciente_info_general()
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
.row{
    padding-top: 20px;
    padding-bottom: 20px;
}
</style>