<!-- Heading -->
<h6 class="navbar-heading text-muted text-default">
  @if(auth()->user()->role == 'admin')
    Gestión
  @else
    Menú
  @endif
</h6>

<ul class="navbar-nav">

  @include('includes.panel.menu.'.auth()->user()->role)
    
    

  </ul>
  
  @if(auth()->user()->role == 'admin')
  <!-- Divider -->
  <hr class="my-3">
  <!-- Heading -->
  <h6 class="navbar-heading text-warning text-muted ">Reportes</h6>
  <!-- Navigation -->
  <ul class="navbar-nav mb-md-3">

    <li class="nav-item">
      <a class="nav-link text-default" href="{{ url('/reportes/specialties/column') }}">
        <i class="ni ni-chart-bar-32 text-default"></i> Reporte Especialidades Citas
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link text-default" href="{{ url('/reportes/doctors/column') }}">
        <i class="fas fa-chart-bar text-default"></i> Reportes Médicos Citas
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/reportes/citas/line') }}">
        <i class="ni ni-books text-default"></i> Reporte Mes Citas
      </a>
    </li>    

    <li class="nav-item">
      <a class="nav-link text-default" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
          <i class="fas fa-sign-in-alt"></i> Cerrar sesión
      </a>
      <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
          @csrf
      </form>
    </li>

  </ul>

  
@endif