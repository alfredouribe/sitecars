<template>
    <div>
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