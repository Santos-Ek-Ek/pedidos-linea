@extends('administrador.layout.app')
@section('titulo', 'Reportes')
@section('content')
<div class="container-fluid">
    <br>
    <div class="card">
        <div class="card-header">
            <h5>Seleccionar rango de fechas para el reporte</h5>
        </div>
        <div class="card-body">
            <form id="reporteForm" action="{{ route('generar.reporte.pedidos') }}" method="POST" target="_blank">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha_fin">Fecha de fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center" style="margin-top: 15px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-file-pdf"></i> Generar PDF
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Resultados del Reporte</h5>
                </div>
                <div class="card-body">
                    <table class="table" id="tblReporte">
                        <thead>
                            <tr>
                                <th scope="col" hidden>ID</th>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">FECHA</th>
                                <!-- Agrega más columnas según necesites -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los datos se llenarán dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection