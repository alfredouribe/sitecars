<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h3>Antecedentes Personales No Patologicoss</h3>
                <form v-on:submit.prevent="save_personal_no_patologico">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="frecuencia_cepillado" class="form-label">Frecuencia de Cepillado</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.frecuencia_cepillado" placeholder="Selecciona una opción">
                                <option value="null">Nunca</option>
                                <option value="1">1 vez al día</option>
                                <option value="2">2 veces al día</option>
                                <option value="3">3 veces al día</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="hilo_dental" class="form-label">Hilo Dental</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.hilo_dental" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="medicamento" class="form-label">¿Toma Medicamento?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.medicamento" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="medicamento_descripcion" class="form-label">¿Cuáles Medicamentos?</label>
                            <textarea v-model="antecedente_personal_no_patologico.medicamento_descripcion" class="form-control"></textarea>
                        </div>

                        <div class="col-md-3">
                            <label for="tratamiento_medico" class="form-label">¿Está bajo tratamiento médico?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.tratamiento_medico" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="operacion" class="form-label">¿Lo han operado alguna vez?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.operacion" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="operacion_descripcion" class="form-label">¿Qué tipo de operación?</label>
                            <textarea v-model="antecedente_personal_no_patologico.operacion_descripcion" class="form-control"></textarea>
                        </div>

                        <div class="col-md-3">
                            <label for="transferencia_sangre" class="form-label">¿Le han hecho transfución de sangre?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.transferencia_sangre" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="consumo_drogas" class="form-label">¿Consume o ha consumido drogas?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.consumo_drogas" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="tabaquismo" class="form-label">¿Tabaquismo?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.tabaquismo" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="alcoholismo" class="form-label">¿Alcoholismo?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.alcoholismo" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="tatuajes" class="form-label">¿Tatuajes?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.tatuajes" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="embarazo" class="form-label">¿Está embarazada?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.embarazo" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="embarazo" class="form-label">Meses de embarazo</label>
                            <input type="number" min="0" max="9" class="form-control" v-model="antecedente_personal_no_patologico.embarazo_meses">
                        </div>

                        <div class="col-md-3">
                            <label for="alergias" class="form-label">¿Alergia a Medicamentos?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.alergias" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="alergias_descripcion" class="form-label">¿Cuáles?</label>
                            <textarea v-model="antecedente_personal_no_patologico.alergias_descripcion" class="form-control"></textarea>
                        </div>

                        <div class="col-md-3">
                            <label for="vacunas" class="form-label">¿Cuenta con todas sus vacunas?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.vacunas" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="vacunas_faltantes" class="form-label">¿Cuáles?</label>
                            <textarea v-model="antecedente_personal_no_patologico.vacunas_faltantes" class="form-control"></textarea>
                        </div>

                        <div class="col-md-3">
                            <label for="alergias_anestesico" class="form-label">¿Es alérgico a algún anestésico?</label>
                            <select class="form-select" v-model="antecedente_personal_no_patologico.alergias_anestesico" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
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
            antecedente_personal_no_patologico:{
                id: '',
                frecuencia_cepillado: '',
                hilo_dental: '',
                medicamento: '',
                medicamento_descripcion: '',
                tratamiento_medico: '',
                operacion: '',
                operacion_descripcion: '',
                transferencia_sangre: '',
                consumo_drogas: '',
                tabaquismo: '',
                alcoholismo: '',
                tatuajes: '',
                embarazo: '',
                embarazo_meses: '',
                alergias: '',
                alergias_descripcion: '',
                vacunas: '',
                vacunas_faltantes: '',
                alergias_anestesico: '',
                paciente_id: '',
                user_id: '',
                created_at: '',
                updated_at: ''
            }
        }
    },
    methods: {
        get_antecedente_personal_no_patologico(){
            let params = {
                idPaciente: this.id,
                idUsuario: this.idusuario
            }

            axios.post("/api/get_antecedente_personal_no_patologico", params)
            .then( res => {
                this.antecedente_personal_no_patologico = res.data
            })
        },
        save_personal_no_patologico(){
            let params = {
                id: this.antecedente_personal_no_patologico.id,
                frecuencia_cepillado: this.antecedente_personal_no_patologico.frecuencia_cepillado,
                hilo_dental: this.antecedente_personal_no_patologico.hilo_dental,
                medicamento: this.antecedente_personal_no_patologico.medicamento,
                medicamento_descripcion: this.antecedente_personal_no_patologico.medicamento_descripcion,
                tratamiento_medico: this.antecedente_personal_no_patologico.tratamiento_medico,
                operacion: this.antecedente_personal_no_patologico.operacion,
                operacion_descripcion: this.antecedente_personal_no_patologico.operacion_descripcion,
                transferencia_sangre: this.antecedente_personal_no_patologico.transferencia_sangre,
                consumo_drogas: this.antecedente_personal_no_patologico.consumo_drogas,
                tabaquismo: this.antecedente_personal_no_patologico.tabaquismo,
                alcoholismo: this.antecedente_personal_no_patologico.alcoholismo,
                tatuajes: this.antecedente_personal_no_patologico.tatuajes,
                embarazo: this.antecedente_personal_no_patologico.embarazo,
                embarazo_meses: this.antecedente_personal_no_patologico.embarazo_meses,
                alergias: this.antecedente_personal_no_patologico.alergias,
                alergias_descripcion: this.antecedente_personal_no_patologico.alergias_descripcion,
                vacunas: this.antecedente_personal_no_patologico.vacunas,
                vacunas_faltantes: this.antecedente_personal_no_patologico.vacunas_faltantes,
                alergias_anestesico: this.antecedente_personal_no_patologico.alergias_anestesico
            }

            axios.post("/api/save_personal_no_patologico", params)
            .then( res => {
                this.get_antecedente_personal_no_patologico()
            })
        }
    },
    mounted() {
        this.get_antecedente_personal_no_patologico()
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