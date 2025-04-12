<form id="updateProductForm">
    @csrf
    @method('PUT')
    
    <div class="row g-3">
        <div class="col-md-4">
            <label class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" value="{{ $producto->nombre }}" required>
        </div>
        
        <div class="col-md-3">
            <label class="col-form-label">Categoría:</label>
            <select class="form-control" name="categoria_id" required>
                @foreach($categorias as $cat)
                <option value="{{ $cat->id }}" {{ $producto->categoria_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nombre }}
                </option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-3">
            <label class="col-form-label">Precio:</label>
            <input type="number" step="0.01" class="form-control" name="precio" value="{{ $producto->precio }}" required>
        </div>
        <div class="col-md-3">
            <label class="col-form-label">Disponibles:</label>
            <input type="number" step="0.01" class="form-control" name="disponibles" value="{{ $producto->disponibles }}" required>
        </div>
        
        <div class="col-md-6">
            <label class="col-form-label">Imagen actual:</label>
            <img src="{{ asset($producto->imagen) }}" class="img-thumbnail" style="max-height: 150px;">
        </div>
        
        <div class="col-md-6">
            <label class="col-form-label">Nueva imagen (opcional):</label>
            <input type="file" class="form-control" name="file" accept="image/*">
        </div>
        
        <div class="col-12">
            <label class="col-form-label">Descripción:</label>
            <textarea class="form-control" name="detalle" rows="3">{{ $producto->detalle }}</textarea>
        </div>
    </div>
    
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </div>
</form>

<script>
$(document).ready(function() {
    $('#updateProductForm').submit(function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: "{{ route('producto.actualizar', $producto->id) }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#updateModal').modal('hide');
                Swal.fire('Éxito', response.success, 'success')
                    .then(() => window.location.reload());
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Mostrar errores de validación
                    var errors = xhr.responseJSON.errors;
                    for (var field in errors) {
                        $('[name="'+field+'"]').addClass('is-invalid')
                            .after('<div class="invalid-feedback">'+errors[field][0]+'</div>');
                    }
                } else {
                    Swal.fire('Error', xhr.responseJSON.error || 'Error desconocido', 'error');
                }
            }
        });
    });
});
</script>