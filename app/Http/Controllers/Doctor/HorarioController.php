<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horarios;
use Carbon\Carbon;

class HorarioController extends Controller
{
    private $days = [
        'Lunes', 'Martes', 'Miercoles', 'Jueves',
        'Viernes', 'Sabado', 'Domingo'
    ];
    
    public function edit(){

        $horarios = Horarios::where('user_id', auth()->id())->get();

       if(count($horarios) > 0){
            $horarios->map(function($horarios){
                $horarios->morningStart = (new Carbon($horarios->morningStart))->format('g:i A');
                $horarios->morningEnd = (new Carbon($horarios->morningEnd))->format('g:i A');
                $horarios->afternoonStart = (new Carbon($horarios->afternoonStart))->format('g:i A');
                $horarios->afternoonEnd = (new Carbon($horarios->afternoonEnd))->format('g:i A');
            });
       }else{
            $horarios = collect();
            for ($i=0; $i<7; ++$i)
                $horarios->push(new Horarios());
       }
        

        $days = $this->days;
        return view('horario', compact('days','horarios'));
    }

    public function store(Request $request){
  
        $active = $request->input('active') ?: [];
        $morningStart = $request->input('morningStart');
        $morningEnd = $request->input('morningEnd');
        $afternoonStart = $request->input('afternoonStart');
        $afternoonEnd = $request->input('afternoonEnd');
        
        $errors = [];
        for ($i=0; $i<7; ++$i){
            
            if($morningStart[$i] > $morningEnd[$i]){
                $errors [] = 'Inconsistencia en el intervalo de las horas del turno de la mañana del dia'. $this->days[$i].'.';
            }
            
            if($afternoonStart[$i] > $afternoonEnd[$i]){
                $errors [] = 'Inconsistencia en el intervalo de las horas del turno de la tarde del dia'. $this->days[$i].'.';
            }
            Horarios::updateOrCreate(
                [
                    'day' => $i,
                    'user_id' => auth()->id()
                ],
                [
                    'active' => in_array($i, $active),
                    'morningStart' => $morningStart[$i],
                    'morningEnd' => $morningEnd[$i],
                    'afternoonStart' => $afternoonStart[$i],
                    'afternoonEnd' => $afternoonEnd[$i],
                ]
            );
        }
        if(count($errors) > 0)
        return back()->with(compact('errors'));

        $notification = 'Los cambios se han guardado correctamente.';
        return back()->with(compact('notification'));
    }
}
