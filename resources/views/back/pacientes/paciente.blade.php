@extends('back.app') 
@section("content") 
<h1 class="mt-4">Paciente</h1>
<ol class="breadcrumb mb-4">
	<li class="breadcrumb-item">
		<a href="/index">Inicio</a>
	</li>
	<li class="breadcrumb-item">
		<a href="/c-pacientes">Pacientes</a>
	</li>
	<li class="breadcrumb-item active">Paciente</li>
</ol>
<div class="row">
	<!-- Column -->
	<div class="col-lg-4 col-xlg-3 col-md-5">

		<card-paciente-component id='{{ $paciente[0]->id}}' idusuario='{{Auth::user()->id}}'></card-paciente-component>
					
	</div>
	<!-- Column -->
	<!-- Column -->
	<div class="col-lg-8 col-xlg-9 col-md-7">
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
					<a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false" tabindex="-1">Odontograma</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false" tabindex="-1">Endodoncia</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false" tabindex="-1">Tratamientos</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false" tabindex="-1">Citas</a>
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
				<div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
					<div class="card-body">
						<form class="form-horizontal form-material">
							<div class="mb-3">
								<label class="col-md-12">Full Name</label>
								<div class="col-md-12">
									<input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
								</div>
							</div>
							<div class="mb-3">
								<label for="example-email" class="col-md-12">Email</label>
								<div class="col-md-12">
									<input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
								</div>
							</div>
							<div class="mb-3">
								<label class="col-md-12">Password</label>
								<div class="col-md-12">
									<input type="password" value="password" class="form-control form-control-line">
								</div>
							</div>
							<div class="mb-3">
								<label class="col-md-12">Phone No</label>
								<div class="col-md-12">
									<input type="text" placeholder="123 456 7890" class="form-control form-control-line">
								</div>
							</div>
							<div class="mb-3">
								<label class="col-md-12">Message</label>
								<div class="col-md-12">
									<textarea rows="5" class="form-control form-control-line"></textarea>
								</div>
							</div>
							<div class="mb-3">
								<label class="col-sm-12">Select Country</label>
								<div class="col-sm-12">
									<select class="form-select form-control-line">
										<option>London</option>
										<option>India</option>
										<option>Usa</option>
										<option>Canada</option>
										<option>Thailand</option>
									</select>
								</div>
							</div>
							<div class="mb-3">
								<div class="col-sm-12">
									<button class="btn btn-success"> Update Profile </button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Column -->
</div>
@endsection