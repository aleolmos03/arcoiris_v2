<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Exportar PDF</title>
  <style>
  .contenido{
    font-size: 11px;
  }
  .tg  {
    border-collapse:collapse;
    border-spacing:0;
  }
  .tg td{
    border-color:black;
    border-style:solid;
    border-width:1px;
    font-family:Arial, sans-serif;
    font-size:14px;
    overflow:hidden;padding:5px 10px;
    word-break:normal;
  }
  .tg th{
    border-color:black;
    border-style:solid;
    border-width:1px;
    font-family:Arial, sans-serif;
    font-size:14px;
    font-weight:normal;
    overflow:hidden;
    padding:5px 10px;
    word-break:normal;
  }
  .tg .tg-drgp{
    background-color:#c3e1e2;
    border-color:#ffffff;
    font-weight:bold;
    text-align:left;
    text-decoration:underline;
    vertical-align:top
  }
  .tg .tg-xyxu{
    background-color:#d1ffd1;
    border-color:#ffffff;
    font-weight:bold;
    text-align:left;
    vertical-align:bottom
  }
  .tg .tg-zv4m{
    border-color:#ffffff;
    text-align:left;
    vertical-align:top
  }
  .tg .tg-vkfz{
    background-color:#ffffff;
    border-color:#ffffff;
    font-family:Arial, Helvetica, sans-serif !important;;font-size:18px;
    font-weight:bold;text-align:left;vertical-align:middle
  }
  .tg .tg-d4j9{
    background-color:#ecf4ff;
    border-color:#ffffff;
    text-align:left;
    vertical-align:top
  }
  .tg .tg-v0mg{
    border-color:#ffffff;
    text-align:center;
    vertical-align:middle
  }
  .tg .tg-n0of{
    border-color:#ffffff;
    font-weight:bold;
    text-align:left;
    vertical-align:bottom
  }
  .tg .tg-5k2w{
    background-color:#ffffc7;
    border-color:#ffffff;
    text-align:right;
    vertical-align:top
  }
  .tg .tg-7drl{
    background-color:#edffed;
    border-color:#ffffff;
    text-align:left;
    vertical-align:bottom
  }
  .tg .tg-sd0f{
    background-color:#deeafa;
    border-color:#ffffff;
    text-align:left;
    vertical-align:top
  }
  .tg .tg-ofj5{
    background-color:#ffffc7;
    border-color:#ffffff;
    text-align:right;
    vertical-align:top
  }
  .tg .tg-4cw3{
    background-color:#cbcefb;
    border-color:#ffffff;
    font-weight:bold;
    text-align:left;
    text-decoration:underline;
    vertical-align:top
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
  <!-- Encabezado -->
  <table border width="100%" align="center" cellspacing="8">
    <tr>
      <td width="10%" valign="bottom">
        <img  src="vendor/adminlte/dist/img/SGI_arcoiris.jpg" width="120" height="100" />
      </td>
      <td width="55%" align="center" valign="bottom">
        <h3>Información Voluntario
          <br>
          #{{ $voluntary->id }}
        </h3>
      </td>
      <td width="35%" align="right" valign="bottom" >
        <p class="contenido">
          {{ now()->format('d/m/Y H:i:s') }}
        </p>
        <p class="contenido">
          Usuario: {{ App\Models\User::user_name()  }} {{ App\Models\User::user_last_name() }}
        </p>
      </td>
    </tr>
  </table>
  <hr>
  <!-- info voluntario -->
  <table class="tg" width="100%">
    <thead>
      <tr>
        <th class="tg-v0mg" rowspan="4"width="25%">
            <img src="vendor/adminlte/dist/img/userPDF.png"  width="155" height="155">
        </th>
        <th class="tg-vkfz">
          DNI: {{$voluntary->DNI}}
        </th>
        <th class="tg-n0of"></th>
        @if($voluntary->end_activitiest)
          <th class="tg-ofj5">
            <small>Fin Voluntariado:</small>
            <br>
            <strong>
              {{ \Carbon\Carbon::parse($voluntary->end_activitiest)->format('d/m/Y')}}
            </strong>
          </th>
        @endif
      </tr>
      <tr>
        <td class="tg-zv4m">
          <small>
            Nombres:
          </small>
          <br>
          <strong>
            {{ $voluntary->name }}
          </strong>
        </td>
        <td class="tg-zv4m">
          <small>
            Apelldios:
          </small>
          <br>
          <strong>
            {{ $voluntary->last_name }}
          </strong>
        </td>
        <td class="tg-zv4m">
          <small>
            Apodo:
          </small>
          <br>
          <strong>
            {{ $voluntary->nick_name }}
          </strong>
        </td>
      </tr>
      <tr>
        <td class="tg-zv4m">
          <small>
            Fecha Nac.:
          </small>
          <br>
          <strong>
            {{ \Carbon\Carbon::parse($voluntary->date_of_birth)->format('d/m/Y')}}   <!--cambia formato fecha-->
          </strong>
        </td>
        <td class="tg-zv4m">
          <small>
            Sexo:
          </small>
          <br>
          <strong>
            @if ($voluntary->sex == 'M')
                    Masculino
                @endif
                @if ($voluntary->sex == 'F')
                    Femenino
                @endif
          </strong>
        </td>
        <td class="tg-zv4m">
          <small>
            Grupo (RH):
          </small>
          <br>
          <strong>
            {{$voluntary->tblood_name}}
          </strong>
        </td>
      </tr>
      <tr>
        <td class="tg-zv4m" colspan="3">
          <small>
            Dirección:
          </small>
          <br>
          <strong>
            {{ $voluntary->address }},
            {{ $voluntary->city_name }},
            {{ $voluntary->province_name }}
          </strong>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="tg-xyxu">
          <span style="text-decoration:underline">
            Sistema:
          </span>
        </td>
        <td class="tg-drgp" colspan="3">
          Información de Contacto:
        </td>
      </tr>
      <tr>
        <td class="tg-7drl">
          Rol: <b>{{$voluntary->role_name}}</b>
        </td>
        <td class="tg-sd0f" colspan="3">
          Mail: {{$voluntary->email}}
        </td>
      </tr>
      <tr>
        <td class="tg-7drl">
          Inicio Voluntariado:

          <br>
          @if(\Carbon\Carbon::parse($voluntary->start_activitiest)->format('d/m/Y'))
          {{ \Carbon\Carbon::parse($voluntary->start_activitiest)->format('d/m/Y') }}
          @else
          -
          @endif
        </td>
        <td class="tg-sd0f">
          <small>
            Celular1:
          </small>
          <br>
          @if($voluntary->mobile1)
          {{$voluntary->mobile1}}
          @else
          -
          @endif
        </td>
        <td class="tg-sd0f" colspan="2"><small>
          Celular2:
        </small>
        <br>
        @if($voluntary->mobile2)
          {{$voluntary->mobile2}}
          @else
          -
          @endif
      </td>
    </tr>
    <tr>
      <td class="tg-7drl">
        Ultimo acceso:
        <br>
        @if($voluntary->updated_at)
         {{ \Carbon\Carbon::parse($voluntary->updated_at)->format('d/m/Y H:i:s') }}
        @else
        -
        @endif
      </td>
      <td class="tg-sd0f">
        <small>
          Teléfono1:
        </small>
        <br>
        @if($voluntary->phone1)
        {{$voluntary->phone1}}
        @else
        -
        @endif
      </td>
      <td class="tg-sd0f" colspan="2">
        <small>
          Teléfono2:
        </small>
        <br>
        @if($voluntary->phone2)
        {{$voluntary->phone2}}
        @else
        -
        @endif
      </td>
    </tr>
    <tr>
      <td class="tg-4cw3" colspan="4">
        <span style="text-decoration:underline">Curriculum Vitae:</span>
      </td>
    </tr>
    <tr>
      <td class="tg-d4j9"><small>
        Ocupación:
      </small>
      <br>
      {{$voluntary->occupation}}
    </td>
    <td class="tg-d4j9" colspan="3">
      <small>
        Resumen CV:
      </small>
      <br>
      {{$voluntary->curriculum_vitae}}
    </td>
  </tr>
</tbody>
</table>

</body>
</html>
