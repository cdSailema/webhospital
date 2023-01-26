@extends('layouts.panel')

@section('content')
 
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h2 class="mb-10">Formulario de atención del paciente</h2>
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
             
        
            <form action= "{{ url('/atendercitas')}}" method="POST">
            {{-- "{{ url('/miscitas/'.$appointment->id.'/attend') }}" method="POST"> --}}
                @csrf
                <div class="form-group">
                    <label for="justification">Describa el diagnóstico:</label>
                    <textarea name="justification" id="justification" rows="5" class="form-control" required></textarea>
                </div>

                <div class="form-row"> 
                    <div class="form-group col-md-6">
                        <label for="estado">Enfermedad determinada:</label>
                        <select name="" id="" class="form-control">
                            <option selected>--- Seleccione la o las enfermedades ---</option>
                            @foreach ($enfermedades as $enfermedad)
                                <option value="{{ $enfermedad->id}}">{{ $enfermedad->name}}</option>
                            @endforeach                                                
                        </select>
                      </div>

                      <div class="form-group col-md-6">
                        <label for="estado">Medicamentos recetados:</label>
                        <select name="" id="" class="form-control">
                            <option selected>--- Seleccione el/los medicamentos ---</option>
                            @foreach ($medicamentos as $medicamento)
                                <option value="{{ $medicamento->id}}">{{ $medicamento->name}}</option>
                            @endforeach                                                
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
                </br>

                <button class="btn btn-sm btn-default" type="submit">Guardar</button>

        </form>

        </div>            
</div>
  
@endsection

@section('scripts')
  <script src=" {{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection