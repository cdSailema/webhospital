<?php

namespace App\Http\Controllers;

use App\Models\Medicamentos;
use Illuminate\Http\Request;

class MedicamentosController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamentos::all();
        return view('medicamentos.index', compact('medicamentos'));
    }

    public function create()
    {
        $medicamentos = Medicamentos::all();
        return view('medicamentos.create', compact('medicamentos'));
    }

    public function store(Request $request){
        
        $rules = [
            'name' => ['required','min:3']
        ];

        $messages = [
            'name.required' => 'El nombre del medicamento es obligatorio.',
            'name.min' => 'El nombre del medicamento debe tener mas de 3 caracteres.'
        ];

        $this->validate($request, $rules, $messages);
        
        Medicamentos::create(
            $request->only('name', 'description')
        );      

        $notification = "El medicamento se ha registrado exitosamente.";
        return redirect('/medicamentos')->with(compact('notification'));

    }

    public function edit($id)
    {    
        $medicamento = Medicamentos::find(1)->findOrFail($id);
        return view('medicamentos.edit',compact('medicamento'));
    }

    public function upDate(Request $request, $id){
        
        $rules = [
            'name' => ['required','min:3']
        ];

        $messages = [
            'name.required' => 'El nombre del medicamento es obligatorio.',
            'name.min' => 'El nombre del medicamento debe tener mas de 3 caracteres.'
        ];

        $this->validate($request, $rules, $messages);
        $medicamento = Medicamentos::find(1)->findOrFail($id);
        $data = $request->only('name', 'description');
        $medicamento->fill($data);
        $medicamento->save();

        $notification = "El medicamento se ha actualizado exitosamente.";
        return redirect('/medicamentos')->with(compact('notification'));
        
    }

    public function destroy($id)
    {
        $medicamento = Medicamentos::find(1)->findOrFail($id);
        $medicamentoName = $medicamento->name;
        $medicamento->delete();

        $notification = "El medicamento $medicamentoName se eliminó correctamente";

        return redirect('/medicamentos')->with(compact('notification'));
    }
}
