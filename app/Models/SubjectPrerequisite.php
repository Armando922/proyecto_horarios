<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubjectPrerequisite extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'prerequisite_subject_id',
    ];

    /**
     * Materia que tiene el prerrequisito.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Materia que actúa como prerrequisito.
     */
    public function prerequisite(): BelongsTo
    {
        return $this->belongsTo(
            Subject::class,
            'prerequisite_subject_id'
        );
    }
}