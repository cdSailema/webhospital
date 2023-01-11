<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Horarios;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function hours(Request $request){

        $rules = [
            'date' => 'required|date_format:"Y-m-d"',
            'doctor_id' => 'required|exists:users,id'
        ];
        
        $this->validate($request, $rules);

        $date = $request->input('date');
        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;
        $day = ($i==0 ? 6 : $i-1);
        $doctorId = $request->input('doctor_id');

        $horario = Horarios::where('active', true)
        ->where('day', $day)
        ->where('user_id', $doctorId)
        ->first([
            'morningStart', 'morningEnd',
            'afternoonStart', 'afternoonEnd'
        ]);
    if(!$horario){
        return[];
    }
    
    $morningIntervalos = $this->getIntervalos(
        $horario->morningStart, $horario->morningEnd
    ); 
    
    $afternoonIntervalos = $this->getIntervalos(
        $horario->afternoonStart, $horario->afternoonEnd
    ); 

    $data = [];
    $data['morning']  = $morningIntervalos;
    $data['afternoon']  = $afternoonIntervalos;
    return $data;
    }

    private function getIntervalos($star, $end){
        $star = new Carbon($star);
        $end = new Carbon($end);

        $intervalos = [];
        while($star < $end){
            $intervalo = [];
            $intervalo['star'] = $star->format('g:i A');
            $star->addMinutes(30);
            $intervalo['end'] = $star->format('g:i A');
            $intervalos[]=$intervalo;
        }
        return $intervalos;
    }
}
