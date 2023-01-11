<?php

namespace App\Http\Controllers;

use App\Models\CitasMedicas;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    
    public function create(){
        $specialties = Specialty::all();
       
        return view('appointments.create', compact('specialties'));
    }

    public function store(Request $request){

        $rules = [
            'scheduled_time' => 'required',
            'type' => 'required',
            'description' => 'required',
            'doctor_id' => 'exists:users,id',
            'specialty_id' => 'exists:specialties,id'
        ];

        $messages = [
            'scheduled_time.required' => 'Debe seleccionar una hora para su cita.',
            'type.required' => 'Debe seleccionar el tipo de consulta.',
            'description.required' => 'Es necesario registrar sus síntomas.'
        ];

    $data = $request->only([
        'scheduled_date',
        'scheduled_time',
        'type',
        'description',
        'doctor_id',
        'specialty_id'
    ]);
    $data['patient_id'] = auth()->id();

    $carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
    $data['scheduled_time'] = $carbonTime->format('H:i:s');

    //Modelo Appointment
    CitasMedicas::create($data);
    $notification = 'La cita médica se ha registrado exitosamente.';
    return back()->with(compact('notification'));
    }
}
