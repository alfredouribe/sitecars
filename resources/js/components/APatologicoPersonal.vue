<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h3>Antecedentes Patológicos Personales</h3>
                <form v-on:submit.prevent="save_personal">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="diabetes" class="form-label">Diabetes</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.diabetes" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="hipertension" class="form-label">Hipertensión</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.hipertension" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="hipotension" class="form-label">Hipotensión</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.hipotension" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="cardiopatias" class="form-label">Cardiopatías</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.cardiopatias" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="cancer" class="form-label">Cáncer</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.cancer" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="hemofilia" class="form-label">Hemofilia</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.hemofilia" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="hepatitis" class="form-label">Hepatitis</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.hepatitis" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="amigdalitis" class="form-label">Amigdalitis</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.amigdalitis" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="vih" class="form-label">VIH / SIDA</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.vih" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="convulsiones" class="form-label">Convulsiones</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.convulsiones" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="asma" class="form-label">Asma</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.asma" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="anemia" class="form-label">Anemia</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.anemia" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="tosferina" class="form-label">Tosferina</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.tosferina" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="artritis" class="form-label">Artritis</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.artritis" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="varicela" class="form-label">Varicela</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.varicela" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="rubeola" class="form-label">Rubeola</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.rubeola" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="sarampion" class="form-label">Sarampión</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.sarampion" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="fiebre" class="form-label">Fiebre Reumática</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.fiebre" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="tuberculosis" class="form-label">Tuberculosis</label>
                            <select class="form-select" v-model="antecedente_patologico_personal.tuberculosis" placeholder="Selecciona una opción">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea v-model="antecedente_patologico_personal.observaciones" class="form-control"></textarea>
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
            antecedente_patologico_personal:{
                id: '',
                diabetes: '',
                hipertension: '',
                hipotension: '',
                cardiopatias: '',
                cancer: '',
                hemofilia: '',
                hepatitis: '',
                amigdalitis: '',
                vih: '',
                convulsiones: '',
                asma: '',
                anemia: '',
                tosferina: '',
                artritis: '',
                varicela: '',
                rubeola: '',
                sarampion: '',
                fiebre: '',
                tuberculosis: '',
                observaciones: '',
                paciente_id: '',
                user_id: '',
                created_at: '',
                updated_at: ''
            }
        }
    },
    methods: {
        get_antecedente_patologico_personales(){
            let params = {
                idPaciente: this.id,
                idUsuario: this.idusuario
            }

            axios.post("/api/get_antecedente_patologico_personales", params)
            .then( res => {
                this.antecedente_patologico_personal = res.data
            })
        },
        save_personal(){
            let params = {
                id: this.antecedente_patologico_personal.id,
                diabetes: this.antecedente_patologico_personal.diabetes,
                hipertension: this.antecedente_patologico_personal.hipertension,
                hipotension: this.antecedente_patologico_personal.hipotension,
                cardiopatias: this.antecedente_patologico_personal.cardiopatias,
                cancer: this.antecedente_patologico_personal.cancer,
                hemofilia: this.antecedente_patologico_personal.hemofilia,
                hepatitis: this.antecedente_patologico_personal.hepatitis,
                amigdalitis: this.antecedente_patologico_personal.amigdalitis,
                vih: this.antecedente_patologico_personal.vih,
                convulsiones: this.antecedente_patologico_personal.convulsiones,
                asma: this.antecedente_patologico_personal.asma,
                anemia: this.antecedente_patologico_personal.anemia,
                tosferina: this.antecedente_patologico_personal.tosferina,
                artritis: this.antecedente_patologico_personal.artritis,
                varicela: this.antecedente_patologico_personal.varicela,
                rubeola: this.antecedente_patologico_personal.rubeola,
                sarampion: this.antecedente_patologico_personal.sarampion,
                fiebre: this.antecedente_patologico_personal.fiebre,
                tuberculosis: this.antecedente_patologico_personal.tuberculosis,
                observaciones: this.antecedente_patologico_personal.observaciones,
            }

            axios.post("/api/save_personal", params)
            .then( res => {
                this.get_antecedente_patologico_personales()
            })
        }
    },
    mounted() {
        this.get_antecedente_patologico_personales()
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