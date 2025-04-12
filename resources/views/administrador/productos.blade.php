@extends('administrador.layout.app')
@section('titulo', 'Productos')
@section('content')
<div>
<script src="{{ asset('js/prod.js') }}"></script>

<div style="margin-top:20px;">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Agregar producto <i class='bx bxs-add-to-queue'></i></button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
<div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="row g-3" action="{{ route('productos.agregar') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col-md-3">
        <label for="recipient-name" class="col-form-label">Nombre:</label>
        <input type="text" class="form-control" id="recipient-name" name="nombre" required>
        @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-2">
        <label for="recipient-name" class="col-form-label">Categoría:</label>
        <select class="form-control" name="categoria" required>
            <option disabled selected value="">Seleccione una opción</option>
            @foreach($categorias as $ca)
            <option value="{{ $ca->id }}">{{ $ca->nombre }}</option>
            @endforeach
        </select>
        @error('categoria') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-3">
        <label for="recipient-name" class="col-form-label">Imagen del producto:</label>
        <input type="file" name="file" id="file" accept="image/*" class="form-control" required>
        @error('file') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-2">
        <label for="recipient-name" class="col-form-label">Precio:</label>
        <input type="number" name="precio" step="0.01" class="form-control" required>
        @error('precio') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-2">
        <label for="recipient-name" class="col-form-label">Disponibles:</label>
        <input type="number" name="disponibles" step="0.01" class="form-control" required>
        @error('disponibles') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <label for="message-text" class="col-form-label">Descripción:</label>
        <textarea class="form-control" id="message-text" name="detalles"></textarea>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
      </div>

    </div>
</div>
</div>
</div>
<br>
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table class="table" id="tbl2">
                <thead>
                    <th scope="col" hidden>ID</th>
                    <th scope="col">FOTO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DETALLES/INGREDIENTES</th>
                    <th scope="col">CATEGORÍA</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">DISPONIBLES</th>
                    <th scope="col">ACCIONES</th>
                </thead>
                <tbody>
                @foreach($productos as $items)
                    <tr>
                      <th hidden>{{$items->id}}</th>
                      <td><img width="100" height="100" src="{{$items->imagen}}" alt=""></td>
                      <td>{{$items->nombre}}</td>
                      <td><p style="display: inline-block; max-width: 20rem; max-height: 7.8rem; overflow: auto; white-space: normal; word-wrap: break-word;">{{$items->detalle}}</p></td>
                      <td>{{$items->categoria->nombre}}</td>
                      <td>{{$items->precio}}</td>
                      <td>{{$items->disponibles}}</td>
                      <td>
                
                <a onclick="confirmDelete({{ $items->id }})" class="btn btn-outline-danger" style="margin-top: 40px; align-items: center; margin-left:10px;">
                    <i class='bx bxs-trash'></i>
                </a>

            <a onclick="openUpdateModal({{ $items->id }})">
                <i class="bx bxs-edit btn btn-outline-primary" style="margin-top: 40px; align-items: center; margin-left:10px;"></i>
            </a>
            <form id="delete-product-form-{{ $items->id }}" action="{{route('producto.eliminar', $items->id)}}" method="post"  onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?');" style="display: none;">
                @csrf
                @method('PUT')
            </form>
                </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="updateModalBody">
                <!-- Contenido del formulario de edición -->
            </div>
        </div>
    </div>
</div>
      </div>
      <script>
function openUpdateModal(id) {
    // Construye la URL correctamente
    var url = "{{ route('producto.editar', ':id') }}".replace(':id', id);
    
    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
            $('#updateModalBody').html(data);
            
            // Inicializa el modal de Bootstrap 5
            var modal = new bootstrap.Modal(document.getElementById('updateModal'));
            modal.show();
        },
        error: function(xhr) {
            console.error('Error:', xhr);
            Swal.fire({
                title: 'Error',
                text: xhr.status === 404 
                    ? 'Producto no encontrado' 
                    : 'Error al cargar el formulario',
                icon: 'error'
            });
        }
    });
}
      </script>
    </div>
@endsection