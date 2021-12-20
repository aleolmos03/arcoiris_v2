@extends('adminlte::page')

@section('title', 'Nuevo Usuario')

@section('title_table', 'Nuevo Usuario')

@section('content')
    <form method="POST" action="/usuario/crear">
        {!! csrf_field() !!}
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="far fa-user"></i>&nbsp;
                    Nuevo Usuario
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <!-- /.col (left) -->
                        <div class="card card-info card-outline">
                            <div class="card-body ">
                                <div class="card-body box-profile ">
                                    <div class="text-center">
                                        <img class="user-img img-fluid img-circle"
                                        src="vendor/adminlte/dist/img/userPDF.png" alt="User profile picture">
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
                                        <input name="start_activitiest" title="Inicio Voluntariado" align="center"
                                                        type="date" class="form-control" style="text-align:center;"
                                                        placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                        im-insert="true" required
                                                        @if(old('start_activitiest'))
                                                        value="{{ old('start_activitiest')}}"
                                                        @else
                                                        value={{ \Carbon\Carbon::Now()->format('Y-m-d') }}
                                                        @endif>
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
                                            -
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
                                        <div class="col-sm-8">
                                            Mail
                                            <input name="email" type="email" onchange="this.form.submit()"
                                                class="form-control @if ( App\Models\User::user_mail_exist(old('email'))) is-invalid @endif" placeholder="Mail" title="Mail"
                                                required value="{{ old('email') }}">
                                            <div class="invalid-feedback">
                                                <strong>El Mail existe.</strong>
                                            </div>
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
                                                    <option value="{{ $rol->id }}" @if($rol->id== old('role')) selected @endif> {{ $rol->name }}
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
                                                title="Nombres" value="{{ old('name') }}" required>
                                        </div>
                                        <div class="col-sm-4">
                                            Apellidos:
                                            <input name="last_name" type="text" class="form-control" placeholder="Apellidos"
                                                title="Apellidos" value="{{ old('last_name') }}" required>
                                        </div>
                                        <div class="col-sm-3">
                                            Apodo:
                                            <input name="nick_name" type="text" class="form-control" placeholder="Apodo"
                                                title="Apodo" value="{{ old('nick_name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            DNI:
                                            <input name="dni" type="number" min="9999999" max="99999999" onchange="this.form.submit()"
                                                class="form-control @if (current_existeDni(old('dni'))) is-invalid @endif" placeholder="DNI" title="DNI"
                                                required value="{{ old('dni') }}" required>
                                            <div class="invalid-feedback">
                                                <strong>El DNI existe.</strong>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            Fecha de Nacimiento:
                                            <div class="input-group">
                                                <input name="date_of_birth" title="Fecha de Nacimiento" align="center"
                                                    type="date" class="form-control" style="text-align:center;"
                                                    placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                    im-insert="true" required value="{{ old('date_of_birth') }}" required>
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
                                                    <option value="M" @if (old('sex') == 'M') selected @endif>Masculino</option>
                                                    <option value="F" @if (old('sex') == 'F') selected @endif>Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            Grupo (RH):
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn-xs">
                                                        <i class="fas fa-tint"></i>
                                                    </span>
                                                </div>
                                                <select name="tblood" title="Grupo Sanguíneo (RH)" class="form-control">
                                                    @foreach (current_tbloods() as $tblood)
                                                        <option value="{{ $tblood->id }}" @if ($tblood->id == old('tblood')) selected @endif>
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
                                            <input name="address" type="text" class="form-control"
                                                placeholder="Dirección" title="Dirección" required
                                                value="{{ old('address') }}" required>
                                        </div>
                                        <div class="col-sm-3">
                                            Localidad:
                                            <div class="input-group">
                                                <select name="city" class="custom-select">
                                                    @if(old('province'))
                                                        @foreach (current_ID_name_City(old('province')) as $city)
                                                            @if( old('province')== 6 )
                                                                <option value="{{ $city->id }}" @if ($city->id == 5806) selected @endif> {{ $city->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $city->id }}" @if ($city->id == old('city')) selected @endif> {{ $city->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach (current_ID_name_City('1') as $city)
                                                            @if( old('province')== 6 )
                                                                <option value="{{ $city->id }}" @if ($city->id == 2755) selected @endif> {{ $city->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $city->id }}" @if ($city->id == old('city')) selected @endif> {{ $city->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            Provincia:
                                            <div class="input-group">
                                                <select onchange="this.form.submit()" name="province"
                                                    class="custom-select">
                                                    @foreach (current_ID_name_Province() as $province)
                                                        <option value="{{ $province->id }}" @if ($province->id == old('province')) selected @endif>
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
                                                title="Celular 1" value="{{ old('mobile1') }}" required>
                                        </div>
                                        <div class="col-sm-3">
                                            Teléfono 1:
                                            <input name="phone1" type="text" class="form-control" placeholder="Teléfono 1"
                                                title="Celular 2" value="{{ old('phone1') }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Celular 2:
                                            <input name="mobile2" type="text" class="form-control" placeholder="Celular 2"
                                                title="Teléfono 1" value="{{ old('mobile2') }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Teléfono 2:
                                            <input name="phone2" type="text" class="form-control" placeholder="Teléfono 2"
                                                title="Teléfono 2" value="{{ old('phone2') }}">
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
                                                value="{{ old('occupation') }}">
                                        </div>
                                        <div class="col-sm-8">
                                            Resumen CV:
                                            <textarea name="curriculum_vitae" class="form-control" rows="4"
                                                placeholder="Resumen CV...">{{ old('curriculum_vitae') }}</textarea>
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
                        <button name="guardar" type="submit" class="btn  btn-info btn-sm" value="1"
                         @if (current_existeDni(old('dni'))|| App\Models\User::user_mail_exist(old('email'))) disabled @endif>
                            <i class="fas fa-check"></i> Guardar
                        </button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
    </div>
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
                if (@json(Session::get('message'))) //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: '@json(Session::get('
                        message '))' // pasa el mensaje a Json
                    })
            });
        });

    </script>
@stop
