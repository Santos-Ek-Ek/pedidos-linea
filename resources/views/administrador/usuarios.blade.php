@extends('administrador.layout.app')
@section('titulo', 'Usuarios')
@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table class="table" id="tbl1">
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO</th>
                    <!-- <th scope="col">USUARIO</th> -->
                    <th scope="col">EMAIL</th>
                    <th scope="col">ACCIONES</th>
                </thead>
                <tbody>
                  @foreach($usuario as $items)
                    <tr>
                      <th>{{$items->id}}</th>
                      <td>{{$items->name}}</td>
                      <td>{{$items->lastname}}</td>
                      <!-- <td>{{$items->usuario}}</td> -->
                      <td>{{$items->email}}</td>
                      <td>
                        <a onclick="confirmDelete({{ $items->id }})" class="btn btn-outline-danger">
                                  <i class="bx bxs-trash"></i>
                        </a>
                        </a>
                          <form id="delete-category-form-{{ $items->id }}" action="{{ route('user.eliminar', $items->id) }}" method="POST" style="display: none;">
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
    <script>
function confirmDelete(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-category-form-' + id).submit();
        }
    });
}
</script>

@endsection