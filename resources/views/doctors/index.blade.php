@extends('layouts.panel')

@section('content')
 
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Médicos</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('/medicos/create')}}" class="btn btn-sm btn-default">Nuevo médico</a>
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
              @foreach ($doctors as $doctor)            
              <tr>
                <th scope="row">
                  {{$doctor->cedula}}
                </th>
                <td>
                  {{$doctor->name}}
                </td>
                <td>
                    {{$doctor->surname}}
                </td>
                <td>
                    {{$doctor->email}}
                </td>
                <td>
                    {{$doctor->phone}}
                </td>
                <td>
                    {{$doctor->address}}
                </td>
                <td>
                    {{$doctor->city}}
                </td>
                <td>
                    {{$doctor->birthday}}
                </td>
                <td>
                    {{$doctor->gender}}
                </td>
                <td>
                 
                  <form action="{{ url('/medicos/'.$doctor->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="{{ url('/medicos/'.$doctor->id.'/edit')}}" class="btn btn-sm btn-default">Editar</a>
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</a>
                  </form>
                  
                </td>
                
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        
        <div class="card-body">
          {{ $doctors->links() }}


        </div>
        

       
</div>
  
@endsection
