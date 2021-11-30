@extends('adminlte::page')

@section('title', 'Crear Familiar')

@section('title_table', 'Crear Familiar')

@section('content')
    <form method="POST" action="/datos/ninio/{{ $patient->id }}/edit/familiar/crear">
        {!! csrf_field() !!}
        <div class="card card-olive">
            <div class="card-header">
                <h3 class="card-title">
                    Nuevo Familiar
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool">
                        <a href="{{ $url_anterior }}" class="btn btn-tool bg-gradient-olive btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <!-- /.col (left) -->
                        <div class="card card-olive card-outline">
                            <div class="card-body p-2">
                                <div class="card-body box-profile ">
                                    <div class="text-center">

                                            <img class="user-img img-fluid img-circle"
                                                src="{!!  asset('vendor/adminlte/dist/img/userPDF.png') !!}" alt="User profile picture">
                                    </div>
                                </div>
                                <div class="col-sm-3 ">
                                    <br>
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
                                            Familiar de:
                                        </span>
                                        <span class="text-muted">
                                            {{ $patient->last_name }}, {{ $patient->name }}
                                        </span>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center  mb-1">
                                    <p class="text-warning text-xl">
                                        <i class="ion ion-ios-cart-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            Fecha:
                                        </span>
                                        <span class="text-muted">
                                            {{ \Carbon\Carbon::parse(now())->format('d/m/Y H:i:s') }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <!-- /.col Izquierda -->
                        <div class="card card-olive card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            Familiar:
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-user-friends"></i>
                                                    </span>
                                                </div>
                                                <select name="relationship" title="Vínculo Familiar" class="form-control"
                                                    required>
                                                        @foreach (current_relationships() as $trelationship)
                                                            <option value="{{ $trelationship->id }}" @if ($trelationship->id == old('relationship')) selected @endif>
                                                                {{ $trelationship->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-2">
                                            Cuidador:
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn-xs">
                                                        <i class="fas fa-user-plus"></i>
                                                    </span>
                                                </div>
                                                @if (old('keeper'))
                                                    <select onchange="this.form.submit()" name="keeper" class="form-control" title="Cuidador">
                                                        <option value='0' @if (old('keeper') == '0') selected @endif>No</option>
                                                        <option value='1' @if (old('keeper') == '1') selected @endif>Si</option>
                                                    </select>
                                                @else
                                                    <select onchange="this.form.submit()" name="keeper" class="form-control" title="Cuidador"
                                                    @if (URL::previous() == 'http://127.0.0.1:8000/ninio' ) disabled @endif>
                                                        <option value='0' @if ($keeper == '0') selected @endif>No</option>
                                                        <option value='1' @if ($keeper == '1') selected @endif>Si</option>
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            Nombres:
                                            <input name="name" type="text" class="form-control" title="Nombres" required
                                                value="{{ old('name') }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Apellidos:
                                            <input name="last_name" type="text" class="form-control" placeholder="Apellidos"
                                                title="Apellidos" required value="{{ old('last_name') }}">
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
                                                required value="{{ old('dni') }}">
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
                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true"
                                                    max="{{ \Carbon\Carbon::Now()->format('Y-m-d')}}" required value="{{ old('date_of_birth') }}">
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
                                            <input name="address" type="text" class="form-control" placeholder="Dirección"
                                                title="Dirección" required value="{{ old('address') }}">
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
                                                <select onchange="this.form.submit()" name="province" class="custom-select">
                                                    @foreach (current_ID_name_Province() as $province)
                                                        <option value="{{ $province->id }}" @if ($province->id == old('province')) selected @endif> {{ $province->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            Celular 1:
                                            <input name="mobile1" type="text" class="form-control" placeholder="Celular 1"
                                                title="Celular 1" value="{{ old('mobile1') }}"
                                                @if (URL::previous() == 'http://127.0.0.1:8000/ninio' ) required @endif>
                                        </div>
                                        <div class="col-sm-4">
                                            Teléfono:
                                            <input name="phone" type="text" class="form-control" placeholder="Teléfono"
                                                title="Teléfono" value="{{ old('phone') }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Celular 2:
                                            <input name="mobile2" type="text" class="form-control" placeholder="Celular 2"
                                                title="Celular 2" value="{{ old('mobile2') }}">
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
                        <button name="guardar" type="submit" class="btn btn-block btn-primary btn-sm" value="1"
                        @if (current_existeDni(old('dni'))) disabled @endif>
                            <i class="fas fa-check"></i> Guardar
                        </button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
    </form>
    </div>
@stop
