@extends('adminlte::page')

@section('title', 'Agenda')

@section('title_table', 'Agenda')

@section('content')
    <form role="form">
        {!! csrf_field() !!}
        <div class="card card-teal card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>&nbsp;
                    Agenda
                    <!--{ $titulo_filtro }}-->
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card card-outline">
                                        <div class="card-header-light">
                                            <nav class="nav nav-underline">
                                                <a class="navbar-brand dropdown-toggle btn-sm text-primary" href="#"
                                                    id="navbarDropdownRango" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    {{ $filtro }} :
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ url('/agenda/Fecha') }}">Fecha</a>
                                                    <a class="dropdown-item" href="{{ url('/agenda/Rango') }}">Rango</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ url('/agenda/Todo') }}">Todo</a>
                                                </div>
                                                @if ($filtro == 'Fecha')
                                                <li class="nav-item">
                                                    <div class="bg-light btn-sm">
                                                        <input onchange="this.form.submit()" name="fecha" align="center"
                                                            type="date" class="btn-xs btn-default " placeholder="01-01-2020"
                                                            data-inputmask-alias="datetime"
                                                            data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                            im-insert="true" title="Seleccionar Fecha"
                                                            value="{{ $f_fecha }}">
                                                        </a>
                                                    </div>
                                                </li>
                                                @endif
                                                @if ($filtro == 'Rango')
                                                    <li class="nav-item">
                                                        <div class="bg-light btn-sm">
                                                            Desde:
                                                            <input name="desde" align="center" type="date"
                                                                class="btn-xs btn-default" style="text-align:center;"
                                                                placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                                data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                                im-insert="true" title="Seleccionar Fecha"
                                                                value={{ $f_desde }}>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <div class="bg-light btn-sm">
                                                            Hasta:
                                                            <input name="hasta" align="center" type="date"
                                                                class="btn-xs btn-default" placeholder="01-01-2020"
                                                                data-inputmask-alias="datetime"
                                                                data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                                im-insert="true" title="Seleccionar Fecha"
                                                                value={{ $f_hasta }}>
                                                            </a>
                                                    </li>
                                                @endif
                                            </nav>
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

                                                    <ul class="navbar-nav mr-auto form-group">
                                                        @if ($filtro == 'Fecha1')
                                                            <li class="nav-item dropdown form-group">
                                                                <a class="nav-link form-group text-info btn-sm" href="#">
                                                                    Fecha:
                                                                    <input onchange="this.form.submit()" name="fecha"
                                                                        align="center" type="date"
                                                                        class="btn-sm btn-default " placeholder="01-01-2020"
                                                                        data-inputmask-alias="datetime"
                                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                                        im-insert="true" title="Seleccionar Fecha"
                                                                        value="{{ $f_fecha }}">
                                                                </a>
                                                        @endif
                                                        @if ($filtro == 'Rango1')
                                                            <li class="nav-item">
                                                                <a class="nav-link text-info btn-sm">
                                                                    Desde:
                                                                    <input name="desde" align="center" type="date"
                                                                        class="btn-sm btn-default"
                                                                        style="text-align:center;" placeholder="01-01-2020"
                                                                        data-inputmask-alias="datetime"
                                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                                        im-insert="true" title="Seleccionar Fecha"
                                                                        value={{ $f_desde }}>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link text-info btn-sm">
                                                                    Hasta:
                                                                    <input name="hasta" align="center" type="date"
                                                                        class="btn-sm btn-default" placeholder="01-01-2020"
                                                                        data-inputmask-alias="datetime"
                                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                                        im-insert="true" title="Seleccionar Fecha"
                                                                        value={{ $f_hasta }}>
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li class="nav-item dropdown">
                                                            <a class="nav-link text-info btn-sm">
                                                                @if ($t_evento != '')<i class="fas fa-caret-right"></i> @endif
                                                                Tipo Evento:
                                                                <select name="tevent" onchange="this.form.submit()"
                                                                    class="bg-light btn-sm">
                                                                    <option value="" @if ($t_evento == '') selected @endif>
                                                                        Todo
                                                                    </option>
                                                                    @foreach (current_tevents() as $tevent)
                                                                        <option value="{{ $tevent->id }}" @if ($tevent->id == $t_evento) selected @endif>
                                                                            {{ $tevent->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item dropdown form-group">
                                                            <a class="nav-link text-info btn-sm">
                                                                @if ($f_asistencia != '')<i class="fas fa-caret-right"></i> @endif
                                                                Asistencia:
                                                                <select name="asistencia" onchange="this.form.submit()"
                                                                    class="bg-light btn-sm">
                                                                    <option value="" @if ($f_asistencia == '') selected @endif>Todo</option>
                                                                    <option value="si" @if ($f_asistencia == 'si') selected @endif>Confirmada
                                                                    </option>
                                                                </select>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link form-group text-info btn-sm" href="#">
                                                                @if ($f_estado != '')<i class="fas fa-caret-right"></i> @endif
                                                                Estado:
                                                                <select onchange="this.form.submit()" name="estado"
                                                                    class="bg-light btn-sm" title="estado">
                                                                    <option value="" @if ($f_estado == '') selected @endif>
                                                                        Todo
                                                                    </option>
                                                                    <option value="1" @if ($f_estado == '1') selected @endif>
                                                                        Sólo Activos
                                                                    </option>
                                                                    <option value="2" @if ($f_estado == '2') selected @endif>
                                                                        Sólo Inactivos
                                                                    </option>
                                                                </select>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <!--aqui va los filtros-->
                                                </div>
                                                <!-- SEARCH FORM -->
                                                <div class="input-group input-group"
                                                    title="Ingrese ID o Título del Evento">
                                                    <input name="buscar" class="form-control form-control-navbar-light"
                                                        type="search" placeholder="Buscar" aria-label="Search" @if($f_buscar) value={{ $f_buscar }} @else value='' @endif>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-navbar " type="submit">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                    &nbsp;
                                                    <button class="navbar-toggler btn-xs" type="button"
                                                        data-toggle="collapse" data-target="#navbarTogglerDemo03"
                                                        aria-controls="navbarTogglerDemo03" aria-expanded="false"
                                                        aria-label="Toggle navigation">
                                                        <span class="navbar-toggler-icon"></span>
                                                    </button>
                                                </div>
                                            </nav>
                                            <!--</form>-->
                                        </div>
                                        <div class="bg-light mailbox-read-info p-0">
                                            <h6>
                                                <span class="mailbox-read-time float-right">{{ $total }} Resultados
                                                    &nbsp;&nbsp;&nbsp;</span>
                                            </h6>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">ID</th>
                                                        <th width="10%">Fecha</th>
                                                        <th width="5%">Hora</th>
                                                        <th width="50%">Evento</th>
                                                        <th width="5%">Duración</th>
                                                        <th width="7%">Tipo</th>
                                                        <th width="5%" title="Inscriptos">Inscrip.</th>
                                                        <th width="8%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($events as $event)

                                                        <tr>
                                                            <td class="py-3 align-middle" align="left">
                                                                {{ $event->id }}
                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                {{ \Carbon\Carbon::parse($event->date_event)->format('d/m/Y') }}
                                                            </td>
                                                            <td class="py-3 align-middle" align="center">
                                                                {{ \Carbon\Carbon::parse($event->date_event)->format('H:i') }}
                                                            </td>
                                                            <td class="py-3 align-middle">

                                                                @if ($event->created_at == '1990-01-01 00:00:00')
                                                                    <span
                                                                        class="badge badge-danger float-right">Cancelado</span>
                                                                @else
                                                                    @if (current_infoEventUser($event->id) != null)
                                                                        @if ($event->updated_at != $event->created_at && current_infoEventUser($event->id)->view_event != $event->updated_at)
                                                                            <span
                                                                                class="badge badge-success float-right">Editado</span>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                                <strong>Título:&nbsp; <i></strong>
                                                                @if ($event->date_event < now()->format('Y-m-d H:i') || $event->created_at == '1990-01-01 00:00:00')
                                                                    <s><span class="badge badge-danger float-right">
                                                                            Finalizado
                                                                        </span>
                                                                @endif
                                                                @if (current_eventPerson($event->id) == 'si')
                                                                    <span class="badge badge-primary float-right">
                                                                        Inscripto
                                                                    </span>
                                                                @endif
                                                                {{ $event->title }}</s></i>
                                                                <br>
                                                                <strong>Dirección:&nbsp;</strong>
                                                                @if ($event->date_event < now()->format('Y-m-d H:i') || $event->created_at == '1990-01-01 00:00:00')
                                                                    <s>
                                                                @endif
                                                                 {{ $event->address }},
                                                                 &nbsp;
                                                                 {{ $event->city }},
                                                                 &nbsp;
                                                                 {{ $event->province }}
                                                                </s>
                                                                <br>
                                                                <strong>Descripción:&nbsp;</strong>
                                                                @if ($event->date_event < now()->format('Y-m-d H:i') || $event->created_at == '1990-01-01 00:00:00')
                                                                    <s>
                                                                @endif
                                                                {{ $event->description }}</s>
                                                            </td>

                                                            <td class="py-3 align-middle" align="center">
                                                                {{ \Carbon\Carbon::parse($event->duration_event)->format('H:i') }}
                                                                hs.
                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                {{  $event->tevent }}
                                                            </td>

                                                            <td class="py-3 align-middle" align="left">

                                                                <strong>
                                                                   {{ $array[$event->id] }}
                                                                </strong>
                                                                /
                                                                {{ $event->maximum_space }}
                                                            </td>
                                                            <td class="py-3 align-middle" align="right">

                                                                @if ($event->created_at != '1990-01-01 00:00:00')
                                                                    <a href="/agenda/{{ $filtro }}/evento/{{ $event->id }}"
                                                                        title="Ver detalles" class="text-muted">
                                                                        <i class="fas fa-angle-right"></i>
                                                                    </a>
                                                                @endif

                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @if ($total == 0)
                                                <h5 class="py-3 align-middle" align="center">No se encontraron registros
                                                </h5>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10">
                                            @if ($exportar != 'pdf' && $exportar != 'xls')

                                                {{ $events->appends([
                                                    'buscar' => $f_buscar,
                                                    'tevent' => $t_evento,
                                                    'asistencia' => $f_asistencia,
                                                    'orden' => $f_orden,
                                                    'fecha' => $f_fecha,
                                                    'desde' => $f_desde,
                                                    'hasta' => $f_hasta,
                                                    'estado' => $f_estado
                                                    ])->links() }}

                                            @endif

                                        </div>
                                        @if ($total > 1)
                                            <div class="col-sm-1" align="right">
                                                <!--<button type="submint" class="btn btn-block btn-outline-success btn-sm" " title="Exportar Excel" data-widget="" name="exportar" value="xls">
                                                              <i class="far fa-file-excel"></i> Excel
                                                            </button>-->
                                            </div>
                                            <div class="col-sm-1" align="right">
                                                <button type="submint" class="btn btn-block btn-outline-danger btn-sm"
                                                    title="Exportar PDF" data-card-widget="" name="exportar" value="pdf"
                                                    formtarget="_blank">
                                                    <i class="far fa-file-pdf"></i> Pdf
                                                </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                if (@json(Session::get('message')) == 'Creado') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Evento Creado con Exito.' // pasa el mensaje a Json
                    })
            });

            $('.swalDefaultSuccess').ready(function() {
                if (@json(Session::get('message')) == 'Modificado') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Evento Modificado con Exito.' // pasa el mensaje a Json
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
