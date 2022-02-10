<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Exportar PDF</title>
  <style>
  .contenido{
    font-size: 11px;
  }
  .ttable{

    font-size: 12px;
    border: 1px solid #000;
    text-align: center;
    border-collapse: collapse;

  }
  .ttable th{
    background-color: #FFC107;
    border: 1px solid #FFC926;
    margin: 10px;
    padding: 5px;
  }
  .ttable td {

    border: 1px solid #FFC926;
    margin: 10px;
    padding: 5px;
  }

  .fixed {
    position: fixed;
    width: 100%;
    top: 80%;
  }
  body {
    margin: 5mm 8mm 5mm 8mm;
  }
  </style>
</head>
<body>
  <table border width="100%" align="center" cellspacing="8">
    <tr>
      <td width="10%" valign="bottom">
        <img  src="vendor/adminlte/dist/img/SGI_arcoiris.jpg" width="120" height="100" />
      </td>
      <td width="55%" align="center" valign="bottom">
        <h3>{{$titulo}}</h3>
        <p class="contenido">
          {{$total}} resultados
        </p>
      </td>
      <td width="35%" align="right" valign="bottom" >
        <p class="contenido">
          {{ now()->format('Y-m-d H:i:s') }}
        </p>
        <p class="contenido">
          Usuario: {{ current_dataUser()->name }} {{ current_dataUser()->last_name }}
        </p>
      </td>
    </tr>
  </table>
  <hr>
  <table class="ttable" cellspacing="8" width="100%">
    <thead>
        <tr>
            <th width="5%">Fecha</th>
            <th width="5%"></th>
            <th width="20%">Usuario</th>
            <th width="10%">rol</th>
            <th width="20%">Acción</th>
            <th width="5%">ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach($history as $his)
        <tr>
            <td class="py-3 align-middle">
                {{ \Carbon\Carbon::parse($his->created_at)->format('d/m/Y H:m:s')}}  <!--cambia formato fecha-->
            </td>
            <td class="py-3 align-middle">
                @if($his->file)
                <img src="{!! asset($his->file) !!}" class="direct-chat-img" alt="message user image">
              @else
                <img class="direct-chat-img" src="{!! asset("vendor/adminlte/dist/img/User_grey.png") !!}" alt="message user image">
              @endif
            </td>
            <td class="py-3 align-middle">
              {{ $his->name }} {{ $his->last_name }}
              <br>
              mail:  {{ $his->email }}
            </td>
            <td class="py-3 align-middle">
                {{ $his->role_name }}
              </td>
            <td class="py-3 align-middle">
                {{ $his->title }}
            </td>
            <td class="py-3 align-middle">
                {{ $his->id }}
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <!-- DivTable.com -->

</body>
</html>
