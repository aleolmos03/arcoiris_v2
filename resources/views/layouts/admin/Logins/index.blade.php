@extends('adminlte::page')

@section('title', 'Historial')

@section('title_table', 'Historial')

@section('content')
  <form role="form">
    {!!csrf_field()!!}
    <div class="card card-dark card-outline">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-history"></i>
          Historial de Inicios de Sesión
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
                        <a class="navbar-brand dropdown-toggle btn-sm text-primary" href="#" id="navbarDropdownRango" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{$filtro}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ url("/historial/Fecha") }}">Fecha</a>
                          <a class="dropdown-item" href="{{ url("/historial/Rango") }}">Rango</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ url("/historial/Todo") }}">Todo</a>
                        </div>
                      </nav>
                      <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                          <ul class="navbar-nav mr-auto form-group">
                            @if($filtro=="Fecha")
                              <li class="nav-item ">
                                <a class="nav-link form-group text-info btn-sm" href="#">
                                  Fecha:
                                  <input onchange="this.form.submit()" name="fecha" align="center" type="date" class="btn-sm btn-default " placeholder="01-01-2020" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true" title="Seleccionar Fecha" value="{{$f_fecha}}">
                                </a>
                              </li>
                            @endif
                            @if($filtro=="Rango")
                              <li class="nav-item">
                                <a class="nav-link text-info btn-sm">
                                  Desde:
                                  <input name="desde" align="center" type="date" class="btn-sm btn-default" style="text-align:center;" placeholder="01-01-2020" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true" title="Seleccionar Fecha" value="{{$f_desde}}">
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link text-info btn-sm">
                                  Hasta:
                                  <input onchange="this.form.submit()" name="hasta" align="center" type="date" class="btn-sm btn-default" placeholder="01-01-2020" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true" title="Seleccionar Fecha" value="{{$f_hasta}}">
                                </a>
                              </li>
                            @endif
                          </ul>
                        </div>
                        <!-- SEARCH FORM -->
                        <div class="input-group input-group" title="Ingrese ID, DNI o Nombre">
                          <input name="buscar" class="form-control form-control-navbar-light" type="search" placeholder="Buscar" aria-label="Search">
                          <div class="input-group-append">
                            <button class="btn btn-navbar " type="submit">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                          &nbsp;
                          <button class="navbar-toggler btn-xs" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                        </div>
                      </nav>
                    </div>
                    <div class="bg-light mailbox-read-info p-0">
                      <span class="mailbox-read-time float-right">
                        {{ $total }} Resultados &nbsp;&nbsp;&nbsp;
                      </span>
                    </div>
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th width="25%">Fecha</th>
                            <th width="25%">Usuario</th>
                            <th width="25%">Nombre</th>
                            <th width="25%">Rol</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($history as $his)
                            <tr>
                                <td class="py-3 align-middle">
                                    {{ \Carbon\Carbon::parse($his->created_at)->format('d/m/Y H:i:s') }} hs. 
                                </td>
                                <td class="py-3 align-middle">
                                  {{ $his->email }}
                                </td>
                                <td class="py-3 align-middle">
                                    {{ $his->name }}, {{ $his->last_name }}
                                </td>
                                <td class="py-3 align-middle">
                                    {{ $his->role_name }}
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @if($total==0)
                        <h5 class="py-3 align-middle" align="center">No se encontraron registros</h5>
                      @endif
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-10">
                      <!--//$$history->render() }}-->
                      @if($exportar != 'pdf' && $exportar != 'xls')
                      {{  $history->appends([
                        'buscar' => $f_buscar,
                        'fecha' => $f_fecha,
                        'desde' => $f_desde,
                        'hasta' => $f_hasta
                        ])->links() }}
                      @endif
                    </div>
                    <div class="col-sm-1" align="right">
                      <!--<button type="submint" class="btn btn-block btn-outline-success btn-sm" " title="Exportar Excel" data-widget="" name="exportar" value="xls">
                      <i class="far fa-file-excel"></i> Excel
                    </button>-->
                  </div>
                  <div class="col-sm-1" align="right">
                    @if($total > 0)
                      <!--<button type="submint" class="btn btn-block btn-outline-danger btn-sm" title="Exportar PDF" data-card-widget="" name="exportar" value="pdf" formtarget="_blank">
                        <i class="far fa-file-pdf"></i> Pdf
                      </button>-->
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
      if(@json(Session::get('message')))//funciona automatico
      Toast.fire({
        type: 'success',
        title: '@json(Session::get('message'))'// pasa el mensaje a Json
      })
    });
  });

  </script>

@stop
