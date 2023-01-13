<?php
    use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('content')
 
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Nuevo paciente</h3>
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
                  <label for="cedula">Número de cedula</label>
                  <input type="text" name="cedula" class="form-control" value="{{ old ('cedula')}}"required>
              </div>

              <div class="form-group">
                <label for="name">Nombres</label>
                <input type="text" name="name" class="form-control" value="{{ old ('name')}}"required>
            </div>

            <div class="form-group">
                <label for="surname">Apellidos</label>
                <input type="text" name="surname" class="form-control" value="{{ old ('surname')}}"required>
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="text" name="email" class="form-control" value="{{ old ('email')}}"required>
            </div>

            <div class="form-group">
                <label for="phone">teléfono/Celular</label>
                <input type="text" name="phone" class="form-control" value="{{ old ('phone')}}"required>
            </div>

            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" name="address" class="form-control" value="{{ old ('address')}}">
            </div>

            <div class="form-group">
                <label for="city">Ciudad de residencia</label>
                <input type="text" name="city" class="form-control" value="{{ old ('city')}}"required>
            </div>

            <div class="form-group">
              <label for="birthday">Fecha de nacimiento</label>
              <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input name="birthday" class="form-control datepicker" placeholder="Seleccione fecha de nacimiento" 
                type="text" value="{{ date('Y-m-d')}}" 
                data-date-format="yyyy-mm-dd" >
            </div>
 
            <div class="form-group">
              <label for="estado">Género</label>
              <select name="gender" class="custom-select">
                  <option selected>Seleccione el género</option>
                  <option value="Masculino">Masculino </option> 
                  <option value="Femenino">Femenino</option>
              </select>
            </div>

            <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="text" name="password" class="form-control" 
              value="{{ old ('password', Str::random(8))}}">
            </div>

            <button type="submit" class="btn btn-sm btn-default">Crear paciente</button>
          </form>
       </div>
</div>
  
@endsection

@section('scripts')
  <script src=" {{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
@endsection

