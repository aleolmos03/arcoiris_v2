@extends('adminlte::page')

@section('title', 'Editar Familiar')

@section('title_table', 'Editar Familiar')

@section('content')
    <form method="POST" action="/datos/ninio/{{ $patient->id }}/edit/familiar/{{ $family->id }}/editar">
        {!! csrf_field() !!}
        <div class="card card-olive">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="far fa-edit"></i>&nbsp;
                    Editar Información del familiar
                </h3>
                <div class="card-tools">
                    @if($count_families > 1 && $family->keeper == 0)
                    <button type="button" class="btn btn-tool bg-gradient-olive btn-sm">
                        <a type="button" data-toggle="modal" data-target="#modal-fin">
                            <i class="fas fa-user-times "></i> &nbsp;Quitar Familiar
                        </a>
                    </button>
                    @endif
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
                            <div class="card-body box-profile p-2">
                                <img class="user-img img-fluid"
                                @if ($family->file) src="{!!  asset($family->file) !!}"
                                @else
                                src="{!!  asset('vendor/adminlte/dist/img/unnamed.png') !!}"
                                @endif alt="User profile picture">
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
                                            Última Actualización:
                                        </span>
                                        <span class="text-muted">
                                            {{ \Carbon\Carbon::parse($family->updated_at)->format('d/m/Y H:i:s') }}
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
                                                            <option value="{{ $trelationship->id }}" @if ($trelationship->id == $family->relationship) selected @endif>
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
                                                    <select onchange="this.form.submit()" name="keeper" class="form-control" title="Cuidador" >
                                                        <option value='0' @if (old('keeper') == '0') selected @endif>No</option>
                                                        <option value='1' @if (old('keeper') == '1') selected @endif>Si</option>
                                                    </select>
                                                @else

                                                    <select onchange="this.form.submit()" name="keeper" class="form-control" title="Cuidador"
                                                    @if (URL::previous() == 'http://127.0.0.1:8000/ninio' || $count_families == 1 ) disabled @endif>
                                                        <option value='0' @if ($family->keeper == '0') selected @endif>No</option>
                                                        <option value='1' @if ($family->keeper == '1') selected @endif>Si</option>
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
                                            <input name="name" type="text" class="form-control" placeholder="Nombres"
                                                title="Nombres" value="{{ $family->name }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Apellidos:
                                            <input name="last_name" type="text" class="form-control" placeholder="Apellidos"
                                                title="Apellidos" value="{{ $family->last_name }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Apodo:
                                            <input name="nick_name" type="text" class="form-control" placeholder="Apodo"
                                                title="Apodo" value="{{ $family->nick_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            DNI:
                                            <input name="dni" type="number" min="9999999" max="99999999"
                                                class="form-control" placeholder="DNI" title="DNI"
                                                value="{{ $family->DNI }}" required>
                                        </div>
                                        <div class="col-sm-4">
                                            Fecha de Nacimiento:
                                            <div class="input-group">
                                                <input name="date_of_birth" title="Fecha de Nacimiento" align="center"
                                                    type="date" class="form-control" style="text-align:center;"
                                                    placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true"
                                                    value="{{ $family->date_of_birth }}">
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
                                                    <option value="M" @if ($family->sex == 'M') selected @endif>Masculino</option>
                                                    <option value="F" @if ($family->sex == 'F') selected @endif>Femenino</option>
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
                                                        <option value="{{ $tblood->id }}" @if ($tblood->id == $family->tblood_id) selected @endif>
                                                            {{ $tblood->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            Dirección:
                                            <input name="address" type="text" class="form-control" placeholder="Dirección"
                                                title="Dirección" value="{{ $family->address }}">
                                        </div>
                                        <div class="col-sm-3">
                                            Localidad:
                                            <div class="input-group">
                                                <select name="city" class="custom-select">
                                                    @if (old('province'))
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
                                                        @foreach (current_ID_name_City($family->province) as $city)
                                                            <option value="{{ $city->id }}" @if ($city->id == $family->city) selected @endif> {{ $city->name }}
                                                            </option>
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
                                                        <option value="{{ $province->id }}"
                                                            @if (old('province'))
                                                                @if ($province->id == old('province')) selected @endif>
                                                            @else
                                                                @if ($province->id == $family->province) selected @endif>
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
                                        <div class="col-sm-4">
                                            Celular 1:
                                            <input name="mobile1" type="text" class="form-control" placeholder="Celular 1"
                                                title="Celular 1" value="{{ $family->mobile1 }}"
                                                @if(old('keeper') == 1 ) required @endif>
                                        </div>
                                        <div class="col-sm-4">
                                            Teléfono:
                                            <input name="phone" type="text" class="form-control" placeholder="Teléfono"
                                                title="Teléfono 1" value="{{ $family->phone }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Celular 2:
                                            <input name="mobile2" type="text" class="form-control" placeholder="Celular 2"
                                                title="Teléfono 1" value="{{ $family->mobile2 }}">
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
                        <button name="guardar" type="submit" class="btn btn-block btn-primary btn-sm" value="1">
                            <i class="fas fa-check"></i> Guardar
                        </button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
    </form>
    </div>
    <form method="POST" action="/datos/ninio/{{ $patient->id }}/edit/familiar/{{ $family->id }}/fin">
        {!! csrf_field() !!}
        <!-- /.modal -->
        <div class="modal fade" id="modal-fin">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            &nbsp;&nbsp;&nbsp;Quitar Familiar
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                Seguro que desea quitar el familiar,
                                <strong>{{ $family->name }} {{ $family->last_name }}</strong>, DNI:
                                <strong>{{ $family->DNI }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn  btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn  btn-info btn-sm">
                            <i class="fas fa-check"></i> OK
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
        <!-- /.modal -->
    </form>
    @stop
