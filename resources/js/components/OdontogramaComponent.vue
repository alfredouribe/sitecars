<template>
    <div style="margin-top: 24px">
        <div class="row mb-3">
            <div class="col-md-3">
                <form v-on:submit.prevent="guarda_odontograma">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error</strong> {{ msg }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="mb-3">
                        <label for="cuadrante" class="form-label">Cuadrante</label>
                        <input type="number" min="0" step="1" max="8" class="form-control" id="cuadrante" aria-describedby="cuadrante" v-model="odontograma.cuadrante" required>
                    </div>

                    <div class="mb-3">
                        <label for="diente" class="form-label">No. Diente</label>
                        <input type="number" min="0" step="1" max="8" class="form-control" id="diente" aria-describedby="diente" v-model="odontograma.diente">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            <div class="col-md-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Restauración</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Negro</td>
                            <td>Extracción</td>
                        </tr>
                        <tr>
                            <td>Azul</td>
                            <td>Amalgama</td>
                        </tr>
                        <tr>
                            <td>Amarillo</td>
                            <td>Resina</td>
                        </tr>
                        <tr>
                            <td>Naranja</td>
                            <td>Ionometro de Vidrio</td>
                        </tr>
                        <tr>
                            <td>Verde</td>
                            <td>Sellador de Fosetas</td>
                        </tr>
                        <tr>
                            <td>Café</td>
                            <td>Curación Temporal</td>
                        </tr>
                        <tr>
                            <td>Rojo</td>
                            <td>Caries</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row" style="margin-bottom:10px" v-for="(odontograma, index_1) in odontogramas" :key="index_1">
            <div class="col-md-2 text-center" v-for="(item, index) in odontograma" :key="index">
                <div class="row" style="float:left!important">
                    <p>{{ item.cuadrante + '' + item.diente }}</p>
                    
                    <div class="col-md-12 border">
                        <select class="form-control" :style="'background-color:' + item.codigo_1" @change="cambia_color(item.id, 1, $event.target.value)">
                            <option value="NULL">_____</option>
                            <option value="black" :selected="item.codigo_1 == 'black' ? 'true': ''" style="background-color: black; color: white">Negro</option>
                            <option value="blue" :selected="item.codigo_1 == 'blue' ? 'true': ''" style="background-color: blue;">Azul</option>
                            <option value="yellow" :selected="item.codigo_1 == 'yellow' ? 'true': ''" style="background-color: yellow;">Amarillo</option>
                            <option value="orange" :selected="item.codigo_1 == 'orange' ? 'true': ''" style="background-color: orange;">Naranja</option>
                            <option value="green" :selected="item.codigo_1 == 'green' ? 'true': ''" style="background-color: green;">Verde</option>
                            <option value="brown" :selected="item.codigo_1 == 'brown' ? 'true': ''" style="background-color: brown;">Café</option>
                            <option value="red" :selected="item.codigo_1 == 'red' ? 'true': ''" style="background-color: red;">Rojo</option>
                        </select>
                    </div>
                    <div class="col-md-4 border">
                        <select class="form-control" :style="'background-color:' + item.codigo_2" @change="cambia_color(item.id, 2, $event.target.value)">
                            <option value="NULL">_____</option>
                            <option value="black" :selected="item.codigo_2 == 'black' ? 'true': ''" style="background-color: black; color: white">Negro</option>
                            <option value="blue" :selected="item.codigo_2 == 'blue' ? 'true': ''" style="background-color: blue;">Azul</option>
                            <option value="yellow" :selected="item.codigo_2 == 'yellow' ? 'true': ''" style="background-color: yellow;">Amarillo</option>
                            <option value="orange" :selected="item.codigo_2 == 'orange' ? 'true': ''" style="background-color: orange;">Naranja</option>
                            <option value="green" :selected="item.codigo_2 == 'green' ? 'true': ''" style="background-color: green;">Verde</option>
                            <option value="brown" :selected="item.codigo_2 == 'brown' ? 'true': ''" style="background-color: brown;">Café</option>
                            <option value="red" :selected="item.codigo_2 == 'red' ? 'true': ''" style="background-color: red;">Rojo</option>
                        </select>
                    </div>
                    <div class="col-md-4 border">
                        <select class="form-control" :style="'background-color:' + item.codigo_3" @change="cambia_color(item.id, 3, $event.target.value)">
                            <option value="NULL">_____</option>
                            <option value="black" :selected="item.codigo_3 == 'black' ? 'true': ''" style="background-color: black; color: white">Negro</option>
                            <option value="blue" :selected="item.codigo_3 == 'blue' ? 'true': ''" style="background-color: blue;">Azul</option>
                            <option value="yellow" :selected="item.codigo_3 == 'yellow' ? 'true': ''" style="background-color: yellow;">Amarillo</option>
                            <option value="orange" :selected="item.codigo_3 == 'orange' ? 'true': ''" style="background-color: orange;">Naranja</option>
                            <option value="green" :selected="item.codigo_3 == 'green' ? 'true': ''" style="background-color: green;">Verde</option>
                            <option value="brown" :selected="item.codigo_3 == 'brown' ? 'true': ''" style="background-color: brown;">Café</option>
                            <option value="red" :selected="item.codigo_3 == 'red' ? 'true': ''" style="background-color: red;">Rojo</option>
                        </select>
                    </div>
                    <div class="col-md-4 border">
                        <select class="form-control" :style="'background-color:' + item.codigo_4" @change="cambia_color(item.id, 4, $event.target.value)">
                            <option value="NULL">_____</option>
                            <option value="black" :selected="item.codigo_4 == 'black' ? 'true': ''" style="background-color: black; color: white">Negro</option>
                            <option value="blue" :selected="item.codigo_4 == 'blue' ? 'true': ''" style="background-color: blue;">Azul</option>
                            <option value="yellow" :selected="item.codigo_4 == 'yellow' ? 'true': ''" style="background-color: yellow;">Amarillo</option>
                            <option value="orange" :selected="item.codigo_4 == 'orange' ? 'true': ''" style="background-color: orange;">Naranja</option>
                            <option value="green" :selected="item.codigo_4 == 'green' ? 'true': ''" style="background-color: green;">Verde</option>
                            <option value="brown" :selected="item.codigo_4 == 'brown' ? 'true': ''" style="background-color: brown;">Café</option>
                            <option value="red" :selected="item.codigo_4 == 'red' ? 'true': ''" style="background-color: red;">Rojo</option>
                        </select>
                    </div>
                    <div class="col-md-12 border" >
                        <select class="form-control" :style="'background-color:' + item.codigo_5" @change="cambia_color(item.id, 5, $event.target.value)">
                            <option value="NULL">_____</option>
                            <option value="black" :selected="item.codigo_5 == 'black' ? 'true': ''" style="background-color: black; color: white">Negro</option>
                            <option value="blue" :selected="item.codigo_5 == 'blue' ? 'true': ''" style="background-color: blue;">Azul</option>
                            <option value="yellow" :selected="item.codigo_5 == 'yellow' ? 'true': ''" style="background-color: yellow;">Amarillo</option>
                            <option value="orange" :selected="item.codigo_5 == 'orange' ? 'true': ''" style="background-color: orange;">Naranja</option>
                            <option value="green" :selected="item.codigo_5 == 'green' ? 'true': ''" style="background-color: green;">Verde</option>
                            <option value="brown" :selected="item.codigo_5 == 'brown' ? 'true': ''" style="background-color: brown;">Café</option>
                            <option value="red" :selected="item.codigo_5 == 'red' ? 'true': ''" style="background-color: red;">Rojo</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
        </div>

    </div>
</template>

<script>
import axios from 'axios';

    export default {
        components: {
            
        },
        props: {
            id: 0,
            idusuario: 0
        },
        data(){
            return{
                odontograma: {
                    id: '',
                    cuadrante: '',
                    diente: '',
                    codigo_1: '',
                    codigo_2: '',
                    codigo_3: '',
                    codigo_4: '',
                },
                msg: '',
                odontogramas: []
            }
        },
        mounted() {
            this.get_odontograma()
            $(".alert-danger").toggle()
        },
        methods: {
            get_odontograma(){
                let params = {
                    paciente_id: this.id
                }
                axios.post("/api/get_odontograma", params)
                .then( res => {
                    this.odontogramas = res.data
                })
            },
            guarda_odontograma(){
                let params = {
                    cuadrante: this.odontograma.cuadrante,
                    diente: this.odontograma.diente,
                    paciente_id: this.id,
                    user_id: this.idusuario
                }

                axios.post("/api/guarda_odontograma", params)
                .then( res => {
                    if(res.data.status == "error"){
                        this.msg = res.data.msg
                        $(".alert-danger").toggle()
                    }else{
                        window.location.reload()
                        this.get_odontograma()
                    }
                    this.odontograma = {}
                })
            },
            cambia_color(id, num, valor){
                let params = {
                    id: id,
                    num: num,
                    color: valor
                }

                axios.post("/api/cambia_color", params)
                .then( res =>{
                    this.get_odontograma()
                })
            }
        }
    }
</script>


<style scoped>

</style>