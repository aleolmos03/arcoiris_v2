@extends('adminlte::page')

@section('title', 'Info. Voluntario')

@section('title_table', 'Info. Voluntario')

@section('content')
    <form method="POST" action="/voluntarios/info/{{ $voluntary->id }}/editar">
        {!! csrf_field() !!}
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="far fa-edit"></i>&nbsp;
                    Editar Información Voluntario
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool bg-gradient-info btn-sm">
                        <a type="button" data-toggle="modal" data-target="#modal-cambio-pass">

                            <i class="fas fa-key"></i>
                            &nbsp; Reestablecer Contraseña
                        </a>
                    </button>
                    <button type="button" class="btn btn-tool">
                        <a href="{{ $url_anterior }}" class="btn btn-tool bg-gradient-info btn-sm"><i
                                class="fas fa-times"></i>
                        </a>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <!-- /.col (left) -->
                        <div class="card card-info card-outline">
                            <div class="card-body ">
                                <div class="card-body box-profile ">
                                    <div class="text-center">
                                        <img class="user-img img-fluid" src="{!! asset($voluntary->file) !!}"
                                            alt="User profile picture">
                                    </div>
                                    <div class="description-block p-2 bg-warning">
                                    </div>
                                </div>
                            </div>
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
                                            {{ \Carbon\Carbon::parse($voluntary->updated_at)->format('d/m/Y H:i:s') }}
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
                                            ID:
                                            <input name="id" type="number" class="form-control" placeholder="ID" title="id"
                                            disabled="" value="{{ $voluntary->id }}">
                                        </div>
                                        <div class="col-sm-6">
                                            Mail:
                                            <input name="email" type="email" class="form-control" placeholder="Mail"
                                                title="Mail" value="{{ $voluntary->email }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Rol:
                                            <div class="input-group" title="Rol">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn-sm">
                                                        <i class="fas fa-user-tie"></i>
                                                    </span>
                                                </div>
                                                <select name="role" class="form-control">
                                                    @foreach (current_roles() as $rol)
                                                        <option value="{{ $rol->id }}" @if ($rol->id == $voluntary->role_id) selected @endif> {{ $rol->name }}
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
                                            <input name="name" type="text" class="form-control" placeholder="Nombres"
                                                title="Nombres" value="{{ $voluntary->name }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Apellidos:
                                            <input name="last_name" type="text" class="form-control" placeholder="Apellidos"
                                                title="Apellidos" value="{{ $voluntary->last_name }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Apodo:
                                            <input name="nick_name" type="text" class="form-control" placeholder="Apodo"
                                                title="Apodo" value="{{ $voluntary->nick_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            DNI:
                                            <input name="dni" type="number" min="9999999" max="99999999"
                                                class="form-control" placeholder="DNI" title="DNI"
                                                value="{{ $voluntary->DNI }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Fecha de Nacimiento:
                                            <div class="input-group">
                                                <input name="date_of_birth" title="Fecha de Nacimiento" align="center"
                                                    type="date" class="form-control" style="text-align:center;"
                                                    placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true"
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
                                                <select name="sex" title="Sexo" class="form-control">
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
                                                <select name="tblood" title="Grupo Sanguíneo (RH)" class="form-control">
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
                                                value="{{ $voluntary->address }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Localidad:
                                            <div class="input-group">
                                                <select name="city" class="custom-select">
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
                                                        @foreach (current_ID_name_City($voluntary->province) as $city)
                                                            <option value="{{ $city->id }}" @if ($city->id == $voluntary->city) selected @endif> {{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            Provincia:
                                            <div class="input-group">
                                                <select onchange="this.form.submit()" name="province" class="custom-select">
                                                    @foreach (current_ID_name_Province() as $province)
                                                        <option value="{{ $province->id }}" @if (old('province'))
                                                            @if ($province->id==old('province'))
                                                            selected @endif>
                                                        @else
                                                            @if ($province->id == $voluntary->province) selected
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
                                            <input name="mobile1" type="text" class="form-control" placeholder="Celular 1"
                                                title="Celular 1" value="{{ $voluntary->mobile1 }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Teléfono 1:
                                            <input name="phone1" type="text" class="form-control" placeholder="Teléfono 1"
                                                title="Celular 2" value="{{ $voluntary->mobile2 }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Celular 2:
                                            <input name="mobile2" type="text" class="form-control" placeholder="Celular 2"
                                                title="Teléfono 1" value="{{ $voluntary->phone1 }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Teléfono 2:
                                            <input name="phone2" type="text" class="form-control" placeholder="Teléfono 2"
                                                title="Teléfono 2" value="{{ $voluntary->phone2 }}">
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
                                            <input name="occupation" type="text" class="form-control"
                                                placeholder="Ocupación" title="Ocupación"
                                                value="{{ $voluntary->occupation }}">
                                        </div>
                                        <div class="col-sm-8">
                                            Resumen CV:
                                            <textarea name="curriculum_vitae" class="form-control" rows="4"
                                                placeholder="Resumen CV...">{{ $voluntary->curriculum_vitae }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-2">
                        <button name="guardar" type="submit" class="btn  btn-info btn-sm" value="1">
                            <i class="fas fa-check"></i> Guardar
                        </button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <!-- /.modal Cambio de contraseña -->
        <div class="modal fade" id="modal-cambio-pass">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title">
                            <i class="fas fa-key"></i>
                            &nbsp;Reestablecer Contraseña
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>Esta a punto de reestablecer la contraseña de</p>
                                <p><strong>{{ $voluntary->name }} {{ $voluntary->last_name }}</strong>, DNI:
                                    <strong>{{ $voluntary->DNI }}</strong>
                                </p>
                                <p>¿Está seguro de realizar realizar esta acción?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn  btn-default btn-sm" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button name="aceptar" type="submit" class="btn  btn-info btn-sm" value="1">
                            <i class="fas fa-check"></i> Aceptar
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
                if (@json(Session::get('message')) == 'ExitoP') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Cambio de Contraseña Exitoso' // pasa el mensaje a Json
                    })
            });

        });
    </script>
@stop
