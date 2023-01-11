<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtiesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            'Medicina Interna',
            'Pediatría',
            'Endocrinología',
            'Ginecología',
            'Cardiología',
            'Urología',
            'Dermatología',
            'Neurología'
        ];
        foreach ($specialties as $specialty){
            Specialty::create([
                'nombre' => $specialty
            ]);
        }
    }
}
