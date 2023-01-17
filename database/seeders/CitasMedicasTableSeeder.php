<?php

namespace Database\Seeders;

use App\Models\CitasMedicas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitasMedicasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CitasMedicas::factory()
            ->count(100)
            ->create();
    }
}
