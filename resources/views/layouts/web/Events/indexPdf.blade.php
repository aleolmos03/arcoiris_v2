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
            background-color: #8EBAE7;
            border: 1px solid #6B8BAD;
            margin: 10px;
            padding: 5px;
        }

        .ttable td {
            border: 1px solid #6B8BAD;
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
                <h3>{{ $titulo_filtro }}</h3>
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
    <table class="ttable">
        <thead>
            <tr align="left">
                <th width="5%">ID</th>
                <th width="8%">Fecha</th>
                <th width="7%">Hora</th>
                <th width="40%">Evento</th>
                <th width="10%">Duración</th>
                <th width="10%">Tipo</th>
                <th width="8%" title="Inscriptos">Inscrip.</th>
                <th width="7%">Asistir</th>
            </tr>
        </thead>
        <tbody class="contenido" valign="top" align="left">
            @foreach ($events as $event)
                @if ($event->date_event >= now()->format('Y-m-d H:i') || $event->created_at == '1990-01-01 00:00:00')
                    <tr>
                        <td>
                            <strong>{{ $event->id }}</strong>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($event->date_event)->format('d/m/Y') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($event->date_event)->format('H:i') }}
                        </td>
                        <td>
                            <strong>Título: &nbsp;</strong>
                            <i>
                                {{ $event->title }}
                            </i>
                            <p>
                                <strong>Dirección:&nbsp;</strong>
                                {{ $event->address }},
                                 &nbsp;
                                 {{ $event->city }},
                                 &nbsp;
                                 {{ $event->province }}
                            </p>
                            <p>
                                <strong>Información:&nbsp;</strong> {{ $event->description }}
                        </td>
                        </p>
                        </td>
                        <td> {{ \Carbon\Carbon::parse($event->duration_event)->format('H:i') }} hs.
                        </td>
                        <td>
                            {{  $event->tevent }}
                        </td>
                        <td align="center"> <strong>{{ $array[$event->id] }}</strong> /
                            {{ $event->maximum_space }}
                        </td>
                        @if (current_eventPerson($event->id) == 'si')
                            <td align="center" class="text-success"> <strong>Si</strong>
                            @else
                            <td align="center"> &#126;
                        @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <!-- DivTable.com -->
    <H5> Eventos pasados:</H5>
    <table class="ttable">
        <thead>
            <tr align="left">
                <th width="5%">ID</th>
                <th width="8%">Fecha</th>
                <th width="7%">Hora</th>
                <th width="40%">Evento</th>
                <th width="10%">Duración</th>
                <th width="10%">Tipo</th>
                <th width="8%" title="Inscriptos">Inscrip.</th>
                <th width="7%">Asistir</th>
            </tr>
        </thead>
        <tbody class="contenido" valign="top" align="left">
            @foreach ($events as $event)
                @if ($event->date_event . ' ' . $event->hour_event < now()->format('Y-m-d H:i') || $event->created_at == '1990-01-01 00:00:00')
                    <tr>
                        <td>
                            <strong>{{ $event->id }}</strong>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($event->date_event)->format('d/m/Y') }} </td>
                        <td>
                            {{ \Carbon\Carbon::parse($event->date_event)->format('H:i') }}
                        </td>
                        <td>
                            <i>
                                <strong>Título: &nbsp;</strong>
                                {{ $event->title }} </i>
                            <p> <strong>Dirección:&nbsp;</strong>
                                {{ $event->address }},
                                 &nbsp;
                                 {{ $event->city }},
                                 &nbsp;
                                 {{ $event->province }}
                                </p>
                            <p> <strong>Información:&nbsp;</strong>
                                {{ $event->description }}
                        </td>
                        </p>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($event->duration_event)->format('H:i') }} hs. </td>
                        <td>
                            {{  $event->tevent }}
                        </td>
                        <td align="center">
                            <strong>{{ $array[$event->id] }}</strong> / {{ $event->maximum_space }}
                        </td>
                        @if (current_eventPerson($event->id) == 'si')
                            <td align="center" class="text-success">
                            <strong>Si</strong> @else
                            <td align="center">
                                &#126;
                        @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <!-- DivTable.com -->
</body>

</html>
