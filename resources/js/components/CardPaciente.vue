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
                    <small>{{ paciente.created_at | formatearFecha }}</small>
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
        }
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