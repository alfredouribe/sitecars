@extends('back.app')

@section("content")
<h1 class="mt-4">Detalle de cliente</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/clientes">Clientes</a></li>
    <li class="breadcrumb-item active">Detalle</li>
</ol>



<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <cliente-card-component id="{{$id}}"></cliente-card-component>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Tabs -->
            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-timeline-tab" data-bs-toggle="pill" href="#usuarios"
                        role="tab" aria-controls="pills-timeline" aria-selected="true">Usuarios</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#last-month" role="tab"
                        aria-controls="pills-profile" aria-selected="false" tabindex="-1">Pacientes</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#previous-month" role="tab"
                        aria-controls="pills-setting" aria-selected="false" tabindex="-1">Configuración</a>
                </li>
            </ul>
            <!-- Tabs -->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="usuarios" role="tabpanel"
                    aria-labelledby="pills-timeline-tab">
                    <usuarios-cliente-component id="{{$id}}" idusuario="{{Auth::user()->id}}"></usuarios-cliente-component>
                </div>
                <div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <pacientes-component id="{{$id}}}" idusuario="{{Auth::user()->id}}"></pacientes-component>
                </div>
                <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                    <div class="card-body">
                        <form class="form-horizontal form-material">
                            <div class="mb-3">
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Johnathan Doe"
                                        class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="johnathan@admin.com"
                                        class="form-control form-control-line" name="example-email" id="example-email">
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
                                    <input type="text" placeholder="123 456 7890"
                                        class="form-control form-control-line">
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
                                    <button class="btn btn-success">
                                        Update Profile
                                    </button>
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