<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['sigla', 'nombre'];


    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher');
    }

    public function availableClasses()
    {
        return $this->hasMany(AvailableClass::class);
    }

    /**
     * Prerrequisitos de esta materia.
     */
    public function prerequisites()
    {
        return $this->belongsToMany(
            Subject::class,
            'subject_prerequisites',
            'subject_id',
            'prerequisite_subject_id'
        );
    }

    /**
     * Materias que requieren esta materia como prerrequisito.
     */
    public function requiredFor()
    {
        return $this->belongsToMany(
            Subject::class,
            'subject_prerequisites',
            'prerequisite_subject_id',
            'subject_id'
        );
    }
    
}
