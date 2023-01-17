<?php

namespace Database\Seeders;

use App\Models\Specialty;
use App\Models\User;
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
        foreach ($specialties as $specialtyName){
            $specialty = Specialty::create([
                'nombre' => $specialtyName
            ]);
            $specialty->users()->saveMany(
                User::factory(3)->state(['role' => 'doctor'])->make()

            );
                
        }
        User::find(3)->specialties()->save($specialty);
    }
}
