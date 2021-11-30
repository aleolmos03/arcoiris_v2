@extends('adminlte::page')

@section('title', 'Editar Niño')

@section('title_table', 'Editar Niño')

@section('content')
    <form method="POST" action="/datos/ninio/{{ $patient->id }}/editar">
        {!! csrf_field() !!}
        <div class="card card-red">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-ellipsis-v"></i>&nbsp;
                    Información Niño
                </h3>
                <div class="card-tools">
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
                                                    src="vendor/adminlte/dist/img/unnamed.png" @endif alt="User profile picture">
                                    </div>
                                </div>
                                <div class="col-sm-3 ">

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
                                        <input name="diaper_size" type="text" class="form-control float-right"
                                            placeholder="Marca y Talle Pañal" value="{{ $patient->diaper_size }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-tshirt"></i>
                                            </span>
                                        </div>
                                        <input name="upper_indumetary_size" type="text" class="form-control float-right"
                                            id="reservationtime" placeholder="Talle Ind. Superior"
                                            value="{{ $patient->upper_indumetary_size }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-archway"></i>
                                            </span>
                                        </div>
                                        <input name="alower_indumetary_size" type="text" class="form-control float-right"
                                            placeholder="Talle Ind. Inferior"
                                            value="{{ $patient->alower_indumetary_size }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-socks"></i></span>
                                        </div>
                                        <input name="shoe_size" type="text" class="form-control float-right"
                                            placeholder="Nº Calzado" value="{{ $patient->shoe_size }}">
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
                                            <input name="name" class="form-control" placeholder="Nombres" title="Nombres"
                                                value="{{ $patient->name }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Apellidos:
                                            <input name="last_name" type="text" class="form-control" placeholder="Apellidos"
                                                title="Apellidos" value="{{ $patient->last_name }}">
                                        </div>
                                        <div class="col-sm-2">
                                            Apodo:
                                            <input name="nick_name" type="text" class="form-control" placeholder="Apodo"
                                                value="{{ $patient->nick_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            DNI:
                                            <input name="dni" type="number" min="9999999" class="form-control" placeholder="DNI"
                                                title="DNI" value="{{ $patient->DNI }}">
                                        </div>
                                        <div class="col-sm-4">
                                            Fecha de Nacimiento:
                                            <div class="input-group">
                                                <input name="date_of_birth" alig="center" type="date" class="form-control"
                                                    style="text-align:center;" placeholder="01-01-2020"
                                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                                    data-mask="" im-insert="true" value="{{ $patient->date_of_birth }}">
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
                                                <select name="sex" class="form-control">
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
                                                <select name="tblood" title="Grupo Sanguíneo (RH)" class="form-control">
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
                                            <input name="address" type="text" class="form-control" placeholder="Dirección"
                                                value="{{ $patient->address }}">
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
                                                        @foreach (current_ID_name_City($patient->province) as $city)
                                                            <option value="{{ $city->id }}" @if ($city->id == $patient->city) selected @endif> {{ $city->name }}
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
                                                                @if ($province->id == $patient->province) selected @endif>
                                                            @endif
                                                            {{ $province->name }}
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
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                Inicio Tratamiento
                                                <div class="input-group">
                                                    <input name="start_treatment" alig="center" type="date"
                                                        class="form-control" style="text-align:center;"
                                                        placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                        im-insert="true" value="{{ $patient->start_treatment }}">
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
                                                    title="Nombres" required value="{{ $patient->diagnosis }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
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
                                                <select name="internship" class="form-control">
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
                                            <textarea name="description" class="form-control" rows="6"
                                                placeholder="Ingrese toda la información relevante">{{ $patient->description }}
                                            </textarea>
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
                                    <button type="button" class="btn btn-tool">
                                        <a href="{{ URL::current() }}/familiar"
                                            class="btn btn-block bg-gradient-olive btn-sm">
                                            <i class="fas fa-plus"></i>
                                            Agregar Familiar
                                        </a>
                                    </button>

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
                                                    <th width="25%">Contacto</th>
                                                    <th width="10%" title="Grupo Sanguíneo (RH)">
                                                        <i class="fas fa-tint"></i>
                                                    </th>
                                                    <th width="5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($families as $family)
                                                    <tr>
                                                        <td class="py-3 align-middle">
                                                            <img src="{!! asset($family->file) !!}" class="direct-chat-img"
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
                                                            <strong>Celular 1:&nbsp;</strong>
                                                            @if ($family->mobile1)
                                                                {{ $family->mobile1 }}
                                                            @else()
                                                                &#126;
                                                            @endif()
                                                            <br>
                                                            <strong>Celular 2:&nbsp;</strong>
                                                            @if ($family->mobile2)
                                                                {{ $family->mobile2 }}
                                                            @else()
                                                                &#126;
                                                            @endif()
                                                            <br>
                                                            <strong>Teléfono:&nbsp;</strong>
                                                            @if ($family->phone)
                                                                {{ $family->phone}}
                                                            @else()
                                                                &#126;
                                                            @endif()
                                                        </td>
                                                        <td class="py-3 align-middle">
                                                            {{ $family->tblood_name }}
                                                        </td>
                                                        <td class="text-right py-0 align-middle">
                                                            <a href="/datos/ninio/{{ $patient->id }}/edit/familiar/{{ $family->id }}/edit"
                                                                title="Ver detalles" class="text-muted">
                                                                <i class="fas fa-angle-right"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5
                                    ">{{ $families->render() }}</div>
                                    <div class="col-sm-4">

                                </div>
                                    <div class="col-sm-3" align="right">
                                        <div class="card-tools">
                                            <span class="direct-chat-timestamp float">
                                                {{ $total }} resultados
                                            </span>

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
        if(@json(Session::get('message')) == 'Editado')//funciona automatico
        Toast.fire({
          type: 'success',
          title: 'Familiar editado correctamente.'// pasa el mensaje a Json
        })
      });
      $('.swalDefaultSuccess').ready(function() {
        if(@json(Session::get('message')) == 'Quitado')//funciona automatico
        Toast.fire({
          type: 'success',
          title: 'Familiar quitado correctamente.'// pasa el mensaje a Json
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
