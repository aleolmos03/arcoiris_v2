@extends('adminlte::page')

@section('title', 'Perfil')

@section('title_table', 'Perfil')

@section('css')
    <script src="CheckPassword.js"></script>
    <link href="CheckPassword.css" rel="stylesheet" />

    <style>
        .Short {
            width: 100%;
            background-color: #dc3545;
            margin-top: 5px;
            height: 3px;
            color: #dc3545;
            font-weight: 500;
            font-size: 12px;
        }

        .Weak {
            width: 100%;
            background-color: #ffc107;
            margin-top: 5px;
            height: 3px;
            color: #ffc107;
            font-weight: 500;
            font-size: 12px;
        }

        .Good {
            width: 100%;
            background-color: #28a745;
            margin-top: 5px;
            height: 3px;
            color: #28a745;
            font-weight: 500;
            font-size: 12px;
        }

        .Strong {
            width: 100%;
            background-color: #d39e00;
            margin-top: 5px;
            height: 3px;
            color: #d39e00;
            font-weight: 500;
            font-size: 12px;
        }

    </style>
@stop

@section('content')
    <form method="POST" action="/perfil/editar">
        {!! csrf_field() !!}
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="far fa-address-card"></i>
                    &nbsp;Perfil
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool bg-gradient-info btn-sm">
                        <a type="button" data-toggle="modal" data-target="#modal-fin">
                            <i class="fas fa-user-times"></i>
                            &nbsp;Finalizar Voluntariado
                        </a>
                    </button>
                    <button ID="cambiarPass" type="button" class="btn btn-tool bg-gradient-info btn-sm">
                        <a type="button" data-toggle="modal" data-target="#modal-cambio-pass">
                            <i class="fas fa-key"></i>
                            &nbsp; Cambiar Contraseña
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
                                <div class="card-body box-profile ">
                                    <div class="text-center">
                                        <img class="user-img img-fluid" src="{!! asset($perfil->file) !!}"
                                            alt="User profile picture">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="text-warning text-xl">
                                        <i class="ion ion-ios-cart-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            Inicio Voluntariado:
                                        </span>
                                        {{ \Carbon\Carbon::parse($perfil->start_activitiest)->format('d/m/Y') }}
                                        <span class="text-muted">
                                        </span>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center  mb-1">
                                    <p class="text-warning text-xl">
                                        <i class="ion ion-ios-cart-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            Último Acceso:
                                        </span>
                                        <span class="text-muted">
                                            {{ \Carbon\Carbon::parse($log_date)->format('d/m/Y H:i:s') }} hs.
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
                                            <input type="number" class="form-control" title="id"
                                                value="{{ str_pad(auth()->user()->id , 6, "0", STR_PAD_LEFT) }}" disabled="">
                                        </div>
                                        <div class="col-sm-6">
                                            Mail:
                                            <input type="email" class="form-control" placeholder="Mail" title="Mail"
                                                value={{ $perfil->email }}>
                                        </div>
                                        <div class="col-sm-4">
                                            Rol:
                                            <div class="input-group" title="Rol">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn-sm">
                                                        <i class="fas fa-user-tie"></i>
                                                    </span>
                                                </div>
                                                <select name="role" title="rol" class="form-control" disabled>
                                                    @foreach (current_roles() as $rol)
                                                        <option value="{{ $rol->id }}" @if ($rol->id == $perfil->role_id) selected @endif>
                                                            {{ $rol->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8"></div>
                                        <div class="col-sm-4">
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
                                                title="Nombres" value="{{ $perfil->name }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Apellidos:
                                            <input name="last_name" type="text" class="form-control" placeholder="Apellidos"
                                                title="Apellidos" value="{{ $perfil->last_name }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Apodo:
                                            <input name="nick_name" type="text" class="form-control" placeholder="Apodo"
                                                title="Apodo" value="{{ $perfil->nick_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            DNI:
                                            <input name="dni" type="number" min="9999999" max="99999999"
                                                class="form-control" placeholder="DNI" title="DNI"
                                                value="{{ $perfil->DNI }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Fecha de Nacimiento:
                                            <div class="input-group">
                                                <input name="date_of_birth" title="Fecha de Nacimiento" align="center"
                                                    type="date" class="form-control" style="text-align:center;"
                                                    placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true"
                                                    value="{{ $perfil->date_of_birth }}">
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
                                                    <option value="M" @if ($perfil->sex == 'M') selected @endif>Masculino</option>
                                                    <option value="F" @if ($perfil->sex == 'F') selected @endif>Femenino</option>
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
                                                        <option value="{{ $tblood->id }}" @if ($tblood->id == $perfil->blood_type_id) selected @endif>
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
                                                value="{{ $perfil->address }}">
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
                                                        @foreach (current_ID_name_City($perfil->province_id) as $city)
                                                            <option value="{{ $city->id }}" @if ($city->id == $perfil->city_id) selected @endif> {{ $city->name }}
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
                                                            @if ($province->id == $perfil->province_id) selected
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
                                                title="Celular 1" value="{{ $perfil->mobile1 }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Teléfono 1:
                                            <input name="phone1" type="text" class="form-control" placeholder="Teléfono 1"
                                                title="Celular 2" value="{{ $perfil->mobile2 }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Celular 2:
                                            <input name="mobile2" type="text" class="form-control" placeholder="Celular 2"
                                                title="Teléfono 1" value="{{ $perfil->phone1 }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Teléfono 2:
                                            <input name="phone2" type="text" class="form-control" placeholder="Teléfono 2"
                                                title="Teléfono 2" value="{{ $perfil->phone2 }}">
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
                                                value="{{ $perfil->occupation }}">
                                        </div>
                                        <div class="col-sm-8">
                                            Resumen CV:
                                            <textarea name="curriculum_vitae" class="form-control" rows="4"
                                                placeholder="Resumen CV...">{{ $perfil->curriculum_vitae }}</textarea>
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
    </form>
    </div>
    <form method="POST" action="/perfil/actualizar">
        {!! csrf_field() !!}
        <!-- /.modal -->
        <!-- /.modal Cambio de contraseña -->
        <div class="modal fade" id="modal-cambio-pass" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title">
                            <i class="fas fa-key"></i>
                            &nbsp;Cambiar Contraseña
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">

                                <div class="form-group is-invalid">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                        </div>
                                        <input name="OldPassword" ID="OldPassword" type="Password" Class="form-control"
                                            placeholder="Ingrese Contraseña Actual" />
                                    </div>
                                    <div id="strengthMessage0"></div>
                                </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn  btn-default btn-sm" data-dismiss="modal">Cancelar</button>

                        <button name="cambiar" type="submit" class="btn  btn-info btn-sm" value="1">
                            <i class="fas fa-check"></i> Continuar
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>
    <form method="POST" action="/perfil/actualizar">
        {!! csrf_field() !!}
        <!-- /.modal -->
        <!-- /.modal Cambio de contraseña 2-->
        <div id="modal-cambio-pass2" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title">
                            <i class="fas fa-key"></i>
                            &nbsp;Cambiar Contraseña
                        </h5>
                        <button ID="cancelar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                                </div>
                                <input name="NewPassword" ID="txtPassword" type="Password" Class="form-control"
                                    placeholder="Ingrese Nueva Contraseña" required />
                            </div>
                            <div id="strengthMessage"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input ID="txtPassword2" type="Password" Class="form-control"
                                    placeholder="Confirme Nueva Contraseña" required />
                            </div>
                            <div id="strengthMessage2"></div>
                        </div>
                        <div class="form-group">
                            <p> La contraseña debe contener mínimo <b>8 caracteres</b>.</p>
                                    <p> Para mayor seguridad se recomienda combinación de <b>mayúsculas</b>,
                                        <b>minúsculas</b>, <b>números</b> y <b>caracteres especiales</b></p>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button ID="cancelar" type="button" class="btn  btn-default btn-sm"
                            data-dismiss="modal">Cancelar
                        </button>
                        <button name="actualizar" id="guardar2" class="btn  btn-info btn-sm" value="1">
                            <i class="fas fa-check"></i> Guardar
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>
    <form method="POST" action="/perfil/fin">
        {!! csrf_field() !!}
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
                                <p>
                                    <strong>{{ $perfil->name }} {{ $perfil->last_name }}</strong>,
                                    <br>
                                    ¿Deseas finalizar tu voluntriado en Asociación Civil Sin Fines de Lucro Arcoiris?
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn  btn-default btn-sm" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button name="fin" type="submit" class="btn  btn-info btn-sm" value="0">
                            <i class="fas fa-check"></i> Aceptar
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
        </a>
        <!-- /.modal -->
    </form>

    <!-- /.modal -->
    <div class="modal fade" id="modal-gracias">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        &nbsp;Fin Voluntariado
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>
                                <strong>{{ $perfil->name }} {{ $perfil->last_name }}</strong>,
                                <br>
                                Muchas Gracias por Colaborar con Asociación Civil Sin Fines de Lucro Arcoiris.
                                <br>
                                Hasta la proxima!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div  class="btn-sm" data-dismiss="modal">

                    </div>
                    <a class="btn btn-default btn-sm float-right " href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-power-off text-red"></i>
                        Salir
                    </a>
                </div>
            </div>
            <!-- /.modal-content -->
            <!-- /.modal -->
        </div>
    </div>
    </a>

@stop

@section('js')
    <script type="text/javascript">

        $(document).ready(function() {

            @if (current_infoUser(auth()->id())->state == 'E')
                $('#modal-cambio-pass').modal({backdrop: 'static', keyboard: false})
                $('#strengthMessage0').removeClass()
                $('#strengthMessage0').addClass('Short')
                $('#strengthMessage0').html('Contraseña Incorrecta')
            @endif
            @if (current_infoUser(auth()->id())->state == 'O')
                $('#modal-cambio-pass2').modal({backdrop: 'static', keyboard: false})
                $('#OldPassword').val('');
                $('#strengthMessage0').removeClass()
                $('#strengthMessage0').html('')
            @endif
            @if (current_infoUser(auth()->id())->state == 'I')
                $('#modal-gracias').modal({backdrop: 'static', keyboard: false})
            @endif

            //limpia campos modal contraseña
            $('#cambiarPass').click(function() {
                $('#OldPassword').val('');
                $('#strengthMessage0').removeClass()
                $('#strengthMessage0').html('')
                $('#txtPassword').val('');
                $('#strengthMessage').removeClass()
                $('#strengthMessage').html('')
                $('#txtPassword2').val('');
                $('#strengthMessage2').removeClass()
                $('#strengthMessage2').html('')
            });

            // Verifica feurza contraseña
            $('#txtPassword').keyup(function() {
                $('#strengthMessage').html(checkStrength($('#txtPassword').val()))
            })

            function checkStrength(password) {
                var strength = 0
                if (password.length > 0 && password.length < 8) {
                    document.getElementById("guardar2").disabled = true;
                    $('#strengthMessage').removeClass()
                    $('#strengthMessage').addClass('Short')
                    return 'Contraseña Demasiado Corta'
                }
                if (password.length > 7) strength += 1
                // Si la contraseña contiene caracteres tanto en minúsculas como en mayúsculas, aumente el valor de fuerza.
                if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
                // Si tiene números y caracteres, aumenta el valor de fuerza.
                if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
                // Si tiene un carácter especial, aumenta el valor de fuerza.
                if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
                // Si tiene dos caracteres especiales, aumenta el valor de fuerza.
                if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
                // Valor de fuerza calculado, podemos devolver mensajes
                // Si el valor es menor que 2
                if (strength == 0) {
                    $('#strengthMessage').removeClass()
                    return ''
                } else if (strength < 2) {
                    $('#strengthMessage').removeClass()
                    $('#strengthMessage').addClass('Weak')
                    return 'Contraseña Débil'
                } else if (strength == 2) {
                    $('#strengthMessage').removeClass()
                    $('#strengthMessage').addClass('Good')
                    return 'Contraseña Buena'
                } else {
                    $('#strengthMessage').removeClass()
                    $('#strengthMessage').addClass('Strong')
                    return 'Contraseña Fuerte'
                }
            }

            // compara contraseña
            //esta funcion deshabilita el boton guardar hasta que no se cumpla la coincidncia de contraseñas
            document.getElementById("guardar2").disabled = true;

            $('#txtPassword2').keyup(function() {
                var valor1 = $('#txtPassword').val();
                var valor2 = $('#txtPassword2').val();


                    if (valor1.length > 7 && valor2.length > 7 && valor2.length != 0 && valor1.length == valor2.length) {
                        if (valor1 == valor2) {
                            document.getElementById("guardar2").disabled = false;

                            $('#strengthMessage2').removeClass()
                            $('#strengthMessage2').addClass('Good')
                            return $('#strengthMessage2').html('Las Contraseñas Coincicen')
                        }
                        else {
                            document.getElementById("guardar2").disabled = true;
                            $('#strengthMessage2').removeClass()
                            $('#strengthMessage2').addClass('Short')
                            return $('#strengthMessage2').html('No Coincicen las contraseñas')

                        }
                    }
                    if (valor1.length > 7 && valor2.length > 7 && valor2.length != 0 && valor2.length != valor1.length) {

                        document.getElementById("guardar2").disabled = true;

                        $('#strengthMessage2').removeClass()
                        $('#strengthMessage2').addClass('Short')
                        return $('#strengthMessage2').html('No Coincicen las contraseñas')

                    }
                    else {
                        document.getElementById("guardar2").disabled = true;

                        $('#strengthMessage2').removeClass()
                        return $('#strengthMessage2').html('')
                    }

            })
        });

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
                        title: 'Perfil Editado Correctamente.' // pasa el mensaje a Json
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
                if (@json(Session::get('message')) == 'Agregado') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Usuario Reincorporado Correctamente.' // pasa el mensaje a Json
                    })
            });

            $('.swalDefaultSuccess').ready(function() {
                if (@json(Session::get('message')) == 'ErrorP') //funciona automatico
                    Toast.fire({
                        type: 'warning',
                        title: 'Contraseña Incorrecta' // pasa el mensaje a Json
                    })
            });

            $('.swalDefaultSuccess').ready(function() {
                if (@json(Session::get('message')) == 'ExitoP') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Cambio de Contraseña Exitoso' // pasa el mensaje a Json
                    })
            });

            $('.swalDefaultSuccess').ready(function() {
                if (@json(Session::get('message')) == 'Cambio') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Cambio de Estado Exitoso.' // pasa el mensaje a Json
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
