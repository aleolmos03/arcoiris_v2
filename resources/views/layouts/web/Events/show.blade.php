@extends('adminlte::page')

@section('title', 'Info. Evento')

@section('title_table', 'Info. Evento')

@section('content')
    <form>
        {!! csrf_field() !!}
        <div class="card card-teal">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-ellipsis-v"></i>&nbsp;
                    Información Evento
                    @if(auth()->user()->role_id == '1')
                    <span class="users-list-date text-light">
                        @if($event->created_at == $event->updated_at)
                            Creado por
                        @else
                            Modificado por
                        @endif
                        {{ current_infoUser($event->user_id)->name }} {{ current_infoUser($event->user_id)->last_name }}
                    </span>
                    @endif
                </h3>
                <div class="card-tools">
                    @if (auth()->user()->role_id != '3')
                        @if ($event->user_id == auth()->id() || auth()->user()->role_id == '1')
                            <button type="button" class="btn btn-tool" title="Editar">
                                <a href="{{ URL::current() }}/edit" type="button"
                                    class="btn btn-tool bg-gradient-teal btn-sm">
                                    <i class="far fa-edit"></i>&nbsp;Editar</a>
                            </button>
                            <button type="button" class="btn btn-tool" title="Eliminar">
                            <a type="button" class="btn btn-tool bg-gradient-teal btn-sm"data-toggle="modal"
                                        data-target="#modal-delete">
                                        <i class="far fa-trash-alt"></i> &nbsp;Eliminar
                                    </a>
                            </button>
                        @endif
                    @endif
                    <button type="button" class="btn btn-tool">
                        <a href="{{ $url_anterior }}" class="btn btn-tool bg-gradient-teal btn-sm"><i
                                class="fas fa-times"></i>
                        </a>
                    </button>
                </div>
            </div>
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
                                            <input value="{{ $event->title }}" name="title" type="text"
                                                class="form-control" placeholder="Título...." {{ $readonly_enabled }}>
                                        </div>
                                        <div class="col-sm-4"></div>
                                    </div>
                                    @if (current_eventPerson($event->id) == 'si')
                                                <br>
                                                @if ($event->date_event < now()->format('Y-m-d') || $event->created_at == '1990-01-01 00:00:00')
                                                <div class="ribbon-wrapper ribbon-lg">
                                                    <div class="ribbon bg-warning text-lg">
                                                        Cancelado
                                                    </div>
                                                </div>
                                                @else
                                                    <div class="ribbon-wrapper ribbon-lg">
                                                        <div class="ribbon bg-primary text-lg">
                                                            Inscripto
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                            @if ($event->date_event < now()->format('Y-m-d H:i') || $event->created_at == '1990-01-01 00:00:00')
                                            <div class="ribbon-wrapper ribbon-lg">
                                                <div class="ribbon bg-danger text-lg">
                                                    Finalizado
                                                </div>
                                            </div>
                                            @endif
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            Tipo de Evento:
                                              <div class="input-group">
                                                  <select name="tevent" title="Tipo de Evento" class="form-control" disabled>
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
                                                <input value="{{ \Carbon\Carbon::parse($event->date_event)->format('Y-m-d') }}" name="date_event" align="center"
                                                    type="date" class="form-control" style="text-align:center;"
                                                    placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true"
                                                    title="Fecha" {{ $readonly_enabled }}>
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
                                                <input
                                                    value="{{ \Carbon\Carbon::parse($event->date_event)->format('H:i:s') }}"
                                                    name="hour_event" align="center" type="time"
                                                    class="form-control datetimepicker-input text-success"
                                                    style="text-align:center;" data-target="#timepicker" placeholder="10:00"
                                                    title=" Hora Inicio" {{ $readonly_enabled }}>
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
                                                <input
                                                    value="{{ \Carbon\Carbon::parse($event->duration_event)->format('H:i') }}"
                                                    name="duration_event" align="center" type="time"
                                                    class="form-control datetimepicker-input text-info"
                                                    style="text-align:center;" data-target="#timepicker" placeholder="10:00"
                                                    title="Duración" {{ $readonly_enabled }}>
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
                                                <input value="{{ $event->maximum_space }}" name="maximum_space"
                                                    align="right" type="text" class="form-control" style="text-align:right;"
                                                    placeholder="00" title="Cupo Maximo" {{ $readonly_enabled }}>
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
                                                value="{{ $event->address }}" disabled >
                                        </div>
                                        <div class="col-sm-3">
                                            Localidad:
                                            <div class="input-group">
                                                <select name="city" class="custom-select" disabled>
                                                    @if (old('province'))
                                                        @foreach (current_ID_name_City(old('province')) as $city)
                                                            <option value="{{ $city->id }}" @if ($city->id == old('city')) selected @endif> {{ $city->name }}
                                                            </option>
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
                                                    class="custom-select" disabled>
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

                                            Descripción:
                                            <textarea name="description" class="form-control" rows="3"
                                                placeholder="Descripción..." {{ $disabled_enabled }}>{{ $event->description }}
                              </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-2">

                                    </div>
                                    <div class="col-sm-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </form>

    <div class="row">
        <div class="col-sm-12">
            <!-- /.col Izquierda -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><strong>
                        <i class="fas fa-users"></i>&nbsp;Participantes </strong>
                    </h3>
                   <div class="card-tools">
                    @if ($event->date_event < now()->format('Y-m-d H:i') || $event->created_at == '1990-01-01 00:00:00')
                    @else
                        @if ($participa == 'si')
                            <a href="{{ URL::current() }}/cancel/{{ current_person()->person_id }}" type="button">
                                <button type="button" class="btn btn-block bg-gradient-navy btn-sm"
                                    title="Cancelar Participación">
                                    <i class="fas fa-user-minus"></i> &nbsp;Cancelar Part.
                                </button>
                            </a>
                        @else
                            <a href="{{ URL::current() }}/ok/{{ current_person()->person_id }}" type="button">
                                @if ($event->maximum_space - $total > 0)
                                    <button type="button"
                                        class="btn btn-block bg-gradient-primary btn-sm"
                                        title="Participar del Evento">
                                        <i class="fas fa-user-plus"></i> &nbsp;Participar
                                    </button>
                                @else
                                    <button type="button"
                                        class="btn btn-block bg-gradient-primary btn-sm" disabled=""
                                        title="Sin Cupo disponible">
                                        <i class="fas fa-user-plus"></i> &nbsp;Participar
                                    </button>
                                @endif
                            </a>
                        @endif
                        @if( auth()->user()->role_id != 3)

                        <a href="{{ URL::current() }}/participantes" type="button">

                            <button type="button" class="btn btn-block bg-gradient-olive btn-sm">
                                <i class="fas fa-plus"></i>
                                Agregar Participantes

                            </button>
                        </a>
                        @endif
                    @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="card card card-outline">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th></th>
                                        <th>Apellido y Nombre</th>
                                        <th>DNI</th>
                                        <th>Celular</th>
                                        <th>Mail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($participantes as $participante)
                                    <tr>
                                        <td class="py-3 align-middle text-left">
                                            @if ($participante->per_id == current_person()->person_id)
                                                <p class="text-primary">
                                                    <strong>
                                            @endif
                                            {{ $participante->id  }}
                                                   </strong>
                                                </p>
                                        </td>
                                        <td class="py-3 align-middle">
                                            <img src="{!!  asset($participante->file) !!}" class="direct-chat-img"
                                                alt="message user image">
                                        </td>

                                        <td class="py-3 align-middle">
                                            @if ($participante->per_id  == current_person()->person_id)
                                                <p class="text-primary"> <strong>
                                            @endif
                                            {{ $participante->last_name }} {{ $participante->name }}</strong></p>
                                        </td>
                                        <td class="py-3 align-middle">
                                            @if ($participante->per_id  == current_person()->person_id)
                                                <p class="text-primary"> <strong>
                                            @endif
                                            {{ $participante->DNI }}</strong></p>
                                        </td>
                                        <td class="py-3 align-middle">
                                            @if ($participante->per_id  == current_person()->person_id)
                                                <p class="text-primary"> <strong>
                                            @endif
                                            {{ $participante->mobile }}</strong></p>
                                        </td>
                                        <td class="py-3 align-middle">
                                            @if ($participante->per_id  == current_person()->person_id)
                                                <p class="text-primary">
                                                    <strong>
                                            @endif
                                            {{ $participante->email }}


                                                    </strong>
                                                </p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                        {!! $participantes->appends(Request::only([]))->render() !!}
                    </div>
                    <div class="col-sm-2"></div>
                        <div class="col-sm-5" align="right">
                            <span class="direct-chat-timestamp float">
                                {{ $total }} confirmados
                            </span>
                        </div>
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
        <div class="col-sm-1" align="right">
            <button type="submint" class="btn btn-block btn-outline-danger btn-sm" title="Exportar PDF" data-card-widget=""
                name="exportar" value="pdf" formtarget="_blank">
                <i class="far fa-file-pdf"></i> Pdf
            </button>
        </div>
    </div>
    </div><!-- /.modal -->
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        &nbsp;Eliminar Evento
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>¿Seguro que desea eliminar el evento #{{ $event->id }} - {{ $event->title }}?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn  btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                    <a href="/evento/{{ $event->id }}/delete" type="button" class="btn  btn-danger btn-sm">
                        Si, eliminar
                    </a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Button trigger modal -->
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
                if (@json(Session::get('message')) == 'Modificado') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Evento Modificado con Exito.' // pasa el mensaje a Json
                    })
            });
            $('.swalDefaultSuccess').ready(function() {
                if (@json(Session::get('message')) == 'Cambio') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Cambio Registrado con Exito.' // pasa el mensaje a Json
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
