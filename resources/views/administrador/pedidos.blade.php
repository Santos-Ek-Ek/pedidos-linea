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

<script src="{{ asset('js/pedido.js') }}"></script>
<div class="container-fluid">
<!-- <div class="form-group">
    <label for="searchInput">Buscar por ID de transacción:</label>
    <input type="text" class="form-control" id="searchInput" placeholder="Ingrese el ID de transacción">
</div> -->
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
                      <td>{{$pedido->total}}</td>
                      <td>{{$pedido->estado}}</td>
                      <td>
                
                      <button class="btn btn-outline-success change-status" data-id="" data-status="" style="align-items: center; margin-left:10px;">
        <i class='fas fa-paper-plane d-flex'> Enviado</i>
    </button>

                </td>
                    </tr>
                    @endforeach
                </tbody>
                <!-- Agrega esta fila al final de tu tabla -->
<tr id="noPendientesMessage" style="display: none;">
    <td colspan="9">No hay pedidos pendientes.</td>
</tr>
<tr id="noEnviadosMessage" style="display: none;">
    <td colspan="9">Ningún pedido ha sido enviado.</td>
</tr>
              </table>


        </div>
      </div>
    </div>
@endsection