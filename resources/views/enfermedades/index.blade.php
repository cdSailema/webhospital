@extends('layouts.panel')

@section('content')
   
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-default">Enfermedades</h3>
            </div>
            <div class="col text-right">
              <a href="{{url('/enfermedades/create')}}" class="btn btn-sm btn-default">Nueva enfermedad</a>
            </div>
          </div>
        </div>
        
        <div class="card-body">
          @if (session('notification'))
              <div class="alert alert-success" role="alert">
                {{ session('notification') }}
              </div>
          @endif
        </div>
        
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light ">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Opciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($enfermedades as $enfermedad)
            <tr>
                <th scope="row">
                  {{ $enfermedad->name}}
                </th>

                <td>
                  {{ $enfermedad->description}}
                </td>

                <td>
                  <form action="{{ url('/enfermedades/'.$enfermedad->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="{{ url('/enfermedades/'.$enfermedad->id.'/edit')}}" class="btn btn-sm btn-default">Editar</a>
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</a>
                  </form>
               
                </td>
            <tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
  @endsection