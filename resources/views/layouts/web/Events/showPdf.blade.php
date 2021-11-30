<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Exportar PDF Evento</title>
    <style>
        .contenido {
            font-size: 11px;
        }

        .ttable {
            font-size: 12px;
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
                <h3>Detalles del Evento
                    #{{ $event->id }}
                </h3>

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

    <table width="100%" frame="vsides" class="ttable">
        <thead>
            <tr align="left">

                <th width="10%">Fecha</th>
                <th width="5%">Hora</th>
                <th width="60%">Evento</th>
                <th width="8%">Duración</th>
                <th width="5%">Tipo</th>
                <th width="12%">Cupo máx.</th>

            </tr>

        </thead>

        <tbody class="ttable" valign="top" align="left">

            <tr>

                <td>
                    @if ($event->date_event < now()->format('Y-m-d') || $event->created_at == '1990-01-01 00:00:00')
                        <s>
                    @endif
                    {{ \Carbon\Carbon::parse($event->date_event)->format('d/m/Y') }}</s>
                </td>
                <td>
                    @if ($event->date_event < now()->format('Y-m-d') || $event->created_at == '1990-01-01 00:00:00')
                        <s>
                    @endif

                    {{ \Carbon\Carbon::parse($event->date_event)->format('H:i') }}</s>
                </td>
                <td>

                    <strong>Título: &nbsp;</strong>
                    <i>
                        @if ($event->date_event < now()->format('Y-m-d') || $event->created_at == '1990-01-01 00:00:00')
                            <s>
                        @endif
                        {{ $event->title }} </s>
                    </i>

                    <p>
                        <strong>Dirección:&nbsp;</strong>
                        @if ($event->date_event < now()->format('Y-m-d') || $event->created_at == '1990-01-01 00:00:00')
                            <s>
                        @endif
                        {{ $event->address }},&nbsp; {{ $event->city_name}}, &nbsp;{{$event->province_name}} </s>
                    </p>

                    <p>
                        <strong>Información:&nbsp;</strong>
                        @if ($event->date_event < now()->format('Y-m-d') || $event->created_at == '1990-01-01 00:00:00')
                            <s>
                        @endif
                        {{ $event->description }}</s>
                </td>
                </p>

                </td>
                <td>
                    @if ($event->date_event < now()->format('Y-m-d') || $event->created_at == '1990-01-01 00:00:00')
                        <s>
                    @endif
                    {{ \Carbon\Carbon::parse($event->duration_event)->format('H:i') }} hs.</s>
                </td>
                <td>
                    @if ($event->date_event < now()->format('Y-m-d') || $event->created_at == '1990-01-01 00:00:00')
                        <s>
                    @endif

                    {{ $event->event_type }}</s>

                </td>
                <td align="center">
                    @if ($event->date_event < now()->format('Y-m-d') || $event->created_at == '1990-01-01 00:00:00')
                        <s>
                    @endif
                    {{ $event->maximum_space }}</s>
                </td>
            </tr>
        </tbody>
    </table>

    <table border width="100%" align="center" valign="bottom">
        <tr>
            <td width="10%">
                <strong>Participantes:</strong>
            </td>
            <td width="70%"></td>
            <td width="20%">
                <br>
                <p class="contenido">
                    <strong>{{ $total }}</strong> confirmados
                </p>
            </td>
        </tr>
    </table>

    <table border width="100%" class="ttable" valign="top" align="left">
        <thead>
            <tr>

                <th width="5%" align="left">ID</th>
                <th width="25%" align="left">Apellido y Nombre</th>
                <th width="15%" align="left">DNI</th>
                <th width="15%" align="left">Celular</th>
                <th width="10%" align="left">Email</th>
                <th width="15%" align="left"></th>
        </thead>
        <tbody>
            @foreach ($participantes as $participante)
                <tr>

                    <td align="left">
                        @if ($participante->per_id == current_person()->person_id)
                                                <p class="text-primary">
                                                    <strong>
                                            @endif
                                            {{ $participante->id  }}
                                                   </strong>
                                                </p>
                                         </td>
                    <td>
                        @if ($participante->per_id  == current_person()->person_id)
                        <p class="text-primary"> <strong>
                    @endif
                    {{ $participante->last_name }} {{ $participante->name }}</strong></p>
                    </td>
                    <td>
                        @if ($participante->per_id  == current_person()->person_id)
                                                <p class="text-primary"> <strong>
                                            @endif
                                            {{ $participante->DNI }}</strong></p>
                    </td>
                    <td>
                        @if ($participante->per_id  == current_person()->person_id)
                                                <p class="text-primary"> <strong>
                                            @endif
                                            {{ $participante->mobile }}</strong></p>
                    </td>
                    <td>
                        @if ($participante->per_id  == current_person()->person_id)
                                                <p class="text-primary">
                                                    <strong>
                                            @endif
                                            {{ $participante->email }}


                                                    </strong>
                                                </p>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- DivTable.com -->


</body>

</html>
