@extends('layouts.panel')

@section('content')
 
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Pacientes</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/pacientes/create')}}" class="btn btn-sm btn-default">Nuevo paciente</a>
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
            <thead class="thead-light">
              <tr>
                <th scope="col">Cédula</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Correo Electrónico</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Dirección</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Fecha de nacimiento</th>
                <th scope="col">Género</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($patients as $paciente)            
              <tr>
                <th scope="row">
                  {{$paciente->cedula}}
                </th>
                <td>
                  {{$paciente->name}}
                </td>
                <td>
                    {{$paciente->surname}}
                </td>
                <td>
                    {{$paciente->email}}
                </td>
                <td>
                    {{$paciente->phone}}
                </td>
                <td>
                    {{$paciente->address}}
                </td>
                <td>
                    {{$paciente->city}}
                </td>
                <td>
                    {{$paciente->birthday}}
                </td>
                <td>
                    {{$paciente->gender}}
                </td>
                <td>
                 
                  <form action="{{ url('/pacientes/'.$paciente->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="{{ url('/pacientes/'.$paciente->id.'/edit')}}" class="btn btn-sm btn-default">Editar</a>
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</a>
                  </form>
                  
                </td>
                
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        
        
        
</div>
  
@endsection
