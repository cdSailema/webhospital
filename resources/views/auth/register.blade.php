@extends('layouts.form')

@section('title','Registrate')

@section('content')

<div class="container mt--8 pb-5">
    <!-- Table -->
    <div class="row justify-content-center">
      <div class="col-lg-12 col-md-5">
        <div class="card bg-secondary shadow border-0">
          
          <div class="card-body px-lg-4 py-lg-4">
                @if ($errors->any())
                    <div class="text-center text-muted mb-2">
                        <h4>Se encontro el siguiente error</h4>
                    </div>

                    <div class="alert alert-danger mb-4" role="alert">
                        {{ $errors->first()}}
                    </div>
                @else
                    <div class="text-center text-muted mb-4">
                        <small>Ingrese su datos</small>
                    </div>
                @endif


            <form role="form" method="POST" action="{{ route('register') }}">
                @csrf
              
                <div class="form-row">

                  
  
                <div class="form-group col-md-6">
                  <label for="name">Nombres</label>
                  <input type="text" name="name" class="form-control" value="{{ old ('name')}}"required>
              </div>

              <div class="form-group col-md-6">
                <label for="surname">Apellidos</label>
                <input type="text" name="surname" class="form-control" value="{{ old ('surname')}}"required>
            </div>
  
            </div>

            <div class="form-row"> 

              <div class="form-group col-md-6">
                <label for="cedula">Número de cédula</label>
                <input type="text" name="cedula" class="form-control" value="{{ old ('cedula')}}"required>
            </div>
            
            <div class="form-group col-md-6">
              <label for="estado">Género</label>
              <select name="gender" class="custom-select">
                  <option selected>Seleccione el género</option>
                  <option value="Masculino">Masculino </option> 
                  <option value="Femenino">Femenino</option>
              </select>
            </div>

            </div>
                
            
            <div class="form-row"> 
           
            <div class="form-group col-md-6">
              <label for="email">Correo electrónico</label>
              <input type="text" name="email" class="form-control" value="{{ old ('email')}}"required>
            </div>

            <div class="form-group col-md-6">
              <label for="phone">teléfono/Celular</label>
              <input type="text" name="phone" class="form-control" value="{{ old ('phone')}}"required>
            </div>

            </div>
            
            
            <div class="form-row "> 
                <div class="form-group col-md-6">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" class="form-control" value="{{ old ('address')}}">
                </div>

                <div class="form-group col-md-6">
                    <label for="city">Ciudad de residencia</label>
                    <input type="text" name="city" class="form-control" value="{{ old ('city')}}"required>
                </div>
            </div>

            <div class="form-group ">
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
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open text-default"></i></span>
                  </div>
                  <input class="form-control" placeholder="Contraseña" type="password" name="password" required autocomplete="new-password">
                </div>
              </div>
              
              
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open text-default"></i></span>
                  </div>
                  <input class="form-control" placeholder="Confirmar contraseña" type="password" name="password_confirmation" required autocomplete="new-password" >
                </div>
              </div>
              
              <div class="text-center">
                <button type="submit" class="btn btn-default mt-4">Registrarse</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src=" {{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
@endsection