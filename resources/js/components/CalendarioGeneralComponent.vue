<template>
	<div class="section">
	  	
		<div class="row">
			<div class="col-md-12">
				<v-calendar
					class="custom-calendar max-w-full"
					:masks="masks"
					:attributes="attributes"
					disable-page-swipe
					is-expanded
				>
					<template v-slot:day-content="{ day, attributes }">
						<div class="flex flex-col h-full z-10 overflow-hidden">
							<span class="day-label text-sm text-gray-900">{{ day.day }}</span>
							<div class="flex-grow overflow-y-auto overflow-x-auto">
							<p
								v-for="attr in attributes"
								:key="attr.key"
								class="text-xs leading-tight rounded-sm p-1 mt-0 mb-1"
								:class="attr.customData.class"

								style="cursor: pointer"
								@click="modalForm(attr.customData.id, attr.customData.fecha, attr.customData.motivo, attr.customData.estatus)"
							>
								{{ attr.customData.title }}
                                <br>
                                {{ attr.customData.nombre_completo }}
							</p>
							</div>
						</div>
					</template>
				</v-calendar>
			</div>
		</div>

		<div class="modal fade" id="modalCalendar" tabindex="-1" aria-labelledby="modalForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm">Editar Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="actualiza_cita" id="form_citas">

						<div class="mb-3">
							<label for="motivo" class="form-label">Motivo</label>
							<input type="text" class="form-control" id="motivo" aria-describedby="motivo" v-model="motivo" maxlength="50" required>
						</div>

						<div class="mb-3">
							<label for="cita" class="form-label">Fecha y Hora</label>
							<input type="datetime-local" step="60" class="form-control" id="cita" aria-describedby="cita" v-model="fecha_cita">
						</div>

						<div class="mb-3">
							<label class="form-label"></label>
							<select class="select-control" v-model="estatus">
								<option value="" selected>Seleccionar</option>
								<option value="GENERADA" :selected="estatus == 'GENERADA' ? 'selected': ''">GENERADA</option>
								<option value="CONCRETADA" :selected="estatus == 'CONCRETADA' ? 'selected': ''">CONCRETADA</option>
								<option value="CANCELADA" :selected="estatus == 'CANCELADA' ? 'selected': ''">CANCELADA</option>
								<option value="POSPUESTA" :selected="estatus == 'POSPUESTA' ? 'selected': ''">POSPUESTA</option>
							</select>
						</div>

						<input type="hidden" v-model="idCita">

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
	data() {
	  const month = new Date().getMonth();
	  const year = new Date().getFullYear();
	  return {
		fecha_cita: '',
		motivo: '',
		idCita: '',
		estatus: '',
		masks: {
		  weekdays: 'WWW',
		},
		attributes: [
		  {
			key: 1,
			customData: {
			  title: '10:00 am Ajuste Brackets',
			  class: 'bg-primary',
			},
			dates: [new Date(year, month, 2)],
		  },
		],
	  };
	},
	methods: {
		consulta_citas_general(){
			let params = {
				cliente_id: this.id
			}

			axios.post("/api/consulta_citas_general", params)
			.then( res => {
				this.attributes = res.data
			})
		},
		modalForm(id, fecha, motivo, estatus){
			this.fecha_cita = fecha
			this.motivo = motivo
			this.idCita = id
			this.estatus = estatus
			$("#modalCalendar").modal('show')
		},
		actualiza_cita(){
			let params = {
				motivo: this.motivo,
				fecha: this.fecha_cita,
				id: this.idCita,
				estatus: this.estatus
			}

			axios.post("/api/actualiza_cita", params)
			.then( res => {
				this.consulta_citas_general()
				this.motivo = ''
				this.fecha_cita = ''
				this.idCita = ''
				this.estatus = ''
				$("#modalCalendar").modal('hide')
			})
		},
	},
	mounted(){
		this.consulta_citas_general()
	},
	filters: {
		
	}
  };
  </script>

<style scoped>
	::-webkit-scrollbar {
	width: 0px;
	}
	::-webkit-scrollbar-track {
	display: none;
	}
	/deep/ .custom-calendar.vc-container {
	--day-border: 1px solid #ffffff;
	--day-border-highlight: 1px solid #b8c2cc;
	--day-width: 90px;
	--day-height: 90px;
	--weekday-bg: #f8fafc;
	--weekday-border: 1px solid #3154b4;
	border-radius: 0;
	width: 100%;
	& .vc-header {
		background-color: #f1f5f8;
		padding: 10px 0;
	}
	& .vc-weeks {
		padding: 0;
	}
	& .vc-weekday {
		background-color: var(--weekday-bg);
		border-bottom: var(--weekday-border);
		border-top: var(--weekday-border);
		padding: 5px 0;
	}
	& .vc-day {
		overflow:auto;
		color: #000;
		padding: 0 5px 3px 5px;
		text-align: left;
		height: var(--day-height);
		min-width: var(--day-width);
		background-color: white;
		font-size: 10px;
		border: 1px solid rgba(209, 209, 209, 0.5);
		&.weekday-1,
		&.weekday-7 {
			/* background-color: rgb(113, 113, 113); */
		}
		&:not(.on-bottom) {
		border-bottom: var(--day-border);
		&.weekday-1 {
			border-bottom: var(--day-border-highlight);
		}
		}
		&:not(.on-right) {
		border-right: var(--day-border);
		}
	}
	& .vc-day-dots {
		margin-bottom: 5px;
	}
	}
</style>

<style scoped>

	.leading-tight{
		border-radius: 2px;
	}
</style>
