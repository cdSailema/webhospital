@extends('layouts.panel')

@section('content')
 
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Editar enfermedad</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/enfermedades')}}" class="btn btn-sm btn-success">
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
          
          <form action="{{ url('/enfermedades/'.$enfermedad->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                  <label for="nombre">Nombre de la enfermedad</label>
                  <input type="text" name="name" class="form-control" value="{{ old ('name', $enfermedad->name)}}">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" name="description" class="form-control" value="{{ old ('description', $enfermedad->description)}}">
            </div>
           
            <button type="submit" class="btn btn-sm btn-primary">Guardar cambios</button>
          </form>


       </div>
</div>
  
@endsection
