@extends('layouts.panel')

@section('content')
 
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Nueva especialidad</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/especialidades')}}" class="btn btn-sm btn-success">
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
          
          <form action="{{ url('/especialidades')}}" method="POST">
            @csrf
             
            <div class="form-group">
                  <label for="nombre">Nombre de la especialidad</label>
                  <input type="text" name="nombre" class="form-control" value="{{ old ('nombre')}}"required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" class="form-control" value="{{ old ('descripcion')}}">
            </div>
           
            

            <div class="form-group">
              <label for="estado">Estado</label>
              <select name="estado" class="custom-select">
              <option selected>Seleccione el estado de la especialidad</option>
                  <option value="Activo">Activo </option> 
                  <option value="Inactivo">Inactivo</option>
              </select>
            </div>


            <button type="submit" class="btn btn-sm btn-primary">Crear especialidad</button>
          </form>


       </div>
</div>
  
@endsection

