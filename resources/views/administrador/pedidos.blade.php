@extends('administrador.layout.app')
@section('titulo', 'Pedidos')
@section('content')
<style>
    .envio-status {
        font-weight: bold;
    }

    .color-green {
        color: green;
    }

    .color-orange {
        color: orange;
    }
</style>


<div class="container-fluid">
<div class="form-group">
    <label for="searchInput">Buscar por teléfono:</label>
    <input type="text" class="form-control" id="searchInput" placeholder="Ingrese el número de teléfono">
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="checkEnviados" value="ENVIADO">
    <label class="form-check-label" for="checkEnviados">Enviados</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="checkPendientes" value="PENDIENTE">
    <label class="form-check-label" for="checkPendientes">Pendientes</label>
</div>

      <div class="row">
        <div class="col-12">

              <table class="table" id="tbl2">
                <thead>
                    <th scope="col" hidden>ID_TR</th>
                    <th scope="col">FOTO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DETALLES</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">DIRECCIÓN</th>
                    <th scope="col">USUARIO</th>
                    <th scope="col">ENVÍO</th>
                    <th scope="col">ENTREGA</th>
                    <th scope="col">METODO PAGO</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">ESTADO</th>
                    <th scope="col">ACCIONES</th>
                </thead>
                <tbody>
@foreach ($pedidos as $pedido)

                    <tr>
                      <td hidden>{{ $pedido->id }}</td>
                      <td><img width="100" height="100" src="{{ $pedido->producto->imagen }}" alt=""></td>
                      <td>{{ $pedido->producto->nombre }}</td>
                      <td>  <div style="max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: pre-wrap; word-break: break-word;">{{ $pedido->notas }}</div></td>
                      <td>{{$pedido->cantidad}}</td>
                      <td>  <div style="max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: pre-wrap; word-break: break-word;">{{$pedido->direccion}}</div></td>
                      <td>
  <div style="max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: pre-wrap; word-break: break-word;">
    {{$pedido->cliente->name}} {{$pedido->cliente->lastname}} 
    Tel: {{$pedido->cliente->telefono}}
    Email: {{$pedido->cliente->email}}
  </div>
</td>
                      <td>  <div style="max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: pre-wrap; word-break: break-word;">{{$pedido->metodo_entrega}}</div></td>
                      <td>{{$pedido->horario_entrega}}</td>
                      <td>  <div style="max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: pre-wrap; word-break: break-word;">{{$pedido->metodo_pago}}</div></td>
                      <td>${{ number_format($pedido->total + ($pedido->metodo_entrega == 'Enviar a domicilio' ? 5 : 0), 2) }}</td>
                      <td>{{$pedido->estado}}
                      @if($pedido->ticket_path)
        <a href="{{ asset($pedido->ticket_path) }}" 
           target="_blank" 
           class="ticket-link"
           title="Ver ticket">
            <i class="fas fa-file-pdf"></i> Ver
        </a>
    @else
        <span class="text-muted">No generado</span>
    @endif
                      </td>
                      <td>
                
                      <button class="btn btn-outline-success change-status" 
            data-id="{{ $pedido->id }}" 
            data-status="{{ $pedido->estado === 'Enviado' ? 'Pendiente' : 'Enviado' }}" 
            style="align-items: center; margin-left:10px;">
        <i class='fas fa-paper-plane d-flex'> 
            {{ $pedido->estado === 'Enviado' ? 'Marcar como Pendiente' : 'Marcar como Enviado' }}
        </i>
    </button>
                </td>
                    </tr>
                    @endforeach
                </tbody>
                <!-- Agrega esta fila al final de tu tabla -->
                <tr id="noPendientesMessage" style="display: none;">
    <td colspan="13" class="text-center">No hay pedidos pendientes.</td>
</tr>
<tr id="noEnviadosMessage" style="display: none;">
    <td colspan="13" class="text-center">No hay pedidos enviados.</td>
</tr>
              </table>


        </div>
      </div>
    </div>

    <script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const clientInfo = row.cells[6].textContent.toLowerCase(); // Celda que contiene "Tel: XXXXXXXX"
        const phone = clientInfo.split('tel:')[1]?.trim().split(' ')[0] || ''; // Extrae solo el número
        
        if(phone.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});



    </script>

<script>
// En pedido.js
$(document).on('click', '.change-status', function() {
    const pedidoId = $(this).data('id');
    const newStatus = $(this).data('status');
    
    $.ajax({
        url: '/pedidos/' + pedidoId + '/update-status',
        method: 'PUT',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            estado: newStatus
        },
        success: function(response) {
            location.reload(); // Recargar para ver los cambios
        },
        error: function(xhr) {
            alert('Error al actualizar el estado');
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Función para filtrar por teléfono y estado
    function filterRows() {
        const searchValue = document.getElementById('searchInput').value.toLowerCase();
        const checkEnviados = document.getElementById('checkEnviados').checked;
        const checkPendientes = document.getElementById('checkPendientes').checked;
        const rows = document.querySelectorAll('tbody tr');
        
        let hasEnviados = false;
        let hasPendientes = false;

        rows.forEach(row => {
            // Extraer teléfono (celda 6 - USUARIO)
            const clientInfo = row.cells[6].textContent.toLowerCase();
            const phone = clientInfo.split('tel:')[1]?.trim().split(' ')[0] || '';
            
            // Extraer estado (celda 11 - ESTADO)
            const estadoCell = row.cells[11];
            if(!estadoCell) {
                console.error('No se encontró la celda de estado');
                return;
            }
            
            // Limpiar el texto del estado (puede incluir otros elementos como el enlace PDF)
            const estadoText = estadoCell.textContent.trim();
            const estado = estadoText.includes('Enviado') ? 'Enviado' : 
                          estadoText.includes('Pendiente') ? 'Pendiente' : '';
            
            // Verificar coincidencia con búsqueda y filtros
            const matchesPhone = phone.includes(searchValue) || searchValue === '';
            const matchesEnviados = checkEnviados && estado === 'Enviado';
            const matchesPendientes = checkPendientes && estado === 'Pendiente';
            
            // Mostrar u ocultar fila según condiciones
            if (matchesPhone && 
                ((checkEnviados && matchesEnviados) || 
                 (checkPendientes && matchesPendientes) ||
                 (!checkEnviados && !checkPendientes))) {
                row.style.display = '';
                if (estado === 'Enviado') hasEnviados = true;
                if (estado === 'Pendiente') hasPendientes = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Mostrar mensajes cuando no hay resultados
        document.getElementById('noEnviadosMessage').style.display = 
            (checkEnviados && !hasEnviados) ? '' : 'none';
        document.getElementById('noPendientesMessage').style.display = 
            (checkPendientes && !hasPendientes) ? '' : 'none';
    }

    // Event listeners
    document.getElementById('searchInput').addEventListener('keyup', filterRows);
    document.getElementById('checkEnviados').addEventListener('change', filterRows);
    document.getElementById('checkPendientes').addEventListener('change', filterRows);

    // Filtrar al cargar la página
    filterRows();
});
</script>
@endsection