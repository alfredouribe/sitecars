<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h3>Antecedentes Patológicos Heredofamilares</h3>
                <form v-on:submit.prevent="save_heredofamiliar">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="diabetes" class="form-label">Diabetes</label>
                            <select class="form-select" v-model="antecedente_patologico_heredofamiliar.diabetes" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="diabetes_familiar" class="form-label">Parentesco</label>
                            <input type="text"  v-model="antecedente_patologico_heredofamiliar.diabetes_familiar" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="hipertension" class="form-label">Hipertensión</label>
                            <select class="form-select" v-model="antecedente_patologico_heredofamiliar.hipertension" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="hipertension_familiar" class="form-label">Parentesco</label>
                            <input type="text"  v-model="antecedente_patologico_heredofamiliar.hipertension_familiar" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="cardiopatias" class="form-label">Cardiopatías</label>
                            <select class="form-select" v-model="antecedente_patologico_heredofamiliar.cardiopatias" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="cardiopatias_familiar" class="form-label">Parentesco</label>
                            <input type="text"  v-model="antecedente_patologico_heredofamiliar.cardiopatias_familiar" class="form-control">
                        </div>


                        <div class="col-md-3">
                            <label for="cancer" class="form-label">Cáncer</label>
                            <select class="form-select" v-model="antecedente_patologico_heredofamiliar.cancer" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="cancer_familiar" class="form-label">Parentesco</label>
                            <input type="text"  v-model="antecedente_patologico_heredofamiliar.cancer_familiar" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="asma" class="form-label">Asma</label>
                            <select class="form-select" v-model="antecedente_patologico_heredofamiliar.asma" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="asma_familiar" class="form-label">Parentesco</label>
                            <input type="text"  v-model="antecedente_patologico_heredofamiliar.asma_familiar" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="renal" class="form-label">Enfermadad Renal</label>
                            <select class="form-select" v-model="antecedente_patologico_heredofamiliar.renal" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="renal_familiar" class="form-label">Parentesco</label>
                            <input type="text"  v-model="antecedente_patologico_heredofamiliar.renal_familiar" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="hemofilia" class="form-label">Hemofilia</label>
                            <select class="form-select" v-model="antecedente_patologico_heredofamiliar.hemofilia" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="hemofilia_familiar" class="form-label">Parentesco</label>
                            <input type="text"  v-model="antecedente_patologico_heredofamiliar.hemofilia_familiar" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="convulsiones" class="form-label">Convulsiones</label>
                            <select class="form-select" v-model="antecedente_patologico_heredofamiliar.convulsiones" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="convulsiones_familiar" class="form-label">Parentesco</label>
                            <input type="text"  v-model="antecedente_patologico_heredofamiliar.convulsiones_familiar" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="vih" class="form-label">VIH / SIDA</label>
                            <select class="form-select" v-model="antecedente_patologico_heredofamiliar.vih" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="vih_familiar" class="form-label">Parentesco</label>
                            <input type="text"  v-model="antecedente_patologico_heredofamiliar.vih_familiar" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="anemia" class="form-label">Anemia</label>
                            <select class="form-select" v-model="antecedente_patologico_heredofamiliar.anemia" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="anemia_familiar" class="form-label">Parentesco</label>
                            <input type="text"  v-model="antecedente_patologico_heredofamiliar.anemia_familiar" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="anemia" class="form-label">Neoplasias</label>
                            <select class="form-select" v-model="antecedente_patologico_heredofamiliar.neoplasias" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="neoplasias_familiar" class="form-label">Parentesco</label>
                            <input type="text"  v-model="antecedente_patologico_heredofamiliar.neoplasias_familiar" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea v-model="antecedente_patologico_heredofamiliar.observaciones" class="form-control"></textarea>
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
            antecedente_patologico_heredofamiliar:{
                id: '',
                diabetes: '',
                diabetes_familiar: '',
                hipertension: '',
                hipertension_familiar: '',
                cardiopatias: '',
                cardiopatias_familiar: '',
                cancer: '',
                cancer_familiar: '',
                asma: '',
                asma_familiar: '',
                renal: '',
                renal_familiar: '',
                hemofilia: '',
                hemofilia_familiar: '',
                hipotension: '',
                hipotension_familiar: '',
                convulsiones: '',
                convulsiones_familiar: '',
                vih: '',
                vih_familiar: '',
                anemia: '',
                anemia_familiar: '',
                neoplasias: '',
                neoplasias_familiar: '',
                observaciones: '',
                paciente_id: '',
                user_id: '',
                created_at: '',
                updated_at: ''
            }
        }
    },
    methods: {
        get_antecedente_patologico_heredofamiliares(){
            let params = {
                idPaciente: this.id,
                idUsuario: this.idusuario
            }

            axios.post("/api/get_antecedente_patologico_heredofamiliares", params)
            .then( res => {
                this.antecedente_patologico_heredofamiliar = res.data
            })
        },
        save_heredofamiliar(){
            let params = {
                id: this.antecedente_patologico_heredofamiliar.id,
                diabetes: this.antecedente_patologico_heredofamiliar.diabetes,
                diabetes_familiar: this.antecedente_patologico_heredofamiliar.diabetes_familiar,
                hipertension: this.antecedente_patologico_heredofamiliar.hipertension,
                hipertension_familiar: this.antecedente_patologico_heredofamiliar.hipertension_familiar,
                cardiopatias: this.antecedente_patologico_heredofamiliar.cardiopatias,
                cardiopatias_familiar: this.antecedente_patologico_heredofamiliar.cardiopatias_familiar,
                cancer: this.antecedente_patologico_heredofamiliar.cancer,
                cancer_familiar: this.antecedente_patologico_heredofamiliar.cancer_familiar,
                asma: this.antecedente_patologico_heredofamiliar.asma,
                asma_familiar: this.antecedente_patologico_heredofamiliar.asma_familiar,
                renal: this.antecedente_patologico_heredofamiliar.renal,
                renal_familiar: this.antecedente_patologico_heredofamiliar.renal_familiar,
                hemofilia: this.antecedente_patologico_heredofamiliar.hemofilia,
                hemofilia_familiar: this.antecedente_patologico_heredofamiliar.hemofilia_familiar,
                hipotension: this.antecedente_patologico_heredofamiliar.hipotension,
                hipotension_familiar: this.antecedente_patologico_heredofamiliar.hipotension_familiar,
                convulsiones: this.antecedente_patologico_heredofamiliar.convulsiones,
                convulsiones_familiar: this.antecedente_patologico_heredofamiliar.convulsiones_familiar,
                vih: this.antecedente_patologico_heredofamiliar.vih,
                vih_familiar: this.antecedente_patologico_heredofamiliar.vih_familiar,
                anemia: this.antecedente_patologico_heredofamiliar.anemia,
                anemia_familiar: this.antecedente_patologico_heredofamiliar.anemia_familiar,
                neoplasias: this.antecedente_patologico_heredofamiliar.neoplasias,
                neoplasias_familiar: this.antecedente_patologico_heredofamiliar.neoplasias_familiar,
                observaciones: this.antecedente_patologico_heredofamiliar.observaciones,
            }

            axios.post("/api/save_heredofamiliar", params)
            .then( res => {
                this.get_antecedente_patologico_heredofamiliares()
            })
        }
    },
    mounted() {
        this.get_antecedente_patologico_heredofamiliares()
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