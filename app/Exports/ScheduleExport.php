<?php

namespace App\Exports;

use App\Models\SavedSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class ScheduleExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize,
    WithStyles,
    WithEvents,
    WithTitle
{
    protected $schedule;

    public function __construct($schedule)
    {
        $this->schedule = SavedSchedule::with([
            'availableClasses.subject',
            'availableClasses.teacher',
            'availableClasses.classroom',
            'availableClasses.timeSlot',
            'availableClasses.semester',
            'availableClasses.group',
            'availableClasses.specialty',
        ])->findOrFail($schedule);
    }

    public function collection()
    {
        $dias = [
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
            7 => 'Domingo',
        ];

        return $this->schedule->availableClasses->map(function ($class) use ($dias) {

            return [

                'Sigla' => $class->subject->sigla,

                'Materia' => $class->subject->nombre,

                'Docente' => $class->teacher->prefijo_academico . ' ' .
                              $class->teacher->nombre_completo,

                'Aula' => $class->classroom->codigo,

                'Grupo' => $class->group->nombre,

                'Semestre' => $class->semester->nombre,

                'Especialidad' => $class->specialty?->nombre ?? 'N/A',

                'Día' => $dias[$class->timeSlot->dia_semana],

                'Hora Inicio' => substr($class->timeSlot->hora_inicio,0,5),

                'Hora Fin' => substr($class->timeSlot->hora_fin,0,5),

            ];

        });

    }

    public function headings(): array
    {
        return [
            'Sigla',
            'Materia',
            'Docente',
            'Aula',
            'Grupo',
            'Semestre',
            'Especialidad',
            'Día',
            'Hora Inicio',
            'Hora Fin'
        ];
    }
    public function title(): string
    {
        return 'Horario';
    }
    public function styles(Worksheet $sheet)
    {
        return [

            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
            ],

        ];
    }
    public function registerEvents(): array
{
    return [

        AfterSheet::class => function (AfterSheet $event) {

            $sheet = $event->sheet;

            // Fondo del encabezado

            $sheet->getStyle('A1:J1')->applyFromArray([

                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => [
                        'rgb' => '4F81BD',
                    ],
                ],

                'font' => [
                    'bold' => true,
                    'color' => [
                        'rgb' => 'FFFFFF',
                    ],
                ],

                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],

            ]);

            // Bordes de toda la tabla

            $ultimaFila = $sheet->getHighestRow();

            $sheet->getStyle("A1:J{$ultimaFila}")
                ->applyFromArray([

                    'borders' => [

                        'allBorders' => [

                            'borderStyle' => 'thin',

                        ],

                    ],

                ]);

            // Centrar contenido

            $sheet->getStyle("A1:J{$ultimaFila}")
                ->getAlignment()
                ->setHorizontal('center');

            // Congelar encabezados

            $sheet->freezePane('A2');

        },

    ];
}
}