protected $appends = ['dia_nombre'];

public function getDiaNombreAttribute()
{
    return match ((int) $this->day_of_week) {
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado',
        7 => 'Domingo',
        default => '',
    };
}