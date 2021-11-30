@extends('adminlte::page')

@section('title', 'Info. Control')

@section('title_table', 'Info. Control')

@section('content')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
           <i class="fas fa-ellipsis-v"></i>&nbsp; Información Control
        </h3>
        <div class="card-tools">
        @if(current_person()->role != "Voluntario")

            <button type="button" class="btn btn-tool" title="Editar">
             <a href="" type="button" class="btn btn-tool bg-success btn-sm"><i class="far fa-edit"></i>Editar</a>
           </button>

           <div class="btn-group">
            <button type="button" class="btn btn-tool bg-success dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
              <a type="button" class="btn btn-block bg-gradient-danger btn-sm" data-toggle="modal" data-target="#modal-delete">
                <i class="far fa-trash-alt"></i> Eliminar
              </a>
            </div>
          </div>
      @endif
      <button type="button" class="btn btn-tool">
        <a href="" class="btn btn-tool bg-gradient-success btn-sm"><i class="fas fa-times"></i>
        </a>
      </button>
    </div>
    </div>
    <form role="form">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                           <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        Fecha
                                        <div class="input-group">
                                            <input align="center" type="date" class="form-control" style="text-align:center;" placeholder="01-01-2020" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true" value="{{ \Carbon\Carbon::Now()->format('Y-m-d')}}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-4">
                                            Nombre y Apellido
                                            <div class="input-group">
                                                <select class="custom-select" id="inputGroupSelect01">
                                                    <option selected=""> </option>
                                                    <option value="1">John Doe</option>
                                                    <option value="2">Victoria Doe</option>
                                                    <option value="3">Ana Span</option>
                                                    <option value="3">Alex Doe</option>
                                                </select>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-search"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                            <div class="row">

                                <div class="col-sm-3">
                                    Hora
                                    <div class="input-group">
                                       <input align="center" type="time" class="form-control datetimepicker-input" style="text-align:center;" data-target="#timepicker"  placeholder="10:00">
                                       <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9">

                                Descripción
                                <input type="text" class="form-control" placeholder="Descripción....">
                            </div>
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
    <button type="submint" class="btn btn-block btn-outline-danger btn-sm" title="Exportar PDF" data-card-widget="" name="exportar" value="pdf" formtarget="_blank">
      <i class="far fa-file-pdf"></i> Pdf
    </button>
  </div>
</div>
    </form>
</div>
@stop
