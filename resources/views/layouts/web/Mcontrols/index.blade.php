@extends('adminlte::page')

@section('title', 'Controles')

@section('title_table', 'Controles')


@section('content')
    <form role="form">
        {!! csrf_field() !!}
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tasks"></i>&nbsp;
                    Controles
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card card-outline">
                                        <div class="card-tools" style="text-align: center;">
                                            <span class="nav-link text-info">
                                                Totales por día:
                                               <h5>
                                                @if( \Carbon\Carbon::parse($f_fecha)->isMonday())
                                                <b> @endif Lunes:&nbsp;{{ $totalL }} &nbsp; </b>
                                                   | &nbsp;
                                                   @if(\Carbon\Carbon::parse($f_fecha)->isTuesday())
                                                   <b> @endif
                                                       Martes:&nbsp;{{ $totalM }} &nbsp;</b>
                                                   | &nbsp;
                                                   @if(\Carbon\Carbon::parse($f_fecha)->isWednesday()) <b> @endif
                                                       Miércoles:&nbsp;{{ $totalX }}</b>&nbsp;
                                                   | &nbsp;
                                                   @if(\Carbon\Carbon::parse($f_fecha)->isThursday()) <b> @endif
                                                       Jueves:&nbsp;{{ $totalJ }}</b>
                                                       | &nbsp;
                                                       <small>
                                                    @if(\Carbon\Carbon::parse($f_fecha)->isFriday()) <b> @endif
                                                        Viernes</b>&nbsp;
                                                        | &nbsp;
                                                   @if(\Carbon\Carbon::parse($f_fecha)->isSaturday()) <b> @endif
                                                       Sábado</b>&nbsp;
                                                       | &nbsp;
                                                   @if(\Carbon\Carbon::parse($f_fecha)->isSunday()) <b> @endif
                                                       Domingo</b></small>
                                                <h5>
                                            </span>
                                    </div>
                                        <div class="card-header-light">
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                                                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                                        <li class="nav-item ">
                                                            <a class="nav-link form-group text-info btn-sm" href="#">
                                                                Fecha:
                                                                <input onchange="this.form.submit()" name="fecha"
                                                                    align="center" type="date" class="btn-sm btn-default "
                                                                    placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                                    im-insert="true" title="Seleccionar Fecha"
                                                                    value="{{ $f_fecha }}">
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link form-group text-info btn-sm" href="#">
                                                                @if ($f_asistencia != '')<i class="fas fa-caret-right"></i> @endif
                                                                Asistencia:
                                                                <select onchange="this.form.submit()" name="asistencia"
                                                                    class="bg-light btn-sm">
                                                                    <option value='' @if ($f_asistencia == '') selected @endif>Todo</option>
                                                                    <option value="1" @if ($f_asistencia == '1') selected @endif>Si&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                                    <option value="0" @if ($f_asistencia == '0') selected @endif>No</option>
                                                                </select>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- SEARCH FORM -->
                                                <div class="input-group input-group"
                                                title="Ingrese ID, DNI o Nombre">
                                                    <input name="buscar" class="form-control form-control-navbar-light"
                                                        type="search" placeholder="Buscar" aria-label="Search"
                                                        value={{ $f_buscar }}>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-navbar" type="submit" name="orden">
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
                                        </div>
                                        <div class="bg-light mailbox-read-info p-0">
                                            <span class="mailbox-read-time float-right">
                                                {{ $total }}
                                                @if ($total == 1)
                                                    Resultado
                                                @else
                                                    Resultados
                                                @endif
                                                &nbsp;&nbsp;&nbsp;
                                            </span>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">ID</th>
                                                        <th width="15%">Fecha</th>
                                                        <th width="10%">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    Hora

                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th width="20%">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    Nombre

                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th width="35%">Descripción</th>
                                                        <th width="5%">Asist.</th>
                                                        <th width="5%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($patient_mcontrols as $mcontrols)
                                                        <tr>
                                                            <td class="py-3 align-middle">
                                                                {{ $mcontrols->id }}
                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                {{ \Carbon\Carbon::parse($mcontrols->date_medical_control)->format('d/m/Y') }}
                                                                <!--cambia formato fecha-->
                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                {{ $mcontrols->hour_medical_control }}
                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                {{ $mcontrols->name }} {{ $mcontrols->last_name }}
                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                {{ $mcontrols->description }}
                                                                @if(auth()->user()->role_id == '1')
                                                                <span class="users-list-date">
                                                                    @if($mcontrols->created_at == $mcontrols->updated_at)
                                                                        Creado por
                                                                    @else
                                                                        Modificado por
                                                                    @endif
                                                                    {{ current_infoUser($mcontrols->user_id)->name }} {{ current_infoUser($mcontrols->user_id)->last_name }}
                                                                </span>
                                                                @endif
                                                            </td>
                                                            <td class="py-3 align-middle" aling="right"
                                                                {{ $disabled }}>
                                                                <button type="submint" class="btn btn-xs text-muted"
                                                                    name="asistio" value="{{ $mcontrols->id }}"
                                                                    {{ $disabled }}>
                                                                    @if ($mcontrols->assistance == 1)
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input class="custom-control-input"
                                                                                type="checkbox"
                                                                                id="asistenciaCheckbox.{{ $mcontrols->id }}"
                                                                                checked {{ $disabled }}>
                                                                            <label
                                                                                for="asistenciaCheckbox.{{ $mcontrols->id }}"
                                                                                class="custom-control-label"></label>
                                                                        </div>
                                                                    @else
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input class="custom-control-input"
                                                                                type="checkbox"
                                                                                id="asistenciaCheckbox.{{ $mcontrols->id }}"
                                                                                {{ $disabled }}>
                                                                            <label
                                                                                for="asistenciaCheckbox.{{ $mcontrols->id }}"
                                                                                class="custom-control-label"></label>
                                                                        </div>
                                                                    @endif
                                                                </button>
                                                            </td>
                                                            <td class="text-right py-3 align-middle">
                                                                <a   href="/control/{{ $mcontrols->id }}/edit"
                                                                    title="Ver detalles" class="text-muted" >
                                                                    <i class="fas fa-angle-right"></i>
                                                                </a>
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

                                                {{ $patient_mcontrols->appends([
                                                'buscar' => $f_buscar,
                                                'asistencia' => $f_asistencia,
                                                'orden' => $f_orden,
                                                'fecha' => $f_fecha
                                                ])->links() }}

                                            @endif
                                        </div>
                                        <div class="col-sm-1" align="right">
                                            <!--<button type="submint" class="btn btn-block btn-outline-success btn-sm" " title="Exportar Excel" data-widget="" name="exportar" value="xls">
                                <i class="far fa-file-excel"></i> Excel
                              </button>-->
                                        </div>
                                        <div class="col-sm-1" align="right">
                                            @if ($total > 0)
                                                <button type="submint" class="btn btn-block btn-outline-danger btn-sm"
                                                    title="Exportar PDF" data-card-widget="" name="exportar" value="pdf" formtarget="_blank">
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
                        title: 'Control Creado con Exito.' // pasa el mensaje a Json
                    })
            });

            $('.swalDefaultSuccess').ready(function() {
                if (@json(Session::get('message')) == 'Modificado') //funciona automatico
                    Toast.fire({
                        type: 'success',
                        title: 'Control Modificado con Exito.' // pasa el mensaje a Json
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

