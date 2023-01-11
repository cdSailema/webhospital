<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cedula' => '1804147047', 
            'name'=> 'Admin', 
            'surname'=> 'Admin', 
            'email'=> 'admin1@gmail.com', 
            'email_verified_at' => now(),
            'password'=> bcrypt('12345678'), // password
            'phone'=> '0991726362', 
            'address'=> 'Av. Bolivariana', 
            'city' => 'Ambato',
            'birthday'=> '2018-07-02', 
            'gender'=> 'masculino', 
            'role'=> 'admin', 
        ]);

        User::create([
            'cedula' => '1804147047', 
            'name'=> 'Medico1', 
            'surname'=> 'Medico1', 
            'email'=> 'medico1@gmail.com', 
            'email_verified_at' => now(),
            'password'=> bcrypt('12345678'), // password
            'phone'=> '0991726362', 
            'address'=> 'Av. Bolivariana', 
            'city' => 'Ambato',
            'birthday'=> '2018-07-02', 
            'gender'=> 'Masculino', 
            'role'=> 'doctor', 
        ]);

        User::create([
            'cedula' => '1804147047', 
            'name'=> 'Paciente1', 
            'surname'=> 'Paciente1', 
            'email'=> 'paciente1@gmail.com', 
            'email_verified_at' => now(),
            'password'=> bcrypt('12345678'), // password
            'phone'=> '0991726362', 
            'address'=> 'Av. Bolivariana', 
            'city' => 'Ambato',
            'birthday'=> '2018-07-02', 
            'gender'=> 'Masculino', 
            'role'=> 'paciente', 
        ]);
    }
}
