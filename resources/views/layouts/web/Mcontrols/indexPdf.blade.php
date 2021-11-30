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
    background-color: #91FFC0;
    border: 1px solid #8FEFB8;
    margin: 10px;
    padding: 5px;
  }
  .ttable td {

    border: 1px solid #8FEFB8;
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
        <h3>{{$titulo}} del día {{ ucfirst(\Carbon\Carbon::parse($f_fecha)->settings(['locale' => 'es_ES',])->isoFormat('dddd'))}}</h3>
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
          <th width="15%">Fecha</th>
          <th width="10%">Hora</th>
          <th width="20%">Nombre</th>
          <th width="35%">Descripción</th>
          <th width="10%">Asist.</th>
        </tr>
      </thead>
      <tbody>

<tbody>
        @foreach($patient_mcontrols as $mcontrols)
          <tr>
            <td class="py-3 align-middle">
              {{ \Carbon\Carbon::parse($mcontrols->date_medical_control)->format('d/m/Y')}}   <!--cambia formato fecha-->
            </td>
            <td class="py-3 align-middle">
              {{ $mcontrols->hour_medical_control }}
            </td>
            <td class="py-3 align-middle">
              {{ $mcontrols->name }} {{ $mcontrols->last_name}}
            </td>
            <td class="py-3 align-middle">
              {{ $mcontrols->description }}
            </td>
            <td class="py-3 align-middle">
              @if($mcontrols->assistance== 1)
                SI
              @else
                NO
              @endif
            </td>

          </tr>
        @endforeach
      </tbody>
    </table>
  <!-- DivTable.com -->

</body>
</html>
