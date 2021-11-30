@extends('adminlte::page')

@section('title', 'Nuevo Control')

@section('title_table', 'Nuevo Control')

@section('content')
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">
        <i class="far fa-check-circle"></i>&nbsp;
        Nuevo Control</h3>
    </div>
    <form method="POST" action="{{url('control/crear')}}">
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
                        <input name="date_medical_control" value="{{ \Carbon\Carbon::Now()->addDay(1)->format('Y-m-d')}}"  align="center" type="date" class="form-control" style="text-align:center;" placeholder="01-01-2020" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="true">
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
                      Hora
                      <div class="input-group">
                        <input value="{{ \Carbon\Carbon::Now()->format('H:i')}}" name="hour_medical_control" align="center" type="time" class="form-control datetimepicker-input" style="text-align:center;" data-target="#timepicker"  placeholder="10:00">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-clock"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-9">
                      Descripción
                      <input value="" name="description" type="text" class="form-control" placeholder="Descripción...." required>
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
  @stop

  @section('js')
    <script type="text/javascript">

  $(function() {
      const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 7000,
      timerProgressBar: true,
      didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
      });

       $('.swalDefaultSuccess').ready(function() {
        if(@json(Session::get('message')) == 'Existe')//funciona automatico
          Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ya existen registros con esta información',

                      })
        if(@json(Session::get('message')) == 'Falta')//funciona automatico
          Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Complete todos los campos para registrar el control',

                      })

    });
 });

</script>


@stop
