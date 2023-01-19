<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CitasMedicas;
use App\Models\Specialty;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function appointments(){
        $now = Carbon::now();
        $end = $now->format('Y-m-d');
        $start = $now->subYear()->format('Y-m-d');
        
        $monthCounts = CitasMedicas::select(
            DB::raw('MONTH(scheduled_date) as month'),             
            DB::raw('COUNT(1) as count'))
            ->groupBy('month')
            ->get()
            ->toArray();
        
        $counts = array_fill(0, 12, 0);
        foreach($monthCounts as $monthCount){
            $index = $monthCount['month']-1;
            $counts[$index] = $monthCount['count'];
        }
       
        return view('charts.appointments', compact('counts', 'end', 'start'));
        }

        public function doctors(){
            $now = Carbon::now();
            $end = $now->format('Y-m-d');
            $start = $now->subYear()->format('Y-m-d');
    
            return view('charts.doctors', compact('end', 'start'));
        }

        public function doctorsJson(Request $request){

            $start = $request->input('start');
            $end = $request->input('end');
    
            $doctors = User::doctors()
                ->select('name')
                ->withCount(['attendedAppointments' => function($query) use ($start, $end){
                    $query->whereBetween('scheduled_date', [$start, $end]);
                },
                'cancellAppointments'=> function($query) use ($start, $end){
                    $query->whereBetween('scheduled_date', [$start, $end]);
                }
                ])
                
                ->get();
            
            $data = [];
            $data['categories'] = $doctors->pluck('name'); 
    
            $series = [];
            $series1['name'] = 'Citas atendidas';
            $series1['data'] = $doctors->pluck('attended_appointments_count');
            $series2['name'] = 'Citas canceladas';
            $series2['data'] = $doctors->pluck('cancell_appointments_count');
    
            $series[] = $series1;
            $series[] = $series2;
            $data['series'] = $series;
    
            return $data;
        }

// Controlador Reportes Citas Medica Mes
    public function specialties(){
        $now = Carbon::now();
        $end = $now->format('Y-m-d');
        $start = $now->subYear()->format('Y-m-d');
        return view('charts.specialties', compact('end', 'start'));
    }

public function specialtiesJson(Request $request){

    $start = $request->input('start');
    $end = $request->input('end');

    $specialties = Specialty::find(1)
        ->select('nombre')               
        ->withCount(['attendedSpecialties' => function($query) use ($start, $end){
            $query->whereBetween('scheduled_date', [$start, $end]);
        },
        'cancellSpecialties'=> function($query) use ($start, $end){
            $query->whereBetween('scheduled_date', [$start, $end]);
        }
        ])
        ->get();
        

    $data = [];
    $data['categories'] = $specialties->pluck('nombre');
    $series = [];
    $series1['name'] = 'Citas atendidas';
    $series1['data'] = $specialties->pluck('attended_specialties_count');
    $series2['name'] = 'Citas canceladas';
    $series2['data'] = $specialties->pluck('cancell_specialties_count');
    
    $series[] = $series1;
    $series[] = $series2;
    $data['series'] = $series;
    return $data;
 

}


    }