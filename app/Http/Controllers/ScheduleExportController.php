<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SavedSchedule;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ScheduleExport;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleExportController extends Controller
{
    public function pdf($id)
    {
        $schedule = SavedSchedule::with([
            'availableClasses.subject',
            'availableClasses.teacher',
            'availableClasses.classroom',
            'availableClasses.timeSlot',
            'availableClasses.semester',
            'availableClasses.group',
            'availableClasses.specialty',
        ])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.schedule', [
            'schedule' => $schedule
        ]);

        return $pdf->stream('horario_' . $schedule->id . '.pdf');
    }
    public function excel($id)
    {
        $schedule = SavedSchedule::findOrFail($id);

        if ($schedule->availableClasses()->count() == 0) {
            return response()->json([
                'message' => 'El horario no contiene materias para exportar.'
            ], 404);
        }

        $nombreArchivo = str_replace(' ', '_', $schedule->nombre_horario)
            . '_' . $schedule->gestion . '.xlsx';

        return Excel::download(
            new ScheduleExport($id),
            $nombreArchivo
        );
    }
}
