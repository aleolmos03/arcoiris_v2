@extends('adminlte::page')

@section('title', 'Nueva Donacion')

@section('title_table', 'Nueva Donacion')

@section('content')
  <div class="card card-yellow">
    <div class="card-header">
      <h3 class="card-title">
        <i class="far fa-star"></i>&nbsp;
        Nueva Donación</h3>
    </div>
    <form method="POST" action="{{url('donacion/crear')}}">
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
                        <input  value="{{ \Carbon\Carbon::Now()->format('Y-m-d')}}"
                        name="date_donation" align="center" type="date" class="form-control"
                        style="text-align:center;" placeholder="01-01-2020" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true"
                        required >
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
                        <select name="patient_id" class="custom-select" required>
                          <option selected=""></option>
                          @foreach($patients as $patient)
                            <option value="{{$patient->id}}">{{$patient->id}} - {{$patient->name}}, {{$patient->last_name}}</option>
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
                      Tipo
                      <select name="tdonation_id" class="form-control" required>
                        @foreach (current_tdonations() as $tdonation)
                            <option value="{{ $tdonation->id }}" @if ($tdonation->id == old('tdonation_id') ) selected @endif>
                                {{ $tdonation->name }}
                            </option>
                         @endforeach
                      </select>
                    </div>
                    <div class="col-sm-8">
                      Descripción
                      <input name="description" type="text" class="form-control"
                      placeholder="Descripción...." value="{{ old('description') }}" required>
                    </div>
                    <div name="quantity" class="col-sm-1">
                      Cantidad
                      <input name="quantity" align="right" type="number"
                      class="form-control" style="text-align:right;"
                      placeholder="00" value="{{ old('quantity') }}"
                      required>
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
            <button name="guardar" type="submit" class="btn btn-block btn-primary btn-sm" value='1'>
              <i class="fas fa-check"></i> Guardar
            </button>
          </div>
          <div class="col-sm-4"></div>
        </div>
      </div>
    </form>
  </div>
@stop
