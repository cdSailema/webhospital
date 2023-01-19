@extends('layouts.panel')

@section('content')
 
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h2 class="text-center">Diagnóstico</h2>
              <h3 class="mb-0">Datos del paciente:</h3>
            </div>

            <div class="col text-right">
                <a href="{{ url('/miscitas')}}" class="btn btn-sm btn-success">
                  <i class="fas fa-chevron-left"></i>
                  Regresar</a>
            </div>
            
          </div>
        </div>
        
        <div class="card-body">
          @if (session('notification'))
              <div class="alert alert-success" role="alert">
                {{ session('notification') }}
              </div>
          @endif

      
               
            <p>Nombre: <b>{{ $appointment->patient->name}}</b> 
            Apellido: <b>{{ $appointment->patient->surname }}</b>
            Cédula: <b>{{ $appointment->patient->cedula }}</b><br>
            Especialidad: <b>{{ $appointment->specialty->nombre }}</b>
            Descripción de síntomas: <b>{{ $appointment->description }}</b><br>   
            Fecha: <b>{{ $appointment->scheduled_date }}</b> 
            Hora: <b>{{ $appointment->scheduled_time_12 }}</b>. 
            </p>
             
        
            <form action= "" method="POST">
            {{-- "{{ url('/miscitas/'.$appointment->id.'/attend') }}" method="POST"> --}}
                @csrf
                <div class="form-group">
                    <label for="justification">Describa el diagnóstico:</label>
                    <textarea name="justification" id="justification" rows="5" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="estado">Enfermedad determinada:</label>
                    <select name="gender" class="custom-select">
                        <option selected>---- Seleccione enfermedad ----</option>
                        <option value="Masculino">Dolor de garganta</option> 
                        <option value="Femenino">Dolor de oído</option>
                        <option value="Masculino">Infección de las vías urinarias</option> 
                        <option value="Femenino">Infección de la piel</option>
                        <option value="Masculino">Bronquitis</option> 
                        <option value="Femenino">Bronquiolitis</option>                        
                    </select>
                  </div>

                  <div class="form-group">
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

                <div class="form-group">
                    <label for="justification">Indicaciones:</label>
                    <textarea name="justification" id="justification" rows="5" class="form-control" required></textarea>
                </div>

                <button class="btn btn-sm btn-default" type="submit">Guardar</button>

        </form>

        </div>            
</div>
  
@endsection
