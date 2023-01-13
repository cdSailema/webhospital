<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CitasMedicas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function appointments(){
        
        $monthCounts = CitasMedicas::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(1) as count'))
            ->groupBy('month')
            ->get()
            ->toArray();
        $counts = array_fill(0, 12, 0);
        foreach($monthCounts as $monthCount){
            $index = $monthCount['month']-1;
            $counts[$index] = $monthCount['count'];
        }

        return view('charts.appointments', compact('counts'));
        }
}
