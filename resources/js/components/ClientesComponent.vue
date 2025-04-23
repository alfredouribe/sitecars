<template>
    <div>
        <div class="row mb-3">
            <div class="col-md-3">
                <button type="button"  class="btn btn-primary" @click="modalForm()">Nuevo Cliente</button>
            </div>
        </div>

        <vue-good-table
        :columns="columns"
        :rows="clientes"
        :search-options="{ enabled: true, placeholder: 'Buscar...' }"
        >
            <template slot="table-row" slot-scope="props">
                <!-- Columna: Activo -->
                <span v-if="props.column.field == 'activo'">
                    <span class="badge bg-success" v-if="props.row.activo">Activo</span>
                    <span class="badge bg-danger" v-else>Desactivado</span>
                </span>

                <!-- Columna: Suscripciones -->
                <span v-else-if="props.column.field == 'suscripciones'">
                    <span v-if="props.row.suscripciones && props.row.suscripciones.length" class="suscripciones">
                        <span
                            :class="{
                            'badge bg-success text-capitalize': props.row.suscripciones[0].estado === 'activa',
                            'badge bg-danger text-capitalize': props.row.suscripciones[0].estado !== 'activa'
                            }"
                        >
                            {{ props.row.suscripciones[0].estado }}
                        </span>

                        <small class="text-muted mt-1">
                            <i class="fa fa-calendar me-1"></i>
                            {{ formatFecha(props.row.suscripciones[0].fecha_inicio) }} - {{ formatFecha(props.row.suscripciones[0].fecha_fin) }}
                        </small>

                    </span>
                    <span v-else>
                        <span class="badge bg-danger">Sin suscripción</span>
                    </span>
                </span>

                <!-- Columna: Opciones -->
                <span v-else-if="props.column.field == 'opciones'">
                    <button type="button" class="btn btn-info" @click="get_cliente(props.row)">
                        <i class="fa fa-pencil"></i> Editar
                    </button>
                    <br><hr>
                    <button type="button" class="btn btn-danger" v-if="props.row.activo" @click="cambiar_status_cliente(props.row.id, 0)">
                        Desactivar
                    </button>
                    <button type="button" class="btn btn-success" v-else @click="cambiar_status_cliente(props.row.id, 1)">
                        Activar
                    </button>
                    <br><hr>
                    <a :href="'/detalle?id=' + props.row.id" style="text-decoration: none;" class="btn btn-success">
                        <i class="fa fa-eye"></i> Detalle
                    </a>
                </span>

                <!-- Cualquier otra columna -->
                <span v-else>
                    {{ props.formattedRow[props.column.field] }}
                </span>
            </template>
        </vue-good-table>


        <!-- Modal -->
        <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalForm" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm">Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="save_cliente" class="row">
                        <div class="mb-3 col-md-6">
                            <label for="nombre" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" v-model="cliente.nombre" maxlength="50" id="nombre" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="segundoNombre" class="form-label">Segundo Nombre</label>
                            <input type="text" class="form-control" v-model="cliente.segundoNombre" maxlength="50" id="segundoNombre" >
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="apellidoPaterno" class="form-label">Apellido Paterno*</label>
                            <input type="text" class="form-control" v-model="cliente.apellidoPaterno" maxlength="50" id="apellidoPaterno" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" v-model="cliente.apellidoMaterno" maxlength="50" id="apellidoMaterno" >
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="telefono" class="form-label">Teléfono*</label>
                            <input type="text" class="form-control" v-model="cliente.telefono" maxlength="15" id="telefono" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email*</label>
                            <input type="text" class="form-control" v-model="cliente.email" maxlength="60" id="email" required>
                        </div>

                        <div class="col-md-6 offset-md-6 text-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    data(){
        return{
            clientes: [],
            cliente: {
                id:'',
                nombre: '',
                segundoNombre: '',
                apellidoPaterno: '',
                apellidoMaterno: '',
                telefono: '',
                email: '',
            },
            columns: [
                {
                    label: 'Id',
                    field: 'id',
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
                    field: 'apellidoPaterno',
                },
                {
                    label: 'Apellido Materno',
                    field: 'apellidoMaterno',
                },
                {
                    label: 'Teléfono',
                    field: 'telefono',
                },
                {
                    label: 'Email',
                    field: 'email',
                },
                {
                    label: "Suscripción",
                    field: "suscripciones"
                },
                {
                    label: 'Estatus',
                    field: 'activo',
                },
                {
                    label: 'Opciones',
                    field: 'opciones'
                }
                
                
            ],
        }
    },
    mounted() {
        this.get_clientes()
        $.LoadingOverlay("hide");
    },
    methods: {
        get_clientes(){
            $.LoadingOverlay("show");
            axios.get("api/get_clientes")
            .then( res => {
                this.clientes = res.data.clientes
                $.LoadingOverlay("hide");
            })
        },
        modalForm(){
            $("#modalForm").modal('show')
            this.reset_cliente()
        },
        save_cliente(){
            $.LoadingOverlay("show");
            let params = {
                nombre: this.cliente.nombre,
                segundoNombre: this.cliente.segundoNombre,
                apellidoPaterno: this.cliente.apellidoPaterno,
                apellidoMaterno: this.cliente.apellidoMaterno,
                telefono: this.cliente.telefono,
                email: this.cliente.email,
                id: this.cliente.id
            }
            
            axios.post("api/save_cliente", params)
            .then( data => {
                this.get_clientes()
                $.LoadingOverlay("hide");
                $("#modalForm").modal('hide')
                this.$toast.success(data.data.message);
                this.reset_cliente()
            }).catch( error => {
                $.LoadingOverlay("hide");
                this.$toast.error("¡Error!");
            })
        },
        get_cliente(cliente){
            this.cliente = cliente
            $("#modalForm").modal('show')
        },
        reset_cliente(){
            this.cliente = {}
        },
        cambiar_status_cliente(id, status){
            let params = {
                id: id,
                status: status
            }
            let message = ''
            
            if(status){
                message = 'El cliente volverá a tener acceso al sistema'    
            } else {
                message = 'El cliente perderá todo el acceso al sistema'
            }

            Swal.fire({
                title: '¿Estás seguro?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.LoadingOverlay("show");
                    axios.post("api/cambiar_status_cliente", params)
                    .then( res => {
                        $.LoadingOverlay("hide");
                        this.$toast.success(res.data.message);
                        this.get_clientes()
                    }).catch( error => {
                        $.LoadingOverlay("hide");
                        this.$toast.error("¡Error!");
                    })
                }
            });
        },
        formatFecha(fecha) {
            if (!fecha) return 'Sin fecha';
            const date = new Date(fecha);
            const dia = String(date.getDate()).padStart(2, '0');
            const mes = String(date.getMonth() + 1).padStart(2, '0');
            const anio = date.getFullYear();
            return `${dia}/${mes}/${anio}`;
        },
    },
    beforeCreate() {
        $.LoadingOverlay("show");
    }
}
</script>

<style scoped>
.suscripciones{
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
}
</style>