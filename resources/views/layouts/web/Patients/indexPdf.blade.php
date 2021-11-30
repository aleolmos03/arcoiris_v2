<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Exportar PDF</title>
    <style>
        .contenido {
            font-size: 11px;
        }

        .ttable {

            font-size: 12px;
            border: 1px solid #000;
            text-align: center;
            border-collapse: collapse;

        }

        .ttable th {
            background-color: #F3A69D;
            border: 1px solid #DA5244;
            margin: 10px;
            padding: 5px;
        }

        .ttable td {

            border: 1px solid #DA5244;
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
                <h3>{{ $titulo }}</h3>
                <p class="contenido">
                    {{ $total }} resultados
                </p>
            </td>
            <td width="35%" align="right" valign="bottom">
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
                <th width="5%">
                    ID
                </th>
                <th width="10%">
                    DNI
                </th>
                <th width="25%">
                    Nombre
                </th>
                <th width="15%">
                    Fecha Nac.
                </th>
                <th width="10%" title="Internado">
                    Internado
                </th>
                <th width="25%">
                    Cuidador
                </th>
                <th width="10%">
                    Ingresó
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td class="py-0 align-middle">
                        {{ $patient->id }}
                    </td>
                    <td class="py-0 align-middle">
                        {{ $patient->DNI }}
                    </td>
                    <td class="py-0 align-middle">
                        {{ $patient->name }} {{ $patient->last_name }}
                    </td>
                    <td class="py-0 align-middle">

                        {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y') }}                    </td>

                    <td class="py-0 align-middle">
                        @if ($patient->internship == 1)
                            Si
                        @else
                            No
                        @endif
                    </td>
                    <td class="py-0 align-middle">
                        {{ $patient->fname }} {{ $patient->flast_name }}
                        <br>
                        <strong>Cel:</strong>&nbsp;{{ $patient->fmobile }}
                    </td>
                    <td class="py-0 align-middle">
                        {{ \Carbon\Carbon::parse($patient->created_at)->format('d/m/Y') }}
                        @if ($patient->end_treatment)
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
