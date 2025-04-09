@extends('administrador.layout.app')
@section('titulo', 'Categorías')
@section('content')
<script src="{{ asset('js/cat.js') }}"></script>
<div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
          <div class="card-header">
            <div class="form-row align-items-center">
            <form action="{{route('categoria.agregar')}}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" placeholder="Nombre de la categoría" class="form-control mb-2" name="nombre" required>
                </div>
                <div class="col-auto">
                    <button class="btn btn-success mb-2" type="submit">Agregar</button>
                </div>
            </form>
            </div>

          </div>
            <div class="card-body">
            <table class="table" id="tbl3">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categoria as $items)
                <tr>
                <th scope="row">{{$items->id}}</th>
                <td>{{$items->nombre}}</td>
                <td>
                <a onclick="confirmDelete({{ $items->id }})" class="btn btn-outline-danger">
                            <i class="bx bxs-trash"></i>
                </a>
                <a class="btn btn-outline-primary" onclick="openUpdateModal({{ $items->id }})">
                <i class='bx bxs-edit-alt' ></i>
                </a>
                    <form id="delete-category-form-{{ $items->id }}" action="{{ route('categoria.eliminar', $items->id) }}" method="POST" style="display: none;">
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
      </div>
    </div>


<!-- Modal de Edición -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Editar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="updateModalBody">
                <!-- El contenido se carga aquí mediante AJAX -->
            </div>
        </div>
    </div>
</div>

<script>
function openUpdateModal(id) {
    // Construye la URL correctamente usando el helper route()
    var url = "{{ route('categoria.editar', ':id') }}";
    url = url.replace(':id', id);

    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
            $('#updateModalBody').html(data);
            $('#updateModal').modal('show');
        },
        error: function(xhr) {
            Swal.fire({
                title: 'Error',
                text: 'No se pudo cargar el formulario de edición',
                icon: 'error'
            });
        }
    });
}
</script>

</div>

@endsection