@extends('adminlte::page')

@section('title', 'Controles')

@section('title_table', 'Controles')

@section('content')
    <form role="form">
        {!! csrf_field() !!}
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="far fa-calendar-check"></i>&nbsp;
                    Participantes del Evento
                </h3>
                <div class="card-tools"><button type="button" class="btn btn-tool">
                        <a href="{{ $url_anterior }}" class="btn btn-tool bg-gradient-teal btn-sm"><i
                                class="fas fa-times"></i>
                        </a>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="callout callout-info">
                    <h5>
                        {{ \Carbon\Carbon::parse($event->date_event)->format('d/m/Y H:i') }}
                        hs.
                        - {{ $event->title }}
                        - Capcidad Máxima {{ $event->maximum_space }}.
                    </h5>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card card-outline">
                                        <div class="card-header-light">
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                                                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                                        <li class="nav-item ">

                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link form-group text-info btn-sm" href="#">
                                                                Rol:
                                                                <select onchange="this.form.submit()" name="rol"
                                                                    class="bg-light btn-sm" title="Rol">
                                                                    <option value="" @if ($f_rol == '') selected @endif>
                                                                        Todo
                                                                    </option>
                                                                    @foreach (current_roles() as $rol)
                                                                        <option value="{{ $rol->id }}" @if ($rol->id == $f_rol) selected @endif>
                                                                            {{ $rol->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link form-group text-info btn-sm" href="#">
                                                                Asistencia:
                                                                <select onchange="this.form.submit()" name="asistencia"
                                                                    class="bg-light btn-sm">
                                                                    <option value='' @if ($f_asistencia == '') selected @endif>Todo</option>
                                                                    <option value="1" @if ($f_asistencia == '1') selected @endif>Si</option>
                                                                    <option value="2" @if ($f_asistencia == '2') selected @endif>No</option>
                                                                </select>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                </div>
                                                <div class="input-group input-group-sm">

                                                    @if ($f_asistencia == '1' && $total > 0)
                                                        <span class="input-group-append">
                                                            <a href="" type="button">
                                                                <button name="todos" onclick="this.form.submit()"
                                                                    type="submit"
                                                                    class="btn btn-block bg-gradient-navy btn-sm"
                                                                    title="Quitar Todos" value="2">
                                                                    <i class="fas fa-minus"></i> Quitar Todos
                                                                </button>
                                                            </a>
                                                        </span>

                                                    @endif
                                                    @if ($f_asistencia == '2' && $total > 0)
                                                        <span class="input-group-append">
                                                            <a href="" type="button">
                                                                <button name="todos" onclick="this.form.submit()"
                                                                    type="submit" class="btn btn-block bg-info btn-sm"
                                                                    title="Agregar Todos" value="1">
                                                                    <i class="fas fa-plus"></i> Agregar Todos
                                                                </button>
                                                            </a>
                                                        </span>
                                                    @endif
                                                </div>
                                                <!-- SEARCH FORM -->
                                                <div class="input-group input-group"
                                                    title="Ingrese Nombre, DNI o ID del niño">
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
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">
                                                            ID
                                                        </th>
                                                        <th width="5%"></th>
                                                        <th width="30%">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    Nombre
                                                                    &nbsp
                                                                    <!--aqui va los filtros-->
                                                                    @if ($f_orden == '' || $f_orden == 'F_desc' || $f_orden == 'F_asc')
                                                                        <button type="submint" class="btn btn-xs text-muted"
                                                                            name="orden" value="N_desc">
                                                                            <i class="fas fa-sort-amount-down-alt"></i>
                                                                        </button>
                                                                    @endif
                                                                    @if ($f_orden == 'N_desc')
                                                                        <button type="submint" class="btn btn-xs text-info"
                                                                            name="orden" value="N_asc">
                                                                            <i class="fas fa-sort-amount-down-alt"></i>
                                                                        </button>
                                                                    @endif
                                                                    @if ($f_orden == 'N_asc')
                                                                        <button type="submint" class="btn btn-xs text-info"
                                                                            name="orden" value="N_desc">
                                                                            <i class="fas fa-sort-amount-up-alt"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th width="10%">
                                                            Contacto
                                                        </th>
                                                        <th width="10%">
                                                            Rol
                                                        </th>
                                                        <th width="20%">
                                                            <div class="row">
                                                                <div class="col-sm-10">
                                                                    Localidad
                                                                    &nbsp
                                                                    <!--aqui va los filtros-->
                                                                    @if ($f_orden == '' || $f_orden == 'N_desc' || $f_orden == 'N_asc')
                                                                        <button type="submint" class="btn btn-xs text-muted"
                                                                            name="orden" value="F_desc">
                                                                            <i class="fas fa-sort-amount-down-alt"></i>
                                                                        </button>
                                                                    @endif
                                                                    @if ($f_orden == 'F_desc')
                                                                        <button type="submint" class="btn btn-xs text-info"
                                                                            name="orden" value="F_asc">
                                                                            <i class="fas fa-sort-amount-down-alt"></i>
                                                                        </button>
                                                                    @endif
                                                                    @if ($f_orden == 'F_asc')
                                                                        <button type="submint" class="btn btn-xs text-info"
                                                                            name="orden" value="F_desc">
                                                                            <i class="fas fa-sort-amount-up-alt"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th width="10%" class="align-lefth">Asist. &nbsp

                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($event_users as $event_user)
                                                        <tr>
                                                            <td class="py-3 align-middle">
                                                                {{ $event_user->id }}
                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                @if ($event_user->file)
                                                                    <img src="{!! asset($event_user->file) !!}"
                                                                        class="direct-chat-img" alt="message user image">
                                                                @else
                                                                    <img class="direct-chat-img"
                                                                        src="{!! asset('vendor/adminlte/dist/img/User_grey.png') !!}"
                                                                        alt="message user image">
                                                                @endif
                                                                <div class="align-left">
                                                                    @if ($event_user->created_at > now()->subDay(15) && !$event_user->end_activitiest)
                                                                        <!--el cartel de NUEVO SI INGRESO DENTORO DE LOS 20 DIAS-->
                                                                        <span class="badge badge-info">
                                                                            Nuevo
                                                                        </span>
                                                                    @endif
                                                                    @if ($event_user->end_activitiest)
                                                                        <!--el cartel de NUEVO SI INGRESO DENTORO DE LOS 20 DIAS-->
                                                                        <span class="badge badge-warning">
                                                                            Inactivo
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                {{ $event_user->name }} {{ $event_user->last_name }}
                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                <strong>Mail:&nbsp;</strong>{{ $event_user->email }}
                                                                <br>
                                                                <strong>Celular:&nbsp;</strong>
                                                                @if ($event_user->mobile)
                                                                    {{ $event_user->mobile }}
                                                                @else
                                                                    &#126;
                                                                @endif

                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                {{ $event_user->role_name }}
                                                            </td>
                                                            <td class="py-3 align-middle">
                                                                {{ $event_user->city }}, {{ $event_user->province }}
                                                            </td>
                                                            <td class="py-3 align-middle text-right">
                                                                @if (current_eventPersonId($event->id, $event_user->person_id) == 'si')
                                                                    <a href="{{ $url_anterior }}/cancel/{{ $event_user->person_id }}"
                                                                        type="button">

                                                                        <button type="button"
                                                                            class="btn btn-block bg-gradient-info btn-xs"
                                                                            title="Agregar al Evento">
                                                                            <i class="fas fa-check"></i>

                                                                        </button>
                                                                    </a>
                                                                @else
                                                                    <a href="{{ $url_anterior }}/ok/{{ $event_user->person_id }}"
                                                                        type="button">

                                                                        <button type="button"
                                                                            class="btn btn-block bg-gradient-info btn-xs text-info"
                                                                            title="Cancelar">

                                                                            <i class="fas fa-square-full"></i>
                                                                        </button>

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

                                            {{ $event_users->appends([
                                                'buscar' => $f_buscar,
                                                'asistencia' => $f_asistencia,
                                                'orden' => $f_orden,
                                                'rol' => $f_rol,
                                                'todos' => $f_todos
                                                ])->links() }}

                                        </div>
                                        <div class="col-sm-1" align="right">
                                            <!--<button type="submint" class="btn btn-block btn-outline-success btn-sm" " title="Exportar Excel" data-widget="" name="exportar" value="xls">
                                        <i class="far fa-file-excel"></i> Excel
                                      </button>-->
                                        </div>
                                        <div class="col-sm-1" align="right">

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
