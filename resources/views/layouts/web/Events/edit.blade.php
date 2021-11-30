@extends('adminlte::page')

@section('title', 'Nuevo Evento')

@section('title_table', 'Nuevo Evento')

@section('content')
<div class="card card-teal">
    <div class="card-header">
        <h3 class="card-title">
            <i class="far fa-edit"></i>&nbsp;
            Editar Información Evento
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool">
                <a href="{{ $url_anterior }}" class="btn btn-tool bg-gradient-teal btn-sm"><i
                        class="fas fa-times"></i>
                </a>
            </button>
        </div>
    </div>
    <form method="POST" action="/evento/{{ $event->id }}/editar">
        {!!csrf_field()!!}
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        ID:
                                        <input type="number" class="form-control" placeholder="ID" title="ID"
                                            value="{{ $event->id }}" disabled="">
                                    </div>
                                    <div class="col-sm-6">
                                      Título:
                                        <input name="title" type="text" class="form-control" placeholder="Título...."
                                        @if(old('title'))
                                           value="{{ old('title') }}"
                                        @else
                                           value="{{ $event->title }}"
                                        @endif
                                        required>
                                    </div>
                                    <div class="col-sm-4"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                      Tipo de Evento:{{ $event->tevent_id }}
                                        <div class="input-group">
                                            <select name="tevent" title="Tipo de Evento" class="form-control">
                                                @foreach (current_tevents() as $tevent)
                                                   @if(old('tevent'))
                                                      <option value="{{ $tevent->id }}" @if ($tevent->id == old('tevent') ) selected @endif>
                                                       {{ $tevent->name }}
                                                      </option>
                                                   @else
                                                      <option value="{{ $tevent->id }}" @if ($tevent->id == $event->tevent_id ) selected @endif>
                                                       {{ $tevent->name }}
                                                      </option>
                                                   @endif
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
                                             @if(old('date_event'))
                                                value="{{ old('date_event') }}"
                                             @else
                                                value="{{ \Carbon\Carbon::parse($event->date_event)->format('Y-m-d') }}"
                                             @endif
                                            required>
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
                                           data-target="#timepicker"  placeholder="10:00" title=" Hora Inicio"
                                           @if (old('hour_event'))
                                              value="{{ \Carbon\Carbon::parse(old('hour_event'))->format('H:i:s')}}"
                                           @else
                                              value="{{ \Carbon\Carbon::parse($event->date_event)->format('H:i:s')}}"
                                           @endif
                                           required>
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
                                       data-target="#timepicker"  placeholder="10:00" title="Duración"
                                       @if (old('duration_event'))
                                          value="{{ \Carbon\Carbon::parse(old('duration_event'))->format('H:i')}}"
                                       @else
                                          value="{{ \Carbon\Carbon::parse($event->duration_event)->format('H:i')}}"
                                       @endif
                                       required>
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
                                 placeholder="00" title="Cupo Maximo"
                                 @if (old('maximum_space'))
                                    value="{{ old('maximum_space') }}"
                                 @else
                                    value="{{ $event->maximum_space }}"
                                 @endif
                                 required>
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
                                <input name="address" type="text" class="form-control" placeholder="Dirección" title="Dirección"
                                @if (old('address'))
                                   value="{{ old('address') }}"
                                @else
                                   value="{{ $event->address }}"
                                @endif
                                required>
                            </div>
                            <div class="col-sm-3">
                                Localidad:
                                <div class="input-group">
                                    <select name="city" class="custom-select" >
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
                                            @foreach (current_ID_name_City($event->province) as $city)
                                                <option value="{{ $city->id }}" @if ($city->id == $event->city) selected @endif> {{ $city->name }}
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
                                        class="custom-select" >
                                        @foreach (current_ID_name_Province() as $province)
                                            <option value="{{ $province->id }}"
                                                @if (old('province'))
                                                    @if ($province->id == old('province')) selected @endif>
                                                @else
                                                    @if ($province->id == $event->province) selected @endif>
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
                            <div class="col-sm-12">
                                Descripcion:
                                <textarea name="description" class="form-control" rows="4"
                                placeholder="Descripción...">@if(old('description')) {{ old('description') }} @else {{ $event->description }} @endif</textarea>
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
