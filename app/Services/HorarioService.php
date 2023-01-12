<?php namespace App\Services;

use App\Interfaces\HorarioServiceInterface;
use App\Models\CitasMedicas;
use App\Models\Horarios;
use Carbon\Carbon;

class HorarioService implements HorarioServiceInterface {

    private function getDayFromDate($date){
        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;
        $day = ($i==0 ? 6 : $i-1);
        return $day;
    }

    public function isAvailableInterval($date, $doctorId, Carbon $start){
        $exists = CitasMedicas::where('doctor_id', $doctorId)
            ->where('scheduled_date',$date)
            ->where('scheduled_time', $start->format('H:i:s'))
            ->exists();
            
        return !$exists;
    }

   
    public function getAvailableIntervals($date, $doctorId){
        $horario = Horarios::where('active', true)
            ->where('day', $this->getDayFromDate($date))
            ->where('user_id', $doctorId)
            ->first([
                'morningStart', 'morningEnd',
                'afternoonStart', 'afternoonEnd'
            ]);
        if(!$horario){
            return [];
        }

        $morningIntervalos = $this->getIntervalos(
            $horario->morningStart, $horario->morningEnd, $doctorId, $date
        );

        $afternoonIntervalos = $this->getIntervalos(
            $horario->afternoonStart, $horario->afternoonEnd, $doctorId, $date
        );

        $data = [];
        $data['morning'] =  $morningIntervalos;
        $data['afternoon'] =  $afternoonIntervalos;
        return $data;
    }

    private function getIntervalos($start, $end, $doctorId, $date){
        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervalos = [];
        while($start < $end) {
            $intervalo = [];
            $intervalo['start'] = $start->format('g:i A');

            $available = $this->isAvailableInterval($date, $doctorId, $start);

            $start->addMinutes(30);
            $intervalo['end'] = $start->format('g:i A');

            if($available){
                $intervalos []= $intervalo;
            }

            
        }
        return $intervalos;

    }
}