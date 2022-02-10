@extends('adminlte::page')

@section('title', 'Info. Voluntario')

@section('title_table', 'Info. Voluntario')

@section('content')
    <form>
        {!! csrf_field() !!}
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-ellipsis-v"></i>&nbsp;
                    Información Voluntario
                    @if(auth()->user()->role_id == '1')
                    <span class="users-list-date text-light">
                        @if($voluntary->created_at == $voluntary->updated_at)
                            Creado por
                        @else
                            Modificado por
                        @endif
                        {{ current_infoUser($voluntary->created_by)->name }} {{ current_infoUser($voluntary->created_by)->last_name }} el
                        {{ \Carbon\Carbon::parse($voluntary->updated_at)->format('d/m/Y H:i') }} hs.
                    </span>
                    @endif
                </h3>
                <div class="card-tools">
                    @if( auth()->user()->role_id != 3)
                        @if( auth()->user()->role_id == 1 && $voluntary->role_id >= 1 || auth()->user()->role_id == 2 && $voluntary->role_id > 2 )
                            @if (!$voluntary->end_activitiest)
                                <button type="button" class="btn btn-tool" title="Editar">
                                    <a href="/usuario/{{ $voluntary->id }}/editar" type="button"
                                        class="btn btn-tool bg-gradient-info btn-sm">
                                        <i class="far fa-edit"></i>
                                        &nbsp; Editar</a>
                                </button>
                            @endif
                            @if (!$voluntary->end_activitiest)
                                <button type="button" class="btn btn-tool bg-gradient-info btn-sm">
                                    <a type="button" data-toggle="modal" data-target="#modal-fin">
                                        <i class="far fa-trash-alt"></i>
                                        &nbsp;Fin voluntariado
                                    </a>
                                </button>
                            @else
                                <button type="button" class="btn btn-tool bg-gradient-info btn-sm">
                                    <a type="button" data-toggle="modal" data-target="#modal-rein">
                                        <i class="fas fa-trash-restore"></i>
                                        &nbsp; Reincorporar
                                    </a>
                                </button>
                            @endif
                        @endif
                        <!--endif-->
                    @endif
                    <button type="button" class="btn btn-tool">
                        <a href="{{ $url_anterior }}" class="btn btn-tool bg-gradient-info btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <!-- /.col (left) -->
                        <div class="card card-info card-outline">
                            <div class="card-body p-2">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="user-img img-fluid"  src="{!! asset($voluntary->file) !!}"  alt="User profile picture">
                                    </div>
                                </div>
                            </div>
                            @if ($voluntary->end_activitiest)
                                <div class="description-block p-2 bg-teal ">
                                    <span class="description-percentage ">
                                        Fin Voluntariado:
                                        </span>
                                        <h5 class="description-header ">
                                            {{ \Carbon\Carbon::parse($voluntary->end_activitiest)->format('d/m/Y') }}
                                        </h5>
                                    </div>
                                @endif
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <br>
                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="text-warning text-xl">
                                        <i class="ion ion-ios-cart-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            Inicio Voluntariado:
                                        </span>
                                        {{ \Carbon\Carbon::parse($voluntary->start_activitiest)->format('d/m/Y') }}
                                        <span class="text-muted">
                                        </span>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <p class="text-warning text-xl">
                                        <i class="ion ion-ios-cart-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            Último Acceso:
                                        </span>
                                        <span class="text-muted">
                                            @if($log_date)
                                                {{ \Carbon\Carbon::parse($log_date)->format('d/m/Y H:i:s') }} hs.
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <!-- /.col Izquierda -->
                        <div class="card card-info card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            Nº:
                                            <input name="id"  class="form-control" placeholder="ID" title="id"
                                            disabled="" value={{ str_pad($voluntary->id, 6, "0", STR_PAD_LEFT) }}>
                                        </div>
                                        <div class="col-sm-6">
                                            Mail:
                                            <input name="email" type="email" class="form-control" placeholder="Mail" title="Mail" disabled="" value="{{ $voluntary->email }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Rol:
                                            <div class="input-group" title="Rol">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn-sm">
                                                        <i class="fas fa-user-tie"></i>
                                                    </span>
                                                </div>
                                                <select name="rol" title="rol" class="form-control" disabled="">
                                                    @foreach (current_roles() as $rol)
                                                        <option value="{{ $rol->id }}" @if ($rol->id == $voluntary->role_id) selected @endif>
                                                            {{ $rol->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            Nombres:
                                            <input type="text" class="form-control" placeholder="Nombres" title="Nombres"
                                                disabled="" value="{{ $voluntary->name }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Apellidos:
                                            <input type="text" class="form-control" placeholder="Apellidos"
                                                title="Apellidos" disabled="" value="{{ $voluntary->last_name }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Apodo:
                                            <input type="text" class="form-control" placeholder="Apodo" title="Apodo"
                                                disabled="" value="{{ $voluntary->nick_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            DNI:
                                            <input type="text" class="form-control" placeholder="DNI" title="DNI"
                                                disabled="" value="{{ $voluntary->DNI }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Fecha de Nacimiento:
                                            <div class="input-group">
                                                <input title="Fecha de Nacimiento" align="center" type="date"
                                                    class="form-control" style="text-align:center;" placeholder="01-01-2020"
                                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                                    data-mask="" im-insert="true" disabled=""
                                                    value="{{ $voluntary->date_of_birth }}">
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
                                                <select name="sex" title="Sexo" class="form-control" disabled="">
                                                    <option value="M" @if ($voluntary->sex == 'M') selected @endif>Masculino</option>
                                                    <option value="F" @if ($voluntary->sex == 'F') selected @endif>Femenino</option>
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
                                                <select name="tblood" title="Grupo Sanguíneo (RH)" class="form-control"
                                                    disabled="">
                                                    @foreach (current_tbloods() as $tblood)
                                                        <option value="{{ $tblood->id }}" @if ($tblood->id == $voluntary->tblood_id) selected @endif>
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
                                            <input name="address" type="text" class="form-control" placeholder="Dirección"
                                                value="{{ $voluntary->address }}" disabled>
                                        </div>
                                        <div class="col-sm-3">
                                            Localidad:
                                            <div class="input-group">
                                                <select name="city" class="custom-select" disabled>
                                                    @if (old('province'))
                                                        @foreach (current_ID_name_City(old('province')) as $city)
                                                            @if (old('province') == 6)
                                                                <option value="{{ $city->id }}" @if ($city->id == 5806) selected @endif> {{ $city->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $city->id }}" @if ($city->id == old('city')) selected @endif>
                                                                    {{ $city->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach (current_ID_name_City($voluntary->province_id) as $city)
                                                            <option value="{{ $city->id }}" @if ($city->id == $voluntary->city_id) selected @endif> {{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            Provincia:
                                            <div class="input-group">
                                                <select onchange="this.form.submit()" name="province" class="custom-select" disabled>
                                                    @foreach (current_ID_name_Province() as $province)
                                                        <option value="{{ $province->id }}" @if (old('province'))
                                                            @if ($province->id==old('province'))
                                                            selected @endif>
                                                        @else
                                                            @if ($province->id == $voluntary->province_id) selected
                                                            @endif>
                                                    @endif
                                                    {{ $province->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            Celular 1:
                                            <input type="text" class="form-control" placeholder="-"
                                                title="Celular 1" disabled="" value="{{ $voluntary->mobile1 }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Teléfono 1:
                                            <input type="text" class="form-control" placeholder="-"
                                                title="Teléfono 1" disabled="" value="{{ $voluntary->phone1 }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Celular 2:
                                            <input type="text" class="form-control" placeholder="-"
                                                title="Celular 2" disabled="" value="{{ $voluntary->mobile2 }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Teléfono 2:
                                            <input type="text" class="form-control" placeholder="-"
                                                title="Teléfono 2" disabled="" value="{{ $voluntary->phone2 }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-info card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            Ocupación:
                                            <input type="text" class="form-control" placeholder="Ocupación"
                                                title="Ocupación" disabled="" value="{{ $voluntary->occupation }}">
                                        </div>
                                        <div class="col-sm-8">
                                            Resumen CV:
                                            <textarea class="form-control" rows="4" placeholder="Resumen CV..."
                                                disabled="">{{ $voluntary->curriculum_vitae }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10"></div>
                    <div class="col-sm-1" align="right">
                        <!--<button type="submint" class="btn btn-block btn-outline-success btn-sm" " title="Exportar Excel" data-widget="" name="exportar" value="xls">
                            <i class="far fa-file-excel"></i> Excel
                          </button>-->
                    </div>
                    <div class="col-sm-1" align="right">
                        <button type="submint" class="btn btn-block btn-outline-danger btn-sm" title="Exportar PDF"
                            data-card-widget="" name="exportar" value="pdf" formtarget="_blank">
                            <i class="far fa-file-pdf"></i> Pdf
                        </button>
                    </div>
                </div>
            </div>
    </form>
    <form method="POST" action="/usuario/{{ $voluntary->id }}/fin">
        {!! csrf_field() !!}
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-fin">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            &nbsp;Fin Voluntariado
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p><strong>{{ $voluntary->name }} {{ $voluntary->last_name }}</strong>, DNI:
                                    <strong>{{ $voluntary->DNI }}</strong>, finalizó el voluntariado el día
                                    <input name="end_activitiest" align="center" type="date" class="form-control"
                                        style="text-align:center;" placeholder="01-01-2020" data-inputmask-alias="datetime"
                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true"
                                        @if (!$voluntary->end_activitiest) required @endif </p>

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
                            &nbsp;Reincorporar Voluntario
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p><strong>{{ $voluntary->name }} {{ $voluntary->last_name }}</strong>, DNI:
                                    <strong>{{ $voluntary->DNI }}</strong>, se reincorporó al voluntariado el día
                                    <input name="start_activitiest" align="center" type="date" class="form-control"
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
                if (@json(Session::get('message')) == 'Editado') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Usuario Editado Correctamente.' // pasa el mensaje a Json
                    })
            });

            $('.swalDefaultSuccess').ready(function() {
                if (@json(Session::get('message')) == 'Creado') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Usuario Creado Correctamente.' // pasa el mensaje a Json
                    })
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
