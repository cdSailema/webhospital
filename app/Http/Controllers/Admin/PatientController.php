<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::patients()->paginate(5);
        return view('patients.index', compact('patients'));
    }
   
    public function create()
    {
        return view('patients.create');
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
            'name.required' => 'El nombre del paciente es obligatorio.',
            'name.min' => 'El nombre del paciente debe tener mas de 3 caracteres.',
            'surname.required' => 'El apellido del paciente es obligatorio.',
            'surname.min' => 'El apellido del paciente debe tener mas de 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese una dirección de correo electrónico válido.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'address.min' => 'El dirección debe tener al menos 6 caracteres.',
            'city.min' => 'La ciudad debe tener al menos 6 caracteres.',
            'birthday.required' => 'El fecha de nacimiento es obligatorio.',   
            'gender.required' => 'El género es obligatorio.',            
        ];

        $this->validate($request, $rules, $messages);

        User::create(
            $request->only('cedula', 'name', 'surname', 
            'email', 'phone', 'address', 'city','birthday','gender')
            + [
                'role' => 'paciente',
                'password'=> bcrypt($request->input('password'))
            ]
            );
            $notification = 'El paciente se ha registrado exitosamente';
            return redirect('/pacientes')->with(compact('notification'));
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $patient = User::Patients()->findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    
    public function update(Request $request, $id)
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
            'name.required' => 'El nombre del paciente es obligatorio.',
            'name.min' => 'El nombre del paciente debe tener mas de 3 caracteres.',
            'surname.required' => 'El apellido del paciente es obligatorio.',
            'surname.min' => 'El apellido del paciente debe tener mas de 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese una dirección de correo electrónico válido.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'address.min' => 'El dirección debe tener al menos 6 caracteres.',
            'city.min' => 'La ciudad debe tener al menos 6 caracteres.',
            'birthday.required' => 'El fecha de nacimiento es obligatorio.',   
            'gender.required' => 'El género es obligatorio.',            
        ];

        $this->validate($request, $rules, $messages);
        $user = User::Patients()->findOrFail($id);

        $data = $request->only('cedula', 'name', 'surname', 
        'email', 'phone', 'address', 'city','birthday','gender');
        $password = $request->input('password');
        
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();    

        $notification = 'Los datos del paciente se ha actualizado exitosamente';
        return redirect('/pacientes')->with(compact('notification'));
    }

   
    public function destroy($id)
    {
        $user = User::Patients()->findOrFail($id);
        $pacienteName = $user->name;
        $user->delete();

        $notification = "El médico $pacienteName se elimino correctamente";

        return redirect('/pacientes')->with(compact('notification'));
    }
}
