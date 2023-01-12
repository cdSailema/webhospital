<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioServiceInterface;
use App\Models\CitasMedicas;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    
    public function index(){       
        
        $confirmedAppointments = CitasMedicas::all()
            ->where('status', 'Confirmada')
            ->where('patient_id', auth()->id());
        $pendingAppointments = CitasMedicas::all()
            ->where('status', 'Reservada')
            ->where('patient_id', auth()->id());
        $oldAppointments = CitasMedicas::all()
            ->whereIn('status', ['Atendida','Cancelada'])
            ->where('patient_id', auth()->id());

        return view('appointments.index', compact('confirmedAppointments', 'pendingAppointments', 'oldAppointments'));
    }

    public function create(HorarioServiceInterface $horarioServiceInterface){
        $specialties = Specialty::all();

        $specialtyId = old('specialty_id');
        if ($specialtyId){
            $specialty = Specialty::find($specialtyId);
            $doctors = $specialty->users;
        }   else {
            $doctors = collect();
        }
        
        $date = old('scheduled_date');
        $doctorId = old('doctor_id');
        if ($date && $doctorId) {
            $intervals = $horarioServiceInterface->getAvailableIntervals($date, $doctorId);
        }else {
            $intervals = null;
        }

        return view('appointments.create', compact('specialties', 'doctors', 'intervals'));
    }

    public function store(Request $request, HorarioServiceInterface $horarioServiceInterface){

        $rules = [
            'scheduled_date' => 'required',
            'scheduled_time' => 'required',
            'type' => 'required',
            'description' => 'required',
            'doctor_id' => 'exists:users,id',
            'specialty_id' => 'exists:specialties,id'
        ];

        $messages = [
            'scheduled_date.required' => 'Debe seleccionar una fecha para su cita.',
            'scheduled_time.required' => 'Debe seleccionar una hora para su cita.',
            'type.required' => 'Debe seleccionar el tipo de consulta.',
            'description.required' => 'Es necesario registrar sus síntomas.'
        ];
    $validator = Validator::make($request->all(), $rules, $messages);

    
    $validator->after(function ($validator) use ($request, $horarioServiceInterface) {

        $date = $request->input('scheduled_date');
        $doctorId = $request->input('doctor_id');
        $scheduled_time = $request->input('scheduled_time');
        if ($date && $doctorId && $scheduled_time) {
            $start = new Carbon($scheduled_time);
        }else {
            return;
        }

        if (!$horarioServiceInterface->isAvailableInterval($date, $doctorId, $start)) {
            $validator->errors()->add(
                'available_time', 'La hora seleccionada ya se encuentra reservada por otro paciente.'
            );
        }
    });

    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }


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
