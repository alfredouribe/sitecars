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

                <span v-else-if="props.column.field == 'firma'">
                    <img :src="props.row.firma" style="max-width: 100%;">
                </span>

                <span v-else-if="props.column.field == 'opciones'">
                    <button type="button" class="btn btn-success" v-if="props.row.firma === ''" @click="modalFirma(props.row.id)">Firmar</button>
                </span>

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

                        <!-- <div class="mb-3">
                            <label for="firma" class="form-label">Firma*</label>
                            <input type="text" maxlength="100" class="form-control" v-model="tratamiento.firma" id="firma" required>
                        </div> -->

                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalFirma" tabindex="-1" aria-labelledby="modalForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalForm">Firmar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="contenedor">

                            <div class="row">
                                <div class="col-md-12 text-center" >
                                    <canvas id="draw-canvas" width="300px" height="300px" style="border: 1px solid red;">
                                        No tienes un buen navegador.
                                    </canvas>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="button" class="button btn btn-success" id="draw-submitBtn" @click="guarda_firma()" value="Aceptar">
                                    <input type="button" class="button btn btn-warning" id="draw-clearBtn" value="Borrar">

                                    <div style="display: none">
                                        <label>Color</label>
                                        <input type="color" id="color">
                                        <label>Tamaño Puntero</label>
                                        <input type="range" id="puntero" min="1" default="1" max="5" width="10%">
                                    </div>


                                </div>

                            </div>

                            <br/>
                            <div class="row" style="display: none">
                                <div class="col-md-12">
                                    <textarea id="draw-dataUrl" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <br/>
                            <div class="contenedor" style="display: none">
                                <div class="col-md-12">
                                    <img id="draw-image" src="" alt="Tu Imagen aparecera Aqui!"/>
                                </div>
                            </div>
                        </div>
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
                    {
                        label: 'Opciones',
                        field: 'opciones'
                    }
                    
                    
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
                },
                option:{
                    penColor:"rgb(0, 0, 0)",
                    backgroundColor:"rgb(255,255,255)"
                },
                disabled:false,
                dataUrl:"https://avatars2.githubusercontent.com/u/17644818?s=460&v=4",
                id_tratamiento:''
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
            },
            modalFirma(id){
                $("#modalFirma").modal('show')
                this.id_tratamiento = id
            },
            guarda_firma(){
                $.LoadingOverlay("show");
                setTimeout(() => {
                    let drawText = document.getElementById("draw-dataUrl"); // Obtener el elemento textarea por su ID
                    let drawDataUrlValue = drawText.value; // Obtener el valor del textarea
                    let params = {
                        "firma": drawDataUrlValue,
                        "id_tratamiento": this.id_tratamiento,
                        "algo": "algo",
                        "id":2
                    }

                    axios.post("/api/actualiza_firma", params)
                    .then( res => {
                        $.LoadingOverlay("hide");
                        // $("#modalFirma").modal('hide')
                        this.id_tratamiento = ''
                        // this.get_tratamientos()
                        window.location.reload()
                    })

                },3000)
            },
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
                fecha.setDate(fecha.getDate() + 1); // suma un día a la fecha
                const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
                return fecha.toLocaleDateString('es-ES', opciones)
            }
        },
    }


    setTimeout(function() {




(function() { // Comenzamos una funcion auto-ejecutable

    // Obtenenemos un intervalo regular(Tiempo) en la pamtalla
    window.requestAnimFrame = (function(callback) {
        return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimaitonFrame ||
            function(callback) {
                window.setTimeout(callback, 1000 / 60);
                // Retrasa la ejecucion de la funcion para mejorar la experiencia
            };
    })();

    // Traemos el canvas mediante el id del elemento html
    var canvas = document.getElementById("draw-canvas");

    if(canvas){
        var ctx = canvas.getContext("2d");
    
    
        // Mandamos llamar a los Elemetos interactivos de la Interfaz HTML
        var drawText = document.getElementById("draw-dataUrl");
        var drawImage = document.getElementById("draw-image");
        var clearBtn = document.getElementById("draw-clearBtn");
        var submitBtn = document.getElementById("draw-submitBtn");
        clearBtn.addEventListener("click", function(e) {
            // Definimos que pasa cuando el boton draw-clearBtn es pulsado
            clearCanvas();
            drawImage.setAttribute("src", "");
        }, false);
        // Definimos que pasa cuando el boton draw-submitBtn es pulsado
        submitBtn.addEventListener("click", function(e) {
            var dataUrl = canvas.toDataURL();
            drawText.innerHTML = dataUrl;
            drawImage.setAttribute("src", dataUrl);
        }, false);

        // Activamos MouseEvent para nuestra pagina
        var drawing = false;
        var mousePos = {
            x: 0,
            y: 0
        };
        var lastPos = mousePos;
        canvas.addEventListener("mousedown", function(e) {
            /*
            Mas alla de solo llamar a una funcion, usamos function (e){...}
            para mas versatilidad cuando ocurre un evento
            */
            var tint = document.getElementById("color");
            var punta = document.getElementById("puntero");
            console.log(e);
            drawing = true;
            lastPos = getMousePos(canvas, e);
        }, false);
        canvas.addEventListener("mouseup", function(e) {
            drawing = false;
        }, false);
        canvas.addEventListener("mousemove", function(e) {
            mousePos = getMousePos(canvas, e);
        }, false);

        // Activamos touchEvent para nuestra pagina
        canvas.addEventListener("touchstart", function(e) {
            mousePos = getTouchPos(canvas, e);
            console.log(mousePos);
            e.preventDefault(); // Prevent scrolling when touching the canvas
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);
        canvas.addEventListener("touchend", function(e) {
            e.preventDefault(); // Prevent scrolling when touching the canvas
            var mouseEvent = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(mouseEvent);
        }, false);
        canvas.addEventListener("touchleave", function(e) {
            // Realiza el mismo proceso que touchend en caso de que el dedo se deslice fuera del canvas
            e.preventDefault(); // Prevent scrolling when touching the canvas
            var mouseEvent = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(mouseEvent);
        }, false);
        canvas.addEventListener("touchmove", function(e) {
            e.preventDefault(); // Prevent scrolling when touching the canvas
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);
    }
    // Get the position of the mouse relative to the canvas
    function getMousePos(canvasDom, mouseEvent) {
        var rect = canvasDom.getBoundingClientRect();
        /*
          Devuelve el tamaño de un elemento y su posición relativa respecto
          a la ventana de visualización (viewport).
        */
        return {
            x: mouseEvent.clientX - rect.left,
            y: mouseEvent.clientY - rect.top
        };
    }

    // Get the position of a touch relative to the canvas
    function getTouchPos(canvasDom, touchEvent) {
        var rect = canvasDom.getBoundingClientRect();
        console.log(touchEvent);
        /*
          Devuelve el tamaño de un elemento y su posición relativa respecto
          a la ventana de visualización (viewport).
        */
        return {
            x: touchEvent.touches[0].clientX - rect.left, // Popiedad de todo evento Touch
            y: touchEvent.touches[0].clientY - rect.top
        };
    }

    // Draw to the canvas
    function renderCanvas() {
        if (drawing) {
            var tint = document.getElementById("color");
            var punta = document.getElementById("puntero");
            ctx.strokeStyle = tint.value;
            ctx.beginPath();
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(mousePos.x, mousePos.y);
            console.log(punta.value);
            ctx.lineWidth = punta.value;
            ctx.stroke();
            ctx.closePath();
            lastPos = mousePos;
        }
    }

    function clearCanvas() {
        canvas.width = canvas.width;
    }

    // Allow for animation
    (function drawLoop() {
        requestAnimFrame(drawLoop);
        renderCanvas();
    })();

})();




}, 3000);

</script>

<style scoped>

</style>