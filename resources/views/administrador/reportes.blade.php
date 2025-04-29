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
                    <h5>Resumen de Reportes</h5>
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
                        <div id="no-results-reportes" style="display: none;">No se encontraron resultados</div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para obtener la lista de archivos desde el servidor
    async function obtenerArchivos() {
        const response = await fetch('/api/reportes'); // Cambia la URL según tu endpoint
        if (!response.ok) {
            throw new Error('Error al obtener los archivos');
        }
        const archivos = await response.json();
        return archivos;
    }

    // Función para generar la tabla
        // Función para generar la tabla
        function generarTabla(archivos) {
        const tbody = document.querySelector('#tblReporte tbody');
        tbody.innerHTML = ''; // Limpiar el contenido anterior

        if (!Array.isArray(archivos)) {
            console.error('La respuesta no es un array:', archivos);
            return;
        }

        archivos.forEach(archivo => {
            const row = document.createElement('tr');

            // Celda para el ícono y el nombre del archivo
            const nombreCell = document.createElement('td');
            nombreCell.style.display = 'flex';
            nombreCell.style.alignItems = 'center';

            // Agregar el ícono SVG
            const iconoSVG = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            iconoSVG.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
            iconoSVG.setAttribute('width', '24');
            iconoSVG.setAttribute('height', '24');
            iconoSVG.setAttribute('viewBox', '0 0 24 24');
            iconoSVG.setAttribute('fill', 'none');
            iconoSVG.setAttribute('stroke', 'currentColor');
            iconoSVG.setAttribute('stroke-width', '2');
            iconoSVG.setAttribute('stroke-linecap', 'round');
            iconoSVG.setAttribute('stroke-linejoin', 'round');
            iconoSVG.classList.add('icon', 'icon-tabler', 'icons-tabler-outline', 'icon-tabler-file-type-pdf');

            const path1 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path1.setAttribute('stroke', 'none');
            path1.setAttribute('d', 'M0 0h24v24H0z');
            path1.setAttribute('fill', 'none');

            const path2 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path2.setAttribute('d', 'M14 3v4a1 1 0 0 0 1 1h4');

            const path3 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path3.setAttribute('d', 'M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4');

            const path4 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path4.setAttribute('d', 'M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6');

            const path5 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path5.setAttribute('d', 'M17 18h2');

            const path6 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path6.setAttribute('d', 'M20 15h-3v6');

            const path7 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path7.setAttribute('d', 'M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z');

            iconoSVG.appendChild(path1);
            iconoSVG.appendChild(path2);
            iconoSVG.appendChild(path3);
            iconoSVG.appendChild(path4);
            iconoSVG.appendChild(path5);
            iconoSVG.appendChild(path6);
            iconoSVG.appendChild(path7);

            nombreCell.appendChild(iconoSVG);

            // Agregar el nombre del archivo
            const nombreArchivo = document.createElement('span');
            nombreArchivo.textContent = archivo.name;
            nombreArchivo.style.marginLeft = '8px'; // Espacio entre el ícono y el texto
            nombreCell.appendChild(nombreArchivo);

            row.appendChild(nombreCell);

            const fechaCell = document.createElement('td');
            fechaCell.textContent = archivo.fecha;
            row.appendChild(fechaCell);

            // Celda para la acción (enlace)
            const accionCell = document.createElement('td');
            const enlace = document.createElement('a');
            enlace.href = `/ver-pdf/${archivo.name}`;
            enlace.target = '_blank'; // Abrir en una nueva pestaña
            const iconoOjo = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            iconoOjo.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
            iconoOjo.setAttribute('width', '24');
            iconoOjo.setAttribute('height', '24');
            iconoOjo.setAttribute('viewBox', '0 0 24 24');
            iconoOjo.setAttribute('fill', 'none');
            iconoOjo.setAttribute('stroke', 'currentColor');
            iconoOjo.setAttribute('stroke-width', '2');
            iconoOjo.setAttribute('stroke-linecap', 'round');
            iconoOjo.setAttribute('stroke-linejoin', 'round');
            iconoOjo.classList.add('icon', 'icon-tabler', 'icons-tabler-outline', 'icon-tabler-eye');

            const pathOjo1 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            pathOjo1.setAttribute('stroke', 'none');
            pathOjo1.setAttribute('d', 'M0 0h24v24H0z');
            pathOjo1.setAttribute('fill', 'none');

            const pathOjo2 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            pathOjo2.setAttribute('d', 'M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0');

            const pathOjo3 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            pathOjo3.setAttribute('d', 'M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6');

            iconoOjo.appendChild(pathOjo1);
            iconoOjo.appendChild(pathOjo2);
            iconoOjo.appendChild(pathOjo3);

            enlace.appendChild(iconoOjo);
            accionCell.appendChild(enlace);
            row.appendChild(accionCell);

            tbody.appendChild(row);
        });
    }


    // Cargar la tabla cuando la página esté lista
    document.addEventListener('DOMContentLoaded', async () => {
        try {
            const archivos = await obtenerArchivos();
            generarTabla(archivos);
        } catch (error) {
            console.error('Error:', error);
        }
    });
</script>
@endsection