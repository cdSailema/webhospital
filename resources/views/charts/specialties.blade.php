@extends('layouts.panel')

@section('content')

        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Reporte: Especialidades</h3>
                        
                        <div class="col text-right">
                            <a href="{{ url('/medicos')}}" class="btn btn-sm btn-success">
                              <i class="fas fa-print"></i>
                              PDF</a>
                        </div>

                    </div>
                    
                </div>
            </div>
            <div class="card-body">

                <div class="input-daterange datepicker row align-items-center" data-date-format="yyyy-mm-dd">
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control" placeholder="Fecha de inicio" id="startDate"
                                 type="text" value="{{ $start }}">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control" placeholder="Fecha fin" id="endDate"
                                type="text" value="{{ $end }}">
                            </div>
                        </div>
                    </div>
                </div>   
               
                <div id="container">
                    <div class="col text-right">
                        <a href="{{ url('/medicos')}}" class="btn btn-sm btn-success">
                          <i class="fas fa-print"></i>
                          PDF</a>
                    </div>

                </div>
            </div>
        </div>
    
@endsection

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}} "></script>
<script src="{{ asset('js/charts/specialties.js') }}" ></script>
@endsection
