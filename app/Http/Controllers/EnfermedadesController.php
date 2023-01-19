<?php

namespace App\Http\Controllers;

use App\Models\Enfermedades;
use Illuminate\Http\Request;

class EnfermedadesController extends Controller
{
    public function index()
    {
        $enfermedades = Enfermedades::all();
        return view('enfermedades.index', compact('enfermedades'));
    }

    public function create()
    {
        $enfermedades = Enfermedades::all();
        return view('enfermedades.create', compact('enfermedades'));
    }

    public function store(Request $request){
        
        $rules = [
            'name' => ['required','min:3']
        ];

        $messages = [
            'name.required' => 'El nombre de la enfermedad es obligatorio.',
            'name.min' => 'El nombre de la enfermedad debe tener mas de 3 caracteres.'
        ];

        $this->validate($request, $rules, $messages);
        
        Enfermedades::create(
            $request->only('name', 'description')
        );      

        $notification = "La enfermedad se ha registrado exitosamente.";
        return redirect('/enfermedades')->with(compact('notification'));
    }

    public function edit($id)
    {    
        $enfermedad = Enfermedades::find(1)->findOrFail($id);
        return view('enfermedades.edit',compact('enfermedad'));
    }

    public function upDate(Request $request, $id){
        
        $rules = [
            'name' => ['required','min:3']
        ];

        $messages = [
            'name.required' => 'El nombre de la enfermedad es obligatorio.',
            'name.min' => 'El nombre de la enfermedad debe tener mas de 3 caracteres.'
        ];

        $this->validate($request, $rules, $messages);
        $enfermedad = Enfermedades::find(1)->findOrFail($id);
        $data = $request->only('name', 'description');
        $enfermedad->fill($data);
        $enfermedad->save();

        $notification = "La enfermedad se ha actualizado exitosamente.";
        return redirect('/enfermedades')->with(compact('notification'));
        
    }

    public function destroy($id)
    {
        $enfermedad = Enfermedades::find(1)->findOrFail($id);
        $enfermedadName = $enfermedad->name;
        $enfermedad->delete();

        $notification = "La enfermedad $enfermedadName se eliminó correctamente";

        return redirect('/enfermedades')->with(compact('notification'));
    }
}


