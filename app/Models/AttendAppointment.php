<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendAppointment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'diagnostic',
        'citas_medicas_id',
        'enfermedad_id',
        'medicamento_id',
        'indications',
        'nextAppointment'
    ];

}
