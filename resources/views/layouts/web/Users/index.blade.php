@extends('adminlte::page')

@section('title', 'Usuarios')

@section('title_table', 'Usuarios')

@section('content')
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-users"></i>&nbsp; Usuarios
            </h3>
        </div>
        <form role="form">
            <div class="card-body">
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
                                                            <a class="nav-link form-group text-info btn-sm" href="#">
                                                                @if ($f_tblood != '')<i
                                                                        class="fas fa-caret-right"></i> @endif
                                                                Grupo (RH):
                                                                <select onchange="this.form.submit()" name="tblood"
                                                                    class="bg-light btn-sm" title="Grupo Sanguíneo (Rh)">
                                                                    <option value="" @if ($f_tblood == '') selected @endif>
                                                                        Todo
                                                                    </option>
                                                                    @foreach (current_tbloods() as $tblood)
                                                                        <option value="{{ $tblood->id }}" @if ($tblood->id == $f_tblood) selected @endif>
                                                                            {{ $tblood->name }}&nbsp;&nbsp;&nbsp;
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link form-group text-info btn-sm" href="#">
                                                                @if ($f_rol != '')<i
                                                                        class="fas fa-caret-right"></i> @endif
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
                                                                @if ($f_estado != '')<i
                                                                        class="fas fa-caret-right"></i> @endif
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
                                                </div>
                                                <!-- SEARCH FORM -->
                                                <div class="input-group input-group" title="Ingrese ID, DNI o Nombre">
                                                    <input name="buscar" class="form-control form-control-navbar-light"
                                                        type="search" placeholder="Buscar" aria-label="Search">
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
                                        </div>
                                        <div class="bg-light mailbox-read-info p-0">
                                            <span class="mailbox-read-time float-right">{{ $total }} Resultados
                                                &nbsp;&nbsp;&nbsp;</span>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">
                                                            Nº
                                                        </th>
                                                        <th width="5%"></th>
                                                        <th width="20%">
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
                                                        <th width="35%">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    Contacto
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th width="5%" title="Grupo Sanguíneo (RH)">
                                                            <i class="fas fa-tint"></i>
                                                        </th>
                                                        <th width="10%" title="Rol">
                                                            Rol
                                                        </th>
                                                        <th width="15%" title="Inicio Voluntariado">
                                                            <div class="row">
                                                                <div class="col-sm-10">
                                                                    Ingreso
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
                                                        @if( auth()->user()->role_id != 3)
                                                        <th width="5%"></th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($person_users as $person)
                                                        <tr>
                                                            <td class="py-0 align-middle">
                                                                {{ str_pad($person->id, 6, "0", STR_PAD_LEFT) }}
                                                            </td>
                                                            <td class="align-middle">
                                                                @if ($person->file)
                                                                    <img src="{!! asset($person->file) !!}"
                                                                        class="direct-chat-img" alt="message user image">
                                                                @else
                                                                    <img class="direct-chat-img"
                                                                        src="{!! asset('vendor/adminlte/dist/img/User_grey.png') !!}"
                                                                        alt="message user image">
                                                                @endif
                                                                <div class="align-left">
                                                                    @if ($person->created_at > now()->subDay(15) && !$person->end_activitiest)
                                                                        <!--el cartel de NUEVO SI INGRESO DENTORO DE LOS 20 DIAS-->
                                                                        <span class="badge badge-info">
                                                                            Nuevo
                                                                        </span>
                                                                    @endif

                                                                    @if ($person->end_activitiest)
                                                                        <!--el cartel de NUEVO SI INGRESO DENTORO DE LOS 20 DIAS-->
                                                                        <span class="badge badge-warning">
                                                                            Inactivo
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="py-0 align-middle">
                                                                {{ $person->name }} {{ $person->last_name }}
                                                            </td>
                                                            <td class="py-0 align-middle">
                                                                <strong>Mail:&nbsp;</strong>{{ $person->email }}
                                                                <br>
                                                                <strong>Celular:&nbsp;</strong>
                                                                @if ($person->mobile1)
                                                                    {{ $person->mobile1 }}
                                                                @else
                                                                    &#126;
                                                                @endif
                                                                <br>
                                                                @if( auth()->user()->role_id != 3)
                                                                <strong>Dirección:&nbsp;</strong><em>{{ $person->address }}</em>,
                                                                {{ $person->city }}, {{ $person->province }}
                                                                @else
                                                                <strong>Dirección:&nbsp;</strong>
                                                                {{ $person->city }}, {{ $person->province }}
                                                                @endif
                                                            </td>
                                                            <td class="py-0 align-middle" align="lefth">
                                                                {{ $person->tblood_name }}
                                                            </td>
                                                            <td class="py-0 align-middle">
                                                                {{ $person->role_name }}
                                                            </td>
                                                            <td class="py-0 align-middle">
                                                                {{ \Carbon\Carbon::parse($person->start_activitiest)->format('d/m/Y') }}
                                                                <!--cambia formato fecha-->
                                                            </td>
                                                            @if( auth()->user()->role_id != 3)
                                                            <td class="text-right py-0 align-middle">
                                                                <a href="/usuario/{{ $person->id }}"
                                                                    title="Ver detalles" class="text-muted">
                                                                    <i class="fas fa-angle-right"></i>
                                                                </a>
                                                            </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @if ($total == 0)
                                                <h5 class="py-3 align-middle" align="center">No se encontraron registros
                                                </h5>
                                            @endif
                                        </div>
                                        @if ($total > 1)
                                            <div class="card-footer">
                                                <div class="btn">
                                                    @if ($exportar != 'pdf' && $exportar != 'xls')
                                                        {{ $person_users->appends([
                                                        'buscar' => $f_buscar,
                                                        'tblood' => $f_tblood,
                                                        'orden' => $f_orden,
                                                        'rol' => $f_rol,
                                                        'estado' => $f_estado,
                                                    ])->links() }}
                                                    @endif
                                                </div>

        </form>
        @if( auth()->user()->role_id != 3)
        <div class="btn float-right">
            <form method="POST" action="/usuarios/pdf/
                            @if ($f_estado) {{ $f_estado }}@else N0 @endif/
                            @if ($f_rol){{ $f_rol }}@else N0 @endif/
                            @if ($f_orden){{ $f_orden }}@else N0 @endif/
                            @if ($f_tblood){{ $f_tblood }}@else N0 @endif/
                            @if ($f_buscar){{ $f_buscar }}@else N0 @endif
                            ">
                {!! csrf_field() !!}
                <button type="submit" class="btn btn-block btn-outline-danger btn-sm-2" formtarget="_blank">
                    <i class="far fa-file-pdf"></i> Pdf
                </button>
            </form>
        </div>
        @endif
    </div>
    @endif
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@stop
