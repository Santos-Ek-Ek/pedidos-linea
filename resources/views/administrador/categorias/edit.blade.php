<form id="updateCategoryForm" action="{{ route('categoria.actualizar', $categoria->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre de la categoría</label>
        <input type="text" class="form-control" id="nombre" name="nombre" 
               value="{{ old('nombre', $categoria->nombre) }}" required>
        @error('nombre')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </div>
</form>

<script>
$(document).ready(function() {
    $('#updateCategoryForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#updateModal').modal('hide');
                // Recargar la página o actualizar la tabla
                window.location.reload();
            },
            error: function(xhr) {
                // Mostrar errores de validación
                $('#updateModalBody').html(xhr.responseText);
            }
        });
    });
});
</script>