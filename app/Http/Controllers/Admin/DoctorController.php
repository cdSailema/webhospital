<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Specialty;

class DoctorController extends Controller
{
    
    public function index()
    {
        $doctors = User::doctors()->get();
        return view('doctors.index', compact('doctors'));
    }
   
    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    
    public function store(Request $request)
    {
        $rules = [
            'cedula' => 'required|digits:10',
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'nullable|min:6',
            'city' => 'nullable|min:3',
            'birthday' => 'required',
            'gender' => 'required',        
        ];
        
        $messages = [
            'cedula.required' => 'El numero de cédula es obligatorio.',
            'cedula.digits' => 'El numero de cédula debe tener 10 dígitos.',
            'name.required' => 'El nombre del médico es obligatorio.',
            'name.min' => 'El nombre del médico debe tener mas de 3 caracteres.',
            'surname.required' => 'El apellido del médico es obligatorio.',
            'surname.min' => 'El apellido del médico debe tener mas de 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese una dirección de correo electrónico válido.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'address.min' => 'El dirección debe tener al menos 6 caracteres.',
            'city.min' => 'La ciudad debe tener al menos 6 caracteres.',
            'birthday.required' => 'El fecha de nacimiento es obligatorio.',   
            'gender.required' => 'El género es obligatorio.',            
        ];

        $this->validate($request, $rules, $messages);

        $user = User::create(
            $request->only('cedula', 'name', 'surname', 
            'email', 'phone', 'address', 'city','birthday','gender')
            + [
                'role' => 'doctor',
                'password'=> bcrypt($request->input('password'))
            ]
        );
        $user->specialties()->attach($request->input('specialties'));
        
        $notification = 'El médico se ha registrado exitosamente';
        return redirect('/medicos')->with(compact('notification'));

    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
       
        $doctor = User::Doctors()->findOrFail($id);
        $specialties = Specialty::all();
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');

        return view('doctors.edit', compact('doctor','specialties','specialty_ids'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'cedula' => 'required|digits:10|unique:users',
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'nullable|min:6',
            'city' => 'nullable|min:3',
            'birthday' => 'required',
            'gender' => 'required',        
        ];
        
        $messages = [
            'cedula.required' => 'El numero de cédula es obligatorio.',
            'cedula.digits' => 'El numero de cédula debe tener 10 dígitos.',
            'cedula.unique:user' => 'El numero de cédula ya se encuentra registrado.',
            'name.required' => 'El nombre del médico es obligatorio.',
            'name.min' => 'El nombre del médico debe tener mas de 3 caracteres.',
            'surname.required' => 'El apellido del médico es obligatorio.',
            'surname.min' => 'El apellido del médico debe tener mas de 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese una dirección de correo electrónico válido.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'address.min' => 'El dirección debe tener al menos 6 caracteres.',
            'city.min' => 'La ciudad debe tener al menos 6 caracteres.',
            'birthday.required' => 'El fecha de nacimiento es obligatorio.',   
            'gender.required' => 'El género es obligatorio.',            
        ];

        $this->validate($request, $rules, $messages);
        $user = User::Doctors()->findOrFail($id);

        $data = $request->only('cedula', 'name', 'surname', 
        'email', 'phone', 'address', 'city','birthday','gender');
        $password = $request->input('password');
        
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save(); 
        $user->specialties()->sync($request->input('specialties'));


        $notification = 'Los datos del médico se ha actualizado exitosamente';
        return redirect('/medicos')->with(compact('notification'));
    }

    public function destroy($id)
    {
        $user = User::Doctors()->findOrFail($id);
        $doctorName = $user->name;
        $user->delete();

        $notification = "El médico $doctorName se elimino correctamente";

        return redirect('/medicos')->with(compact('notification'));
    }
}
