<template>
    <div>
        <div class="card">
            <div class="card-body">
                <center class="mt-4">
                    <div v-if="cargaArchivo">
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="handleDropzoneSuccess"></vue-dropzone>
                        <a style="cursor: pointer; text-decoration: underline" @click="mostrarDrop(false)">Cancelar</a>
                    </div>
                    <div v-else>
                        <img :src="paciente.foto ? 'images/pacientes/' + paciente.foto : 'images/' + imagen_paciente" class="rounded-circle" width="150"><br>
                        <a style="cursor: pointer; text-decoration: underline" @click="mostrarDrop(true)">Cambiar Foto</a>
                    </div>

                    <h4 class="card-title mt-2">{{ paciente.nombre + ' ' + paciente.segundo_nombre + ' ' + paciente.paterno + ' ' + paciente.materno }}</h4>
                    <p>Fecha de Alta</p>
                    <small>{{ paciente.created_at | formatearFecha }}</small><br>
                    <button class="btn btn-info" @click="modalPaciente()"><i class="fa fa-pencil"></i> Editar</button>
                </center>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">

                <small class="text-muted">Email </small>
                <h6>{{ paciente.email }}</h6>

                <small class="text-muted">Teléfono </small>
                <h6>{{ paciente.telefono }}</h6>

                <small class="text-muted">Sexo </small>
                <h6>{{ paciente.sexo}}</h6>

                <small class="text-muted">Fecha de Nacimiento </small>
                <h6>{{ paciente.fecha_nacimiento }}</h6>

                <small class="text-muted">Edad </small>
                <h6>{{ paciente.fecha_nacimiento | calcularEdad }}</h6>

            </div>
        </div>

        <!-- Modal -->
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

import axios from 'axios'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    components: {
        vueDropzone: vue2Dropzone
    },
    props: {
        id: 0,
        idusuario: 0,
    },
    data: function () {
        return {
            dropzoneOptions: {
                url: '/carga-imagen-paciente?id='+this.id,
                headers: {
                    "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                },

            },
            cargaArchivo: false,
            imagen_paciente: 'user-profile.png',
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
        }
    },
    methods: {
        mostrarDrop(status) {
            this.cargaArchivo = status
        },
        get_info_paciente(){
            let params = {
                "id": this.id
            }

            axios.post("/api/get_info_paciente", params)
            .then( res => {
                this.paciente = res.data
            })
        },
        handleDropzoneSuccess(ile, response){
            this.paciente.foto = response.foto
            this.cargaArchivo = false
        },
        modalPaciente(){
            $("#modalForm").modal('show')
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
                sexo: this.paciente.sexo,
                id: this.paciente.id
            }

            axios.post("/api/update_paciente", params)
            .then( res => {
                //window.location.reload()
                $("#modalForm").modal('hide')
            })
        },
    },
    mounted() {
        this.get_info_paciente()
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