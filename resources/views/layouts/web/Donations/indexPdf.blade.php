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
        <th width="10%">
          Fecha
        </th>
        <th width="25%">
          Nombre
        </th>
        <th width="10%">
          Tipo
        </th>
        <th width="45%">
          Descripción
        </th>
        <th width="5%">
          Cant.
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach($patient_donations as $donation)
        <tr>
          <td class="py-3 align-middle">
            {{ \Carbon\Carbon::parse($donation->fecha)->format('d/m/Y')}} <!--cambia formato fecha-->
          </td>
          <td class="py-3 align-middle">
            {{ $donation->nombre }} {{ $donation->apellido }}
          </td>
          <td class="py-3 align-middle">
            {{ $donation->tipo }}
          </td>
          <td class="py-3 align-middle" align="left">
            {{ $donation->descripcion }}
          </td>
          <td class="text-right py-3 align-middle">
            {{ $donation->cantidad }}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <!-- DivTable.com -->

</body>
</html>
