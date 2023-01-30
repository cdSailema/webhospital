<?php
    use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('content')
 
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Atención Médica</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/pacientes')}}" class="btn btn-sm btn-success">
                <i class="fas fa-chevron-left"></i>
                Regresar</a>
            </div>
          </div>
        </div>
       
        <div class="card-body">
          @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Error!</strong> {{ $error}}
                </div>
            @endforeach
              
          @endif
          
          <form action="{{ url('/pacientes')}}" method="POST">
            @csrf
              
            <div class="form-group">
                <label for="justification">Describa el diagnóstico:</label>
                <textarea name="justification" id="justification" rows="5" class="form-control" required></textarea>
            </div>

            <div class="form-row"> 
            <div class="form-group col-md-6">
                <label for="estado">Enfermedad determinada:</label>
                <select name="" id="" class="form-control">
                    @foreach ($enfermedades as $enfermedad)
                        <option value="{{ $enfermedad->id}}">{{ $enfermedad->name}}</option>
                    @endforeach
                                        
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="estado">Medicamentos recetados:</label>
                <select name="gender" class="custom-select">
                    <option selected>--- Seleccione el/los medicamentos ---</option>
                    <option value="Masculino">Simvastatina</option> 
                    <option value="Femenino">Aspirina</option>
                    <option value="Masculino">Omeprazol</option> 
                    <option value="Femenino">Lexotiroxina sódica</option>
                    <option value="Masculino">Ramipril</option> 
                    <option value="Femenino">Amlodipina</option>
                    <option value="Femenino">Paracetamol</option>
                </select>
              </div>
            </div>

            <div class="form-group">
                <label for="justification">Indicaciones:</label>
                <textarea name="justification" id="justification" rows="5" class="form-control" required></textarea>
            </div>

            <div class="form-group">
              <label for="birthday">Proxima cita:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input name="birthday" class="form-control datepicker" placeholder="Seleccione fecha de nacimiento" 
                type="text" value="{{ date('Y-m-d')}}" 
                data-date-format="yyyy-mm-dd" >
            </div>

            <button class="btn btn-sm btn-default"  type="submit">Guardar</button>
          </form>
       </div>
</div>
  
@endsection

@section('scripts')
  <script src=" {{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
@endsection

