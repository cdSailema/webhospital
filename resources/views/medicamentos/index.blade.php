@extends('layouts.panel')

@section('content')
   
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-default">Medicamentos</h3>
            </div>
            <div class="col text-right">
              <a href="{{url('/medicamentos/create')}}" class="btn btn-sm btn-default">Nuevo medicamento</a>
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
            @foreach ($medicamentos as $medicamento)
            <tr>
                <th scope="row">
                  {{ $medicamento->name}}
                </th>

                <td>
                  {{ $medicamento->description}}
                </td>

                <td>
                  <form action="{{ url('/medicamentos/'.$medicamento->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="{{ url('/medicamentos/'.$medicamento->id.'/edit')}}" class="btn btn-sm btn-default">Editar</a>
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