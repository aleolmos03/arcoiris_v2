@extends('adminlte::page')

@section('title', 'Listado')

@section('title_table', 'Listado')

@section('content')
    <form role="form">
        {!! csrf_field() !!}
        <div class="card card-red card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="far fa-file-alt"></i>&nbsp;
                    Listado
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
                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                                                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                                        <li class="nav-item">
                                                            <a class="nav-link form-group text-info btn-sm" href="#">
                                                                @if ($f_internado != '')<i class="fas fa-caret-right"></i> @endif
                                                                Internado:
                                                                <select onchange="this.form.submit()" name="internado"
                                                                    class="bg-light btn-sm" title="Internado">
                                                                    <option value="" @if ($f_internado == '') selected @endif>
                                                                        Todo
                                                                    </option>
                                                                    <option value="1" @if ($f_internado == '1') selected @endif>
                                                                        Si
                                                                    </option>
                                                                    <option value="2" @if ($f_internado == '2') selected @endif>
                                                                        No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                                                </div>
                                                <!-- SEARCH FORM -->
                                                <div class="input-group input-group"
                                                    title="Ingrese ID, DNI o Nombre">
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
                                            <span class="mailbox-read-time float-right">
                                                {{ $total }} Resultados
                                                &nbsp;&nbsp;&nbsp;
                                            </span>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">
                                                            ID
                                                        </th>
                                                        <th width="5%"></th>
                                                        <th width="10%">
                                                            DNI
                                                        </th>
                                                        <th width="20%">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    Nombre
                                                                    &nbsp
                                                                    <!--aqui va los filtros-->
                                                                    @if ($f_orden == '' || $f_orden == 'F_desc' || $f_orden == 'F_asc' || $f_orden == 'E_desc' || $f_orden == 'E_asc')
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
                                                        <th width="15%">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    Fecha Nac.
                                                                    &nbsp;
                                                                    <!--aqui va los filtros-->
                                                                    @if ($f_orden == '' || $f_orden == 'N_desc' || $f_orden == 'N_asc' || $f_orden == 'F_desc' || $f_orden == 'F_asc')
                                                                        <button type="submint" class="btn btn-xs text-muted"
                                                                            name="orden" value="E_desc">
                                                                            <i class="fas fa-sort-amount-down-alt"></i>
                                                                        </button>
                                                                    @endif
                                                                    @if ($f_orden == 'E_desc')
                                                                        <button type="submint" class="btn btn-xs text-info"
                                                                            name="orden" value="E_asc">
                                                                            <i class="fas fa-sort-amount-down-alt"></i>
                                                                        </button>
                                                                    @endif
                                                                    @if ($f_orden == 'E_asc')
                                                                        <button type="submint" class="btn btn-xs text-info"
                                                                            name="orden" value="E_desc">
                                                                            <i class="fas fa-sort-amount-up-alt"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th width="5%" title="Internado">
                                                            <i class="fas fa-bed"></i></th>
                                                        <th width="15%">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    Cuidador
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th width="15%">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    Ingreso
                                                                    &nbsp;
                                                                    <!--aqui va los filtros-->
                                                                    @if ($f_orden == '' || $f_orden == 'N_desc' || $f_orden == 'N_asc' || $f_orden == 'E_desc' || $f_orden == 'E_asc')
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
                                                        <th width="5%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($patients as $patient)
                                                        <tr>
                                                            <td class="py-0 align-middle">
                                                                {{ $patient->id }}
                                                            </td>
                                                            <td class="align-middle">
                                                                <img src="{!! asset($patient->file) !!}"
                                                                    class="direct-chat-img" alt="message user image">
                                                                <div class="align-left">
                                                                    @if ($patient->created_at > now()->subDay(15) && !$patient->end_treatment)
                                                                        <!--el cartel de NUEVO SI INGRESO DENTORO DE LOS 20 DIAS-->
                                                                        <span class="badge badge-info">
                                                                            Nuevo
                                                                        </span>
                                                                    @endif
                                                                    @if ($patient->end_treatment)
                                                                        <!--el cartel de NUEVO SI INGRESO DENTORO DE LOS 20 DIAS-->
                                                                        <span class="badge badge-warning">
                                                                            Inactivo
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="py-0 align-middle">
                                                                {{ $patient->DNI }}
                                                            </td>
                                                            <td class="py-0 align-middle">
                                                                {{ $patient->name }}
                                                                {{ $patient->last_name }}
                                                            </td>
                                                            <td class="py-0 align-middle" title="{{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} años">
                                                                {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y') }}
                                                            </td>
                                                            <td class="py-0 align-middle">
                                                                @if ($patient->internship == 1)
                                                                    Si
                                                                @else
                                                                    No
                                                                @endif
                                                            </td>
                                                            <td class="py-0 align-middle">
                                                                {{ $patient->fname }}
                                                                {{ $patient->flast_name }}
                                                                <br>
                                                                <strong>Cel:</strong>&nbsp;{{ $patient->fmobile }}
                                                            </td>
                                                            <td class="py-0 align-middle">
                                                                {{ \Carbon\Carbon::parse($patient->created_at)->format('d/m/Y') }}
                                                            </td>
                                                            <td class="text-right py-0 align-middle">
                                                                <a href="/datos/ninio/{{ $patient->id }}"
                                                                    title="Ver detalles" class="text-muted">
                                                                    <i class="fas fa-angle-right"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @if ($total == 0)
                                                <h5 class="py-3 align-middle" align="center">
                                                    No se encontraron registros
                                                </h5>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10">
                                            @if ($exportar != 'pdf' && $exportar != 'xls')
                                                {{ $patients->appends([
                                                    'buscar' => $f_buscar,
                                                    'orden' => $f_orden,
                                                    'internado' => $f_internado,
                                                    'estado' => $f_estado
                                                    ])->links() }}
                                            @endif
                                        </div>
                                        <div class="col-sm-1" align="right"></div>
     </form>
                                    @if ($total > 0)
                                        <div class="col-sm-1" align="right">
                                            <form method="POST" action="/datos/pdf/
                                            @if ($f_estado) {{ $f_estado }}@else N0 @endif/
                                            @if ($f_internado){{ $f_internado }}@else N0 @endif/
                                            @if ($f_orden){{ $f_orden }}@else N0 @endif/
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@stop
