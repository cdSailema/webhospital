<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{
    



    public function index(){
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create(){
        return view('specialties.create');
    }

    public function sendData(Request $request){
        
        $rules = [
            'nombre' => ['required','min:3']
        ];

        $messages = [
            'nombre.required' => 'El nombre de la especialidad es obligatorio.',
            'nombre.min' => 'El nombre de la especialidad debe tener mas de 3 caracteres.'
        ];

        $this->validate($request, $rules, $messages);
        
        $specialty = new Specialty();
        $specialty->nombre = $request->input('nombre');
        $specialty->descripcion = $request->input('descripcion');
        $specialty->estado = $request->input('estado');
        $specialty->save();
        $notification = 'La especialidad se ha creado con éxito.';

        return redirect('/especialidades')->with(compact('notification'));
    }

    public function edit(Specialty $specialty){
        return view('specialties.edit', compact('specialty'));
    }

    public function upDate(Request $request, Specialty $specialty ){
        
        $rules = [
            'nombre' => ['required','min:3']
        ];

        $messages = [
            'nombre.required' => 'El nombre de la especialidad es obligatorio.',
            'nombre.min' => 'El nombre de la especialidad debe tener mas de 3 caracteres.'
        ];

        $this->validate($request, $rules, $messages);
        
        $specialty->nombre = $request->input('nombre');
        $specialty->descripcion = $request->input('descripcion');
        $specialty->save();
        $notification = 'La especialidad ha sido actualizada con éxito.';

        return redirect('/especialidades')->with(compact('notification'));
    }

    public function destroy(Specialty $specialty){
        $deleteName = $specialty->nombre;
        $specialty->delete();
        $notification = 'La especialidad  '.$deleteName.' se ha eliminado con éxito.';
        return redirect('/especialidades')->with(compact('notification'));
    }
}
