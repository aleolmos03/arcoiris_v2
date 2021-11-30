@extends('adminlte::page')

@section('title', 'Nuevo Evento')

@section('title_table', 'Nuevo Evento')

@section('content')
<div class="card card-teal">
    <div class="card-header">
        <h3 class="card-title">
            <i class="far fa-calendar-plus"></i>&nbsp;
            Nuevo Evento
        </h3>
    </div>
    <form method="POST" action="{{url('evento/crear')}}">
        {!!csrf_field()!!}
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                      Título:
                                        <input name="title" type="text" class="form-control" placeholder="Título...."
                                        value="{{ old('title') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                      Tipo de Evento:
                                        <div class="input-group">
                                            <select name="tevent" title="Tipo de Evento" class="form-control">
                                                @foreach (current_tevents() as $tevent)
                                                <option value="{{ $tevent->id }}" @if ($tevent->id == old('tevent') ) selected @endif>
                                                    {{ $tevent->name }}
                                                </option>
                                             @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                      Fecha:
                                        <div class="input-group">
                                            <input name="date_event" align="center" type="date" class="form-control"
                                             style="text-align:center;" placeholder="01-01-2020" data-inputmask-alias="datetime"
                                             data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true" title="Fecha"
                                             value="{{ old('date_event') }}" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                      Hora:
                                        <div class="input-group">
                                           <input name="hour_event" align="center" type="time" class="form-control datetimepicker-input text-success" style="text-align:center;"
                                           data-target="#timepicker"  placeholder="10:00" title=" Hora Inicio" value="{{ old('hour_event')}}" required>
                                           <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-clock"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                  Duración:
                                    <div class="input-group">
                                       <input name="duration_event" align="center" type="time" class="form-control datetimepicker-input text-info" style="text-align:center;"
                                       data-target="#timepicker"  placeholder="10:00" title="Duración" value="{{ old('duration_event')}}" required>
                                       <div class="input-group-prepend">
                                        <span class="input-group-text">
                                           <i class="fas fa-hourglass-end"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                              Cupo máximo:
                                <div class="input-group">
                                <input name="maximum_space" align="right" type="text" class="form-control" style="text-align:right;"
                                 placeholder="00" title="Cupo Maximo" value="{{ old('maximum_space') }}" required>
                                <div class="input-group-prepend">
                                        <span class="input-group-text">
                                           <i class="fas fa-users"></i>
                                        </span>
                                    </div>
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
                            <div class="col-sm-12">
                                Descripcion:
                                <textarea name="description" class="form-control" rows="4"
                                placeholder="Descripción...">{{ old('description') }} </textarea>
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
      timer: 7000,
      timerProgressBar: true,
      didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
      });

       $('.swalDefaultSuccess').ready(function() {
        if(@json(Session::get('message')) == 'Existe')//funciona automatico
          Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ya existe un evento con esta información',

                      })
        if(@json(Session::get('message')) == 'Falta')//funciona automatico
          Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Complete todos los campos para agregar el evento',

                      })

    });
 });

</script>


@stop
