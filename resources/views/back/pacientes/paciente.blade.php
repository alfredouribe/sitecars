@extends('back.app') 
@section("content") 
<h1 class="mt-4">Paciente</h1>
<ol class="breadcrumb mb-4">
	<li class="breadcrumb-item">
		<a href="/home">Inicio</a>
	</li>
	<li class="breadcrumb-item">
		<a href="/c-pacientes">Pacientes</a>
	</li>
	<li class="breadcrumb-item active">Paciente</li>
</ol>
<div class="row">
	<!-- Column -->
	<div class="col-md-2">

		<card-paciente-component id='{{ $paciente[0]->id}}' idusuario='{{Auth::user()->id}}'></card-paciente-component>
					
	</div>
	<!-- Column -->
	<!-- Column -->
	<div class="col-md-10">
		<div class="card">
			<!-- Tabs -->
			<ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" id="pills-timeline-tab" data-bs-toggle="pill" href="#info_general" role="tab" aria-controls="pills-timeline" aria-selected="true">Información General</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#antecedentes" role="tab" aria-controls="pills-profile" aria-selected="false" tabindex="-1">Antecedentes</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#odontograma" role="tab" aria-controls="pills-setting" aria-selected="false" tabindex="-1">Odontograma</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#endodoncia" role="tab" aria-controls="pills-setting" aria-selected="false" tabindex="-1">Endodoncia</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#tratamientos" role="tab" aria-controls="pills-setting" aria-selected="false" tabindex="-1">Tratamientos</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#citas" role="tab" aria-controls="pills-setting" aria-selected="false" tabindex="-1">Citas</a>
				</li>
			</ul>
			<!-- Tabs -->
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade active show" id="info_general" role="tabpanel" aria-labelledby="pills-timeline-tab">
					<paciente-general-component id='{{ $paciente[0]->id}}' idusuario='{{Auth::user()->id}}'></paciente-general-component>
				</div>
				<div class="tab-pane fade" id="antecedentes" role="tabpanel" aria-labelledby="pills-profile-tab">
					<antecedente-patologico-heredofamiliar id='{{ $paciente[0]->id}}' idusuario='{{Auth::user()->id}}'></antecedente-patologico-heredofamiliar>
					<hr>
					<antecedente-patologico-personal id='{{ $paciente[0]->id}}' idusuario='{{Auth::user()->id}}'></antecedente-patologico-personal>
					<hr>
					<antecedente-personal-no-patologico id='{{ $paciente[0]->id}}' idusuario='{{Auth::user()->id}}'></antecedente-personal-no-patologico>
				</div>
				<div class="tab-pane fade" id="endodoncia" role="tabpanel" aria-labelledby="pills-setting-tab">
					<endodoncia-component id='{{ $paciente[0]->id}}' idusuario='{{Auth::user()->id}}'></endodoncia-component>
				</div>

				<div class="tab-pane fade" id="tratamientos" role="tabpanel" aria-labelledby="pills-setting-tab">
					<tratamientos-component id='{{ $paciente[0]->id}}' idusuario='{{Auth::user()->id}}'></tratamientos-component>
				</div>

				<div class="tab-pane fade" id="citas" role="tabpanel" aria-labelledby="pills-setting-tab">
					<calendar-component id='{{ $paciente[0]->id}}' idusuario='{{Auth::user()->id}}' idcliente='{{$cliente_usuario[0]->id}}'></calendar-component>
				</div>

				<div class="tab-pane fade" id="odontograma" role="tabpanel" aria-labelledby="pills-setting-tab">
					<div class="card-body">
						<odontograma-component id='{{ $paciente[0]->id}}' idusuario='{{Auth::user()->id}}'></odontograma-component>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
</div>
@endsection