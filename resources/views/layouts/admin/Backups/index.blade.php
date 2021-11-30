@extends('adminlte::page')

@section('title', 'Sistema')

@section('title_table', 'Sistema')

@section('content')
<form method="POST" action="{{url('backups/crear')}}">
        {!!csrf_field()!!}
<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">Backups de Sistema</h3>
        <span class="direct-chat-timestamp-light float-right">{{$total}} resultados</span>
    </div>
        <div class="card-body">
            <div class="col-sm-12">
                <div class="form-group"><div class="row">
                        <div class="col-12">
                         <div class="card card card-outline">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="25%">Fecha</th>
                                            <th width="35%">Nombre</th>
                                            <!--<th width="5%">Tamaño</th>-->
                                            <th width="20%">Usuario</th>                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($backups as $backup)
                                        <tr>
                                            <td>{{ $backup->id }}</td>
                                            <td>{{ $backup->created_at }}</td>
                                            <td>{{ $backup->backup }}</td>
                                            <!--<td> $backup->size </td>-->
                                            <td>{{ $backup->name }}, {{ $backup->last_name }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-sm-8">
                    {!! $backups->appends(Request::only([]))->render() !!}
                </div>
                <div class="col-sm-2" align="right">
                    <!--<button type="button" class="btn btn-block bg-gradient-info btn-sm" data-toggle="modal" data-target="#Cargarbackup">
                        <i class="fas fa-upload"></i> Cargar
                    </button>-->
                </div>
                <div class="col-sm-2" align="right">
                    <button type="submit" class="btn btn-block bg-gradient-primary btn-sm">
                            <i class="fas fa-download"></i> Generar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
</div>
<!-- Modal -->
<div class="modal fade" id="Cargarbackup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5><i class="fas fa-upload"></i> Cargar Copia de Seguridad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="file" class="form-control-file" onchange="this.form.submit()" id="ImportBackup" accept=".sql" required>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-1">
                        <h5 class="modal-title text-warning"><i class="fas fa-exclamation-triangle"></i></h5>
                    </div><div class="col-sm-11">    Si continua con esta acción, se borrarán <strong>TODOS</strong> los datos de la base de datos y se reemplazaran por los datos del archivo seleccionado. Para confimar esta operacion haga clic en Continuar. Para salir, haga clic en Candelar    <!--<div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Entendido</label>
                        </div>-->
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn  btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                <a href="/sistema/restaurar" type="button" class="btn  btn-danger btn-sm">
                    Continuar
                </a>
        </div>
    </div>
</div>
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
