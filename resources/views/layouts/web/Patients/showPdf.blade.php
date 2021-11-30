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

    font-size: 13px;
    border: 1px solid #000;
    text-align: center;
    border-collapse: collapse;

  }
  .ttable th{

    background-color: #c8cbff;
    border: 1px solid #BFCBDD;
    margin: 10px;
    padding: 5px;
  }
  .ttable td {
    background-color: #F8F9FF;
    border: 1px solid #BFCBDD;
    margin: 10px;
    padding: 5px;
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
    overflow:hidden;
    padding:5px 10px;
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
    background-color:#AED6F1;
    border-color:#ffffff;

    text-align:left;
    text-decoration:underline;
    vertical-align:top
  }
  .tg .tg-xyxu{
    background-color:#ABEBC6;
    border-color:#ffffff;

    text-align:left;
    vertical-align:bottom
  }
  .tg .tg-zv4m{
    border-color:#ffffff;
    text-align:left;
    vertical-align:top
  }
  .tg .tg-qj3y{
    border-color:#ffffff;
    font-family:Arial, Helvetica, sans-serif !important;;
    font-size:16px;
    font-weight:bold;
    text-align:left;
    vertical-align:middle
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
  .tg .tg-ofj5{
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
    background-color:#F5FAFD;
    border-color:#ffffff;
    text-align:left;
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
    {!! csrf_field() !!}
  <table border width="100%" align="center" cellspacing="8">
    <tr>
      <td width="10%" valign="bottom">
        <img  src="vendor/adminlte/dist/img/SGI_arcoiris.jpg" width="120" height="100" />
      </td>
      <td width="55%" align="center" valign="bottom">
        <h3>Información Niño <br> #{{ $patient->id }}</h3>
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
  <!-- info paciente -->
  <table class="tg" width="100%">
    <thead>
      <tr>
        <th class="tg-v0mg" rowspan="4" width="25%">
          <img src="vendor/adminlte/dist/img/userPDF.png"  width="155" height="155">
        </th>
        <th class="tg-qj3y">
          DNI:{{ $patient->DNI}}
        </th>
        <th class="tg-n0of"></th>
        @if($patient->end_treatment)
          <th class="tg-ofj5">
            <small>Fin Tratamiento:</small>
            <br>
            <strong>{{ \Carbon\Carbon::parse($patient->end_treatment)->format('d/m/Y')}}</strong>
          @endif
        </th>
      </tr>
      <tr>
        <td class="tg-zv4m">
          <small>Nombres:</small>
          <br>
          <strong>{{ $patient->name }}</strong>
        </td>
        <td class="tg-zv4m">
          <small>
            Apelldios:
          </small>
          <br>
          <strong>{{ $patient->last_name }}<strong>
          </td>
          <td class="tg-zv4m">
            <small>
              Apodo:
            </small>
            <br>
            <strong>{{ $patient->nick_name }}</strong>
          </td>
        </tr>
        <tr>
          <td class="tg-zv4m">
            <small>Fecha Nac.:</small>
            <br>
            <strong>
              {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y')}}   <!--cambia formato fecha-->
            </strong>
          </td>
          <td class="tg-zv4m">
            <small>Sexo:</small>
            <br>
            <strong>
                @if ($patient->sex == 'M')
                    Masculino
                @endif
                @if ($patient->sex == 'F')
                    Femenino
                @endif
            </strong>
          </td>
          <td class="tg-zv4m">
            <small>Grupo (RH):</small>
            <br>
            <strong>{{$patient->tblood_name}}</strong>
          </td>
        </tr>
        <tr>
          <td class="tg-zv4m" colspan="3">
            <small>Dirección:</small>
            <br>
            <strong>
              {{ $patient->address }}, {{ $patient->city }}, {{ $patient->province }}
            </strong>
          </td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="tg-xyxu"><span style="text-decoration:underline">Talles:</span></td>
          <td class="tg-drgp" colspan="3">Datos Clínicos:</td>
        </tr>
        <tr>
          <td class="tg-7drl">
            <small>Pañal:</small>
            {{ $patient->diaper_size }}
          </td>
          <td class="tg-sd0f">
            <small>Diagnostico:</small>
            <br>
            <strong>
                {{ $patient->diagnosis }}
            </strong>
          </td>
          <td class="tg-sd0f">
            <small>Inicio Tratamiento:</small>
            <br>
            <strong>
              {{ \Carbon\Carbon::parse($patient->start_treatment)->format('d/m/Y')}}   <!--cambia formato fecha-->
            </strong>
          </td>
          <td class="tg-sd0f">
            <small>Internado:</small>
            <br>
            @if($patient->internship == '0')
              No
            @else
              <strong>Si</strong>
            @endif</td>
          </tr>
          <tr>
            <td class="tg-7drl">
              <small>Ind. Superior:</small>
              {{ $patient->upper_indumetary_size }}
            </td>
            <td class="tg-sd0f" colspan="3" rowspan="3">
              <small>Información:</small>
              <br>
              {{ $patient->description }}
            </td>
          </tr>
          <tr>
            <td class="tg-7drl">
              <small>Ind. Inferior:</small>
              {{ $patient->alower_indumetary_size }}
            </td>
          </tr>
          <tr>
            <td class="tg-7drl">
              <small>Calzado:</small>
              {{ $patient->shoe_size }}
            </td>
          </tr>
        </tbody>
      </table>
      <br>
      <h4><u>Familiares:</u></h4>
      <table class="ttable" cellspacing="8" width="98%">
        <thead>
          <tr>
            <th width="10%">Familiar</th>
            <th width="5%">Cuidador</th>
            <th width="45%">Información</th>
            <th width="30%">Contacto</th>
            <th width="10%"><small>Grupo (RH)</small></th>
          </tr>
        </thead>
        <tbody>
          @foreach($families as $family)
            <tr>
              <td class="py-3 align-middle">{{ $family->relationship_name }}</td>
              <td class="py-3 align-middle">
                @if($family->keeper == '1')
                  <strong>Si</strong>
                @else
                  No
                @endif
              </td>
              <td class="py-3 align-middle" align="left">
                <strong>DNI:&nbsp;</strong> {{$family->DNI}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Nac.:&nbsp;</strong>
                {{ \Carbon\Carbon::parse($family->date_of_birth)->format('d/m/Y')}}
                <br>
                <strong>Nombre:&nbsp; </strong> {{$family->name}} {{$family->last_name}}
                <br>
                <strong>Dirección:&nbsp;</strong> {{ $family->address }}, {{ $family->city }}, {{ $family->province }}
              </td>
              <td class="py-3 align-middle" align="left">
                <strong>Celular 1:&nbsp;</strong> {{$family->mobile1}}
                <br>
                <strong>Celular 2:&nbsp;</strong>
                @if($family->mobile2)
                  {{$family->mobile2}}
                @else()
                  &#126;
                @endif()
                <br>
                <strong>Teléfono:&nbsp;</strong> {{ $family->phone}}
              </td>
              <td class="py-3 align-middle">{{ $family->tblood_name }}
              </td>


            </tr>
          @endforeach
        </tbody>
      </table>

    </body>
    </html>
