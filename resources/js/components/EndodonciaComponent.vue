<template>
    <div style="margin-top: 24px">
        <div class="row mb-3">
            <div class="col-md-12">
                <button type="button"  class="btn btn-primary" @click="modalFormEndodoncia()">Nueva Endodoncia</button>
            </div>
        </div>

        <vue-good-table :columns="columns" :rows="endodoncias" :search-options="{ enabled: true, placeholder: 'Buscar...'  }">
            <template slot="table-row" slot-scope="props">

                

                <span v-if="props.column.field == 'opciones'">
                    <button type="button" class="btn btn-danger"  @click="eliminar_endodoncia(props.row.id)">Eliminar</button>
                </span>

                <span v-else>
                    {{props.formattedRow[props.column.field]}}
                </span>
            </template>
        </vue-good-table>


        <div class="modal fade" id="modalEndodoncia" tabindex="-1" aria-labelledby="modalForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm">Nuevo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="save_endodoncia">
                        <div class="mb-3">
                            <label for="conducto" class="form-label">Conducto*</label>
                            <select class="form-select" v-model="endodoncia.conducto" id="conducto" required>
                                <option value="" selected disabled>Seleccionar</option>
                                <option value="Palatino">Palatino</option>
                                <option value="Vestibular">Vestibular</option>
                                <option value="Mesio-vestibular">Mesio-vestibular</option>
                                <option value="Mesio-Lingual">Mesio-Lingual</option>
                                <option value="Distal">Distal</option>
                                <option value="Unico">Unico</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="mm" class="form-label">mm*</label>
                            <input type="text" class="form-control" v-model="endodoncia.mm" id="mm" required maxlength="50">
                        </div>

                        <div class="mb-3">
                            <label for="referencia" class="form-label">Referencia*</label>
                            <input type="text" class="form-control" v-model="endodoncia.referencia" id="referencia" required maxlength="100">
                        </div>

                        <div class="mb-3">
                            <label for="fo" class="form-label">F-O*</label>
                            <input type="text" class="form-control" v-model="endodoncia.fo" id="fo" required maxlength="100">
                        </div>

                        <div class="mb-3">
                            <label for="gates" class="form-label">Gates*</label>
                            <input type="text" class="form-control" v-model="endodoncia.gates" id="gates" required maxlength="100">
                        </div>

                        <div class="mb-3">
                            <label for="retroceso" class="form-label">Retroceso*</label>
                            <input type="text" class="form-control" v-model="endodoncia.retroceso" id="retroceso" required maxlength="100">
                        </div>

                        <div class="mb-3">
                            <label for="lima_maestra" class="form-label">Lima Maestra*</label>
                            <input type="text" class="form-control" v-model="endodoncia.lima_maestra" id="lima_maestra" required maxlength="100">
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
        components: {
        },
        data(){
            return{
                endodoncia:{
                    id: '',
                    conducto: '',
                    mm: '',
                    referencia: '',
                    fo: '',
                    gates: '',
                    retroceso: '',
                    lima_maestra: ''
                },
                columns: [
                    {
                        label: 'Id',
                        field: 'id',
                    },
                    {
                        label: 'Conducto',
                        field: 'conducto',
                    },
                    {
                        label: 'mm',
                        field: 'mm',
                    },
                    {
                        label: 'Referencia',
                        field: 'referencia',
                    },
                    {
                        label: 'F.O.',
                        field: 'fo',
                    },
                    {
                        label: 'Gates',
                        field: 'gates',
                    },
                    {
                        label: 'Retroceso',
                        field: 'retroceso',
                    },
                    {
                        label: 'Lima Maestra',
                        field: 'lima_maestra',
                    },
                    {
                        label: 'Opciones',
                        field: 'opciones'
                    }
                ],
                endodoncias: [],
                option:{
                    penColor:"rgb(0, 0, 0)",
                    backgroundColor:"rgb(255,255,255)"
                },
            }
        },
        mounted() {
            this.get_endodoncias()
        },
        methods: {
            get_endodoncias(){
                let params = {
                    id: this.id
                }
                axios.post("/api/get_endodoncias", params)
                .then( res => {
                    this.endodoncias = res.data
                })
            },
            save_endodoncia(){
                let params = {
                    conducto: this.endodoncia.conducto,
                    mm: this.endodoncia.mm,
                    referencia: this.endodoncia.referencia,
                    fo: this.endodoncia.fo,
                    gates: this.endodoncia.gates,
                    retroceso: this.endodoncia.retroceso,
                    lima_maestra: this.endodoncia.lima_maestra,
                    idPaciente: this.id,
                    idUsuario: this.idusuario
                }

                axios.post("/api/save_endodoncia", params)
                .then( res => {
                    this.get_endodoncias()
                    $("#modalEndodoncia").modal('hide')
                    this.endodoncia = {}
                })
            },
            modalFormEndodoncia(){
                $("#modalEndodoncia").modal('show')
            },
            eliminar_endodoncia(id){
                let params = {
                    id: id
                }

                axios.post("/api/eliminar_endodoncia", params)
                .then( res => {
                    this.get_endodoncias()
                })
            }
        },
        filters: {


        },
    }

</script>

<style scoped>

</style>