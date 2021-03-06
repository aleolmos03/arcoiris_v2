@extends('adminlte::page')

@section('title', 'Donaciones')

@section('title_table', 'Donaciones')

@section('content')
  <form role="form">
    {!!csrf_field()!!}
    <div class="card card-yellow card-outline">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-gift"></i>&nbsp;
          Donaciones
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
                          <a class="dropdown-item" href="{{ url("/donaciones/Fecha") }}">Fecha</a>
                          <a class="dropdown-item" href="{{ url("/donaciones/Rango") }}">Rango</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ url("/donaciones/Todo") }}">Todo</a>
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
                            <li class="nav-item">
                              <a class="nav-link form-group text-info btn-sm" href="#">
                                @if ($f_tdonation != "0")<i class="fas fa-caret-right"></i> @endif
                                Tipo:
                                <select onchange="this.form.submit()" name="tdonation" class="bg-light btn-sm">
                                  <option value="0" @if($f_tdonation == "0") selected @endif>
                                    Todo
                                  </option>
                                  @foreach (current_tdonations() as $tdonation)
                                  <option value="{{ $tdonation->id }}" @if($tdonation->id == $f_tdonation) selected @endif> {{ $tdonation->name }}
                                  </option>
                                @endforeach
                                </select>
                              </a>
                            </li>
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
                            <th width="10%">
                              <div class="row">
                                <div class="col-sm-12">
                                  Fecha
                                </div>
                              </div>
                            </th>
                            <th width="25%">
                              <div class="row">
                                <div class="col-sm-12">
                                  Nombre
                                </div>
                              </div>
                            </th>
                            <th width="10%">Tipo</th>
                            <th width="45%">Descripci??n</th>
                            <th width="5%">Cant.</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($patient_donations as $donation)
                            <tr>
                              <td class="py-3 align-middle">
                                {{ \Carbon\Carbon::parse($donation->fecha)->format('d/m/Y')}}  <!--cambia formato fecha-->
                              </td>
                              <td class="py-3 align-middle">
                                {{ $donation->nombre }} {{ $donation->apellido }}
                              </td>
                              <td class="py-3 align-middle">
                                {{ $donation->tipo }}
                              </td>
                              <td class="py-3 align-middle">
                                {{ $donation->descripcion }}

                                @if(auth()->user()->role_id == '1')
                                <span class="users-list-date">
                                    Creado por
                                    {{ current_infoUser($donation->user_id)->name }} {{ current_infoUser($donation->user_id)->last_name }}
                                </span>
                                @endif
                              </td>
                              <td class="text-center py-3 align-middle">
                                {{ $donation->cantidad }}
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
                      <!--//$patient_donations->render() }}-->
                      @if($exportar != 'pdf' && $exportar != 'xls')
                        {{ $patient_donations->appends([
                            'buscar' => $f_buscar,
                            'tdonation' => $f_tdonation,
                            'orden' => $f_orden,
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
                      <button type="submint" class="btn btn-block btn-outline-danger btn-sm" title="Exportar PDF" data-card-widget="" name="exportar" value="pdf" formtarget="_blank">
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
                        title: 'Donaci??n Creada con Exito.' // pasa el mensaje a Json
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
