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
            <form id="reporteForm" action="{{ route('generar.reporte.pedidos') }}" method="POST">
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
            <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Resumen de Reportes</h5>
    <div class="input-group" style="width: 300px;">
        <input type="text" id="filtroReportes" class="form-control" placeholder="Buscar reportes...">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="btnBuscarReportes">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</div>
                <div class="card-body">
                    <div id="no-results-reportes" style="display: none;">No se encontraron resultados</div>
                    <table class="table" id="tblReporte">
                        <thead>
                            <tr>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">ACCIÓN</th>
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

<!-- Incluir jQuery y Toastr -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function() {
    // Función para agregar una nueva fila a la tabla
    function agregarFilaReporte(reporte) {
        const nuevaFila = `
            <tr>
                <td style="display: flex; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4"/>
                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6"/>
                        <path d="M17 18h2"/>
                        <path d="M20 15h-3v6"/>
                        <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z"/>
                    </svg>
                    <span style="margin-left: 8px;">${reporte.name}</span>
                </td>
                <td>${reporte.fecha}</td>
                <td>
                    <a href="${reporte.url}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/>
                        </svg>
                    </a>
                </td>
            </tr>
        `;
        
        $('#tblReporte tbody').prepend(nuevaFila);
        $('#no-results-reportes').hide();
        $('#tblReporte').show();
    }

    // Manejar el envío del formulario con AJAX
    $('#reporteForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    // Abrir el PDF en nueva pestaña
                    window.open(response.nuevo_reporte.url, '_blank');
                    
                    // Agregar el nuevo reporte a la tabla
                    agregarFilaReporte(response.nuevo_reporte);
                    
                    // Mostrar mensaje de éxito
                    toastr.success('Reporte generado y tabla actualizada');
                }
            },
            error: function(xhr) {
                toastr.error('Error al generar el reporte');
                console.error(xhr.responseText);
            }
        });
    });

    // Cargar reportes existentes al iniciar
    cargarReportesExistentes();

    // Función para cargar reportes existentes
    async function cargarReportesExistentes() {
        try {
            const response = await fetch('/api/reportes');
            const reportes = await response.json();
            
            if (reportes.length > 0) {
                reportes.forEach(reporte => {
                    agregarFilaReporte(reporte);
                });
            } else {
                $('#no-results-reportes').show();
                $('#tblReporte').hide();
            }
        } catch (error) {
            console.error('Error al cargar reportes:', error);
        }
    }
});

$(document).ready(function() {
    // Función para filtrar los reportes
    function filtrarReportes(termino) {
        const filas = $('#tblReporte tbody tr');
        let resultados = 0;
        
        filas.each(function() {
            const textoFila = $(this).text().toLowerCase();
            if (textoFila.includes(termino.toLowerCase())) {
                $(this).show();
                resultados++;
            } else {
                $(this).hide();
            }
        });
        
        if (resultados === 0) {
            $('#no-results-reportes').show();
        } else {
            $('#no-results-reportes').hide();
        }
    }

    // Evento para el botón de búsqueda
    $('#btnBuscarReportes').on('click', function() {
        const termino = $('#filtroReportes').val();
        filtrarReportes(termino);
    });
    
    // Evento para tecla Enter en el input
    $('#filtroReportes').on('keyup', function(e) {
        if (e.key === 'Enter') {
            const termino = $(this).val();
            filtrarReportes(termino);
        }
    });
    
    // Evento para limpiar el filtro cuando el input está vacío
    $('#filtroReportes').on('input', function() {
        if ($(this).val() === '') {
            $('#tblReporte tbody tr').show();
            $('#no-results-reportes').hide();
        }
    });
});
</script>
@endsection