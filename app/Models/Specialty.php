<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'          
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function asSpecialtiesAppointments(){
        return $this->hasMany(CitasMedicas::class, 'specialty_id');
    }

    public function attendedSpecialties(){
        return $this->asSpecialtiesAppointments()->where('status', 'Atendida');
    }
    public function cancellSpecialties(){
        return $this->asSpecialtiesAppointments()->where('status', 'Cancelada');
    }

}
