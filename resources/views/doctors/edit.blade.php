<?php
  use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('style')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
 
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Editar médico</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/medicos')}}" class="btn btn-sm btn-success">
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
                     
          <form action="{{ url('/medicos/'.$doctor->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="form-group">
                  <label for="cedula">Número de cedula</label>
                  <input type="text" name="cedula" class="form-control" value="{{ old ('cedula', $doctor->cedula)}}">
              </div>

              <div class="form-group">
                <label for="name">Nombres</label>
                <input type="text" name="name" class="form-control" value="{{ old ('name', $doctor->name)}}">
            </div>

            <div class="form-group">
                <label for="surname">Apellidos</label>
                <input type="text" name="surname" class="form-control" value="{{ old ('surname', $doctor->surname)}}">
            </div>

            <div class="form-group">
              <label for="specialties">Especialidades</label>
              <select name="specialties[]" id="specialties" class="form-control selectpicker"
              data-style="btn-primary" title="Seleccionar especialidades" multiple required>
                  @foreach ($specialties as $especialidad)
                      <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="text" name="email" class="form-control" value="{{ old ('email', $doctor->email)}}">
            </div>

            <div class="form-group">
                <label for="phone">teléfono/Celular</label>
                <input type="text" name="phone" class="form-control" value="{{ old ('phone', $doctor->phone)}}">
            </div>

            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" name="address" class="form-control" value="{{ old ('address', $doctor->address)}}">
            </div>

            <div class="form-group">
                <label for="city">Ciudad de residencia</label>
                <input type="text" name="city" class="form-control" value="{{ old ('city', $doctor->city)}}">
            </div>

            <div class="form-group">
                <label for="birthday">Fecha de nacimiento</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                  </div>
                  <input name="birthday" class="form-control datepicker" placeholder="Seleccione fecha de nacimiento" 
                  type="text" value="{{ old ('birthday', $doctor->birthday)}}" 
                  data-date-format="yyyy-mm-dd" >
              </div>
            

              <div class="form-group">
                  <label for="gender">Género</label>                  
                  <select name="gender" class="custom-select"> 
                      <option value="">Seleccione el género</option>
                      <option value="Masculino">Masculino </option> 
                      <option value="Femenino">Femenino</option>
                  </select>
                  
            </div>

            <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="text" name="password" class="form-control">
              <small class="text-warning">Solo llena el campo si desea cambiar la contraseña</small>
          </div>



            <button type="submit" class="btn btn-sm btn-primary">Guardar cambios</button>
          </form>


       </div>
</div>
  
@endsection

@section('scripts')
  <script src=" {{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

  <script>
    $(document).ready(()=>{});
    $('#specialties').selectpicker('val',@json($specialty_ids));
  </script>
  @endsection