<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Horario Académico</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
            margin:25px;
        }

        h1,h2,h3,p{
            margin:0;
        }

        .titulo{
            text-align:center;
            margin-bottom:20px;
        }

        .titulo h2{
            margin-top:5px;
        }

        .informacion{
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#d9d9d9;
        }

        th,td{
            border:1px solid #000;
            padding:6px;
            text-align:center;
        }

        .footer{
            margin-top:25px;
            text-align:right;
            font-size:10px;
        }
    </style>

</head>

<body>

@php

$dias = [
    1 => 'Lunes',
    2 => 'Martes',
    3 => 'Miércoles',
    4 => 'Jueves',
    5 => 'Viernes',
    6 => 'Sábado',
    7 => 'Domingo'
];

@endphp

<div class="titulo">

    <h1>SISTEMA DE HORARIOS</h1>

    <h2>Horario Académico</h2>

</div>

<div class="informacion">

    <p><strong>Horario:</strong> {{ $schedule->nombre_horario }}</p>

    <p><strong>Gestión:</strong> {{ $schedule->gestion }}</p>

</div>

<table>

    <thead>

    <tr>

        <th>Sigla</th>
        <th>Materia</th>
        <th>Docente</th>
        <th>Aula</th>
        <th>Grupo</th>
        <th>Semestre</th>
        <th>Especialidad</th>
        <th>Día</th>
        <th>Horario</th>

    </tr>

    </thead>

    <tbody>

    @foreach($schedule->availableClasses as $class)

        <tr>

            <td>{{ $class->subject->sigla }}</td>

            <td>{{ $class->subject->nombre }}</td>

            <td>
                {{ $class->teacher->prefijo_academico }}
                {{ $class->teacher->nombre_completo }}
            </td>

            <td>{{ $class->classroom->codigo }}</td>

            <td>{{ $class->group->nombre }}</td>

            <td>{{ $class->semester->nombre }}</td>

            <td>{{ $class->specialty->nombre }}</td>

            <td>{{ $dias[$class->timeSlot->dia_semana] }}</td>

            <td>

                {{ substr($class->timeSlot->hora_inicio,0,5) }}

                -

                {{ substr($class->timeSlot->hora_fin,0,5) }}

            </td>

        </tr>

    @endforeach

    </tbody>

</table>

<div class="footer">

    Generado automáticamente por el Sistema de Horarios <br>

    {{ now()->format('d/m/Y H:i') }}

</div>

</body>

</html>