@extends('adminlte::page')

@section('title', 'Info. Niño')

@section('title_table', 'Info. Niño')

@section('content')
    <form>
        {!! csrf_field() !!}
        <div class="card card-danger" >
            <div class="card-header">
                <!--<div class="card-header" style="background-color: #ff0000ed;">-->
                <h3 class="card-title">
                    <i class="fas fa-ellipsis-v"></i>&nbsp;
                    Información Niño
                    @if(auth()->user()->role_id == '1')
                    <span class="users-list-date text-light">
                        @if($patient->created_at == $patient->updated_at)
                            Creado por
                        @else
                            Modificado por
                        @endif
                        {{ current_infoUser($patient->created_by)->name }} {{ current_infoUser($patient->created_by)->last_name }}
                    </span>
                    @endif
                </h3>
                <div class="card-tools">
                    @if (current_person()->role != 'Voluntario')
                        @if (!$patient->end_treatment)
                            <!--if($event->user_id==auth()->id() || current_person()->role == "Administrador")-->
                            <button type="button" class="btn btn-tool" title="Editar">
                                <a href="{{ URL::current() }}/edit" type="button" class="btn btn-tool bg-gradient-danger btn-sm"><i
                                        class="far fa-edit"></i> &nbsp;Editar</a>
                            </button>
                        @endif
                        @if (!$patient->end_treatment)
                            <button type="button" class="btn btn-tool bg-gradient-danger btn-sm">
                                <a type="button" data-toggle="modal" data-target="#modal-fin">
                                    <i class="far fa-trash-alt"></i>
                                    &nbsp; Fin Tratamiento
                                </a>
                            </button>
                        @else
                            <button type="button" class="btn btn-tool bg-red btn-sm">
                                <a type="button" data-toggle="modal" data-target="#modal-rein">
                                    <i class="fas fa-user-check"></i>
                                    &nbsp; Iniciar Tratamiento
                                </a>
                            </button>
                        @endif
                        <!--endif-->
                    @endif
                    <button type="button" class="btn btn-tool">
                        <a href="{{ $url_anterior }}" class="btn btn-tool bg-gradient-red btn-sm"><i
                                class="fas fa-times"></i>
                        </a>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <!-- /.col (left) -->
                        <div class="card card-red card-outline">
                            <div class="card-body p-2">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="user-img img-fluid" @if ($patient->file) src="{!!  asset($patient->file) !!}"
                      @else
                                        src="vendor/adminlte/dist/img/unnamed.png" @endif
                                            alt="User profile picture">
                                    </div>
                                </div>
                                @if ($patient->end_treatment)
                                    <div class="description-block border-right mb-0 bg-teal">
                                        <span class="description-percentage ">Fin Tratamiento:</span>
                                        <h5 class="description-header ">
                                            {{ \Carbon\Carbon::parse($patient->end_treatment)->format('d/m/Y') }}
                                        </h5>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="text-warning text-xl">
                                        <i class="ion ion-ios-cart-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">

                                        <span class="text-muted">
                                            Talles:
                                        </span>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-baby"></i>
                                            </span>
                                        </div>
                                        <input title="Pañal" type="text" class="form-control float-right" id="reservation"
                                            placeholder="Marca y Talle Pañal" value="{{ $patient->diaper_size }}"
                                            disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-tshirt"></i></span>
                                        </div>
                                        <input title="Indumentaria Superior" type="text" class="form-control float-right"
                                            id="reservationtime" placeholder="Talle Ind. Superior"
                                            value="{{ $patient->upper_indumetary_size }}" disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-archway"></i>
                                            </span>
                                        </div>
                                        <input title="Indumentaria Inferior" type="text" class="form-control float-right"
                                            id="reservation" placeholder="Talle Ind. Inferior"
                                            value="{{ $patient->alower_indumetary_size }}" disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-socks"></i></span>
                                        </div>
                                        <input title="Calzado" type="text" class="form-control float-right"
                                            id="reservationtime" placeholder="Nº Calzado"
                                            value="{{ $patient->shoe_size }}" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <!-- /.col Izquierda -->
                        <div class="card card-red card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            ID:
                                            <input type="number" class="form-control" placeholder="ID" title="ID"
                                                value="{{ $patient->id }}" disabled="">
                                        </div>
                                        <div class="col-sm-4">
                                            Nombres:
                                            <input type="text" class="form-control" placeholder="Nombres" title="Nombres"
                                                value="{{ $patient->name }}" disabled="">
                                        </div>
                                        <div class="col-sm-4">
                                            Apellidos:
                                            <input type="text" class="form-control" placeholder="Apellidos"
                                                title="Apellidos" value="{{ $patient->last_name }}" disabled="">
                                        </div>
                                        <div class="col-sm-2">
                                            Apodo:
                                            <input type="text" class="form-control" placeholder="Apodo" title="Apodo"
                                                value="{{ $patient->nick_name }}" disabled="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            DNI:
                                            <input type="text" class="form-control" placeholder="DNI" title="DNI"
                                                value="{{ $patient->DNI }}" disabled="">
                                        </div>
                                        <div class="col-sm-4">
                                            Fecha de Nacimiento:
                                            <div class="input-group">
                                                <input title="Fecha de Nacimiento" alig="center" type="date"
                                                    class="form-control" style="text-align:center;" placeholder="01-01-2020"
                                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                                    data-mask="" im-insert="true" value="{{ $patient->date_of_birth }}"
                                                    disabled="">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            Sexo:
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-restroom"></i>
                                                    </span>
                                                </div>
                                                <select title="Sexo" class="form-control" disabled="">
                                                    <option value="M" @if ($patient->sex == 'M') selected @endif>Masculino</option>
                                                    <option value="F" @if ($patient->sex == 'F') selected @endif>Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            Grupo (RH):
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn-xs">
                                                        <i class="fas fa-tint"></i>
                                                    </span>
                                                </div>
                                                <select name="tblood" title="Grupo Sanguíneo (RH)" class="form-control" disabled="">
                                                    @foreach (current_tbloods() as $tblood)
                                                        <option value="{{ $tblood->id }}" @if ($tblood->id == $patient->tblood_id) selected @endif>
                                                            {{ $tblood->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            Dirección:
                                            <input type="text" class="form-control" placeholder="Dirección"
                                                title="Dirección" value="{{ $patient->address }}" disabled="">
                                        </div>
                                        <div class="col-sm-3">
                                            Localidad:
                                            <input type="text" class="form-control" placeholder="Localidad"
                                                title="Localidad" value="{{ $patient->city }}" disabled="">
                                        </div>
                                        <div class="col-sm-3">
                                            Provincia:
                                            <input type="text" class="form-control" placeholder="Provincia"
                                                title="Provincia" value="{{ $patient->province }}" disabled="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                Inicio Tratamiento
                                                <div class="input-group">
                                                    <input title="Inicio Tratamiento" align="center" type="date"
                                                        class="form-control" style="text-align:center;"
                                                        placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                        im-insert="true" value="{{ $patient->start_treatment }}"
                                                        disabled="">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            Diagnóstico:
                                            <div class="input-group">
                                                <input name="diagnosis" type="text" class="form-control" placeholder="Diagnóstico"
                                                title="Nombres" required value="{{ $patient->diagnosis }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-2">
                                            Internado
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn-xs">
                                                        <i class="fas fa-bed"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control" disabled="">
                                                    <option value="0" @if ($patient->internship == '0') selected @endif>No</option>
                                                    <option value="1" @if ($patient->internship == '1') selected @endif>Si</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            Información:
                                            <textarea class="form-control" rows="6"
                                                placeholder="Ingrese toda la información relevante"
                                                disabled="">{{ $patient->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- /.col Izquierda -->
                        <div class="card card-olive card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Información Familiar</h3>
                                <div class="card-tools">
                                    <span class="direct-chat-timestamp float">
                                        {{ $total }} resultados
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card card card-outline">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%"></th>
                                                    <th width="10%">Familiar</th>
                                                    <th width="5%">Cuidador</th>
                                                    <th width="40%">Información</th>
                                                    <th width="30%">Contacto</th>
                                                    <th width="10%" title="Grupo Sanguíneo (RH)"><i class="fas fa-tint"></i>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($families as $family)
                                                    <tr>
                                                        <td class="py-3 align-middle">

                                                            <img src="{!!  asset($family->file) !!}" class="direct-chat-img"
                                                                alt="message user image">

                                                        </td>
                                                        <td class="py-3 align-middle">{{ $family->relationship_name }}</td>
                                                        <td class="py-3 align-middle">
                                                            @if ($family->keeper == '1')
                                                                Si
                                                            @else
                                                                No
                                                            @endif
                                                        </td>
                                                        <td class="py-3 align-middle">
                                                            <strong>DNI:&nbsp;</strong>
                                                            {{ $family->DNI }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Nac.:&nbsp;</strong>
                                                            {{ \Carbon\Carbon::parse($family->date_of_birth)->format('d/m/Y') }}
                                                            <br>
                                                            <strong>Nombre:&nbsp; </strong> {{ $family->name }}
                                                            {{ $family->last_name }}
                                                            <br>
                                                            <strong>Dirección:&nbsp;</strong> {{ $family->address }},
                                                            {{ $family->city }}, {{ $family->province }}
                                                        </td>
                                                        <td class="py-3 align-middle">
                                                            <strong>Celular 1:&nbsp;</strong> {{ $family->mobile1 }}
                                                            <br>
                                                            <strong>Celular 2:&nbsp;</strong>
                                                            @if ($family->mobile2)
                                                                {{ $family->mobile2 }}
                                                            @else()
                                                                &#126;
                                                            @endif()
                                                            <br>
                                                            <strong>Teléfono:&nbsp;</strong> {{ $family->phone }}
                                                        </td>
                                                        <td class="py-3 align-middle">{{ $family->tblood_name }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">{{ $families->render() }}</div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10">

                    </div>
                    <div class="col-sm-1" align="right">
                        <!--<button type="submint" class="btn btn-block btn-outline-success btn-sm" " title="Exportar Excel" data-widget="" name="exportar" value="xls">
                              <i class="far fa-file-excel"></i> Excel
                            </button>-->
                    </div>
                    <div class="col-sm-1" alig="right">
                        <button type="submint" class="btn btn-block btn-outline-danger btn-sm" title="Exportar PDF"
                            data-card-widget="" name="exportar" value="pdf" formtarget="_blank">
                            <i class="far fa-file-pdf"></i> Pdf
                        </button>
                    </div>
                </div>

            </div>
    </form>
    <form method="POST" action="/datos/ninio/{{ $patient->id }}/fin">
        {!! csrf_field() !!}
        <!-- /.modal -->
        <div class="modal fade" id="modal-fin">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            &nbsp;Fin Tratamiento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p><strong>{{ $patient->name }} {{ $patient->last_name }}</strong>, DNI:
                                    <strong>{{ $patient->DNI }}</strong>, finalizó su tratamiento el día
                                    <input name="end_treatment" alig="center" type="date" class="form-control"
                                        style="text-align:center;" placeholder="01-01-2020" data-inputmask-alias="datetime"
                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true" value="" @if (!$patient->end_treatment) required @endif>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn  btn-default btn-sm" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button name="guardar" type="submit" class="btn  btn-info btn-sm" value="0">
                            <i class="fas fa-check"></i>
                             Guardar
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
        <!-- /.modal -->
        <!-- /.modal reiorporar -->
        <div class="modal fade" id="modal-rein">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title">
                            <i class="fas fa-check-circle"></i>
                            &nbsp;Inicio Tratamiento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p><strong>{{ $patient->name }} {{ $patient->last_name }}</strong>, DNI:
                                    <strong>{{ $patient->DNI }}</strong>, inició su Tratamiento al el día
                                    <input name="start_treatment" alig="center" type="date" class="form-control"
                                    style="text-align:center;" placeholder="01-01-2020" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true"
                                    value="{{ now()->format('Y-m-d') }}">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn  btn-default btn-sm" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button name="guardar" type="submit" class="btn  btn-info btn-sm" value="1">
                            <i class="fas fa-check"></i>
                            Guardar
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>
@stop
@section('js')
    <script type="text/javascript">
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            $('.swalDefaultSuccess').ready(function() {
                if (@json(Session::get('message')) == 'Cambio') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Cambio de Estado Exitoso.' // pasa el mensaje a Json
                    })
            });

            $('.swalDefaultSuccess').ready(function() {
                if (@json(Session::get('message')) == 'Modificado') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Datos Modificados con Exito.' // pasa el mensaje a Json
                    })
            });

            $('.swalDefaultWarning').click(function() {
                Toast.fire({
                    type: 'warning',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });

        });

    </script>
@stop
