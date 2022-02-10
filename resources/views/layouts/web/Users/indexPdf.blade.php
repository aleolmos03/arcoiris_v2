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
    background-color: #98DFEA;
    border: 1px solid #A7E3ED;
    margin: 10px;
    padding: 5px;
  }
  .ttable td {
    border: 1px solid #A7E3ED;
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
            Usuario: {{ App\Models\User::user_name()  }} {{ App\Models\User::user_last_name() }}
        </p>
      </td>
    </tr>
  </table>
  <hr>
  <table class="ttable" cellspacing="8" width="100%">
    <thead>
      <tr>
        <th width="5%">
          ID
        </th>
        <th width="20%">
          Nombre
        </th>
        <th width="35%">
          Contacto
        </th>
        <th width="5%" title="Grupo Sanguíneo (RH)">
          Grupo (RH)
        </th>
        <th width="10%" title="Rol">
          Rol
        </th>
        <th width="15%" title="Fecha de inicio">
          Ingreso
        </th>

      </tr>
    </thead>
    <tbody>
      @foreach($person_users as $person)
        <tr>
          <td class="py-0 align-middle ">
            {{ str_pad($person->id, 6, "0", STR_PAD_LEFT) }}
          </td>
          <td class="py-0 align-middle">
            {{ $person->name }} {{ $person->last_name }}
          </td>
          <td class="py-0 align-middle" align="left">
            <strong>Mail:&nbsp;</strong>{{ $person->email }}
            <br>
            <strong>Celular:&nbsp;</strong>
            @if($person->mobile)
              {{ $person->mobile }}
            @else
              &#126;
            @endif
            <br>
            <strong>Dirección:&nbsp;</strong><em>{{ $person->address}}</em>, {{ $person->city}}, {{ $person->province}}
          </td>
          <td class="py-0 align-middle">
            {{ $person->tblood_name }}
          </td>
          <td class="py-0 align-middle">
            {{ $person->role_name }}

          </td>
          <td class="py-0 align-middle">
            {{ \Carbon\Carbon::parse($person->created_at)->format('d/m/Y')}}   <!--cambia formato fecha-->
            @if($person->end_activitiest)<!--el cartel de NUEVO SI INGRESO DENTORO DE LOS 20 DIAS-->
            <br><strong>(Inactivo)</strong>
            @endif
          </td>

        </tr>
      @endforeach
    </tbody>
  </table>
  <!-- DivTable.com -->

</body>
</html>
