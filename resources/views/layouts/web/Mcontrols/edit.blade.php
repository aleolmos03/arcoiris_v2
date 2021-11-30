@extends('adminlte::page')

@section('title', 'Editar Control')

@section('title_table', 'Editar Control')

@section('content')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="far fa-edit"></i>&nbsp;
             Editar Control
        </h3>
        <div class="card-tools">

        <button type="button" class="btn btn-tool bg-gradient-success btn-sm">
            <a type="button" data-toggle="modal" data-target="#modal-delete">
                <i class="far fa-trash-alt"></i>
                &nbsp;Eliminar
            </a>
        </button>
            <button type="button" class="btn btn-tool">
                <a href="/controles" class="btn btn-tool bg-gradient-success btn-sm"><i class="fas fa-times"></i>
                </a>
            </button>
        </div>
    </div>
    <form method="POST" action="/control/{{$mcontrol->id}}/editar">
        {!!csrf_field()!!}
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
                                          <input name="date_medical_control" value="{{ $mcontrol->date_medical_control}}"  align="center" type="date" class="form-control" style="text-align:center;" placeholder="01-01-2020" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="far fa-calendar-alt"></i>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-4">
                                        Niño:
                                        <div class="input-group">
                                          <select name="patient_id" class="custom-select" disabled>
                                              <option selected=""></option>
                                            @foreach($patients as $patient)
                                              <option value="{{$patient->id}}" @if($patient->id==$mcontrol->patient_id) selected @endif>{{$patient->id}} - {{$patient->name}}, {{$patient->last_name}}</option>
                                            @endforeach
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
                                      <input name="hour_medical_control" value="{{$mcontrol->hour_medical_control}}"  align="center" type="time" class="form-control datetimepicker-input" style="text-align:center;" data-target="#timepicker"  placeholder="10:00">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="far fa-clock"></i>
                                        </span>
                                      </div>
                                </div>
                            </div>
                            <div class="col-sm-9">

                                Descripción
                                <input  name="description" value="{{ $mcontrol->description }}" type="text" class="form-control" placeholder="Descripción...." required>
                              </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
       <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-block btn-primary btn-sm"><i class="fas fa-check"></i> Guardar</button>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </form>
</div>
<form method="POST" action="/control/{{$mcontrol->id}}/delete">
    {!!csrf_field()!!}
<!-- /.modal delete -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">
                    <i class="far fa-trash-alt"></i>
                    &nbsp;Eliminar Control
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <p>Esta a punto de Eliminar este control ¿seguro que desea realizar esta acción?
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn  btn-default btn-sm" data-dismiss="modal">Cancelar</button>

                <button type="submit" class="btn  btn-info btn-sm">
                    <i class="fas fa-check"></i> Si, eliminar
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</form>
@stop
