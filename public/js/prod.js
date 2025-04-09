function agregarInput() {
    var contenedor = document.getElementById('contenedorInpu');
    var nuevoInput = document.createElement('div');
    nuevoInput.className = 'col-md-3';
    nuevoInput.innerHTML = `
        <div class="input-group mb-3">
            <input type="file" name="foto[]" accept="image/*" class="form-control">
            <button class="btn btn-outline-secondary" type="button" onclick="quitarInput(this)">-</button>
        </div>
    `;
    contenedor.appendChild(nuevoInput);
}

function quitarInput(elemento) {
    var contenedor = document.getElementById('contenedorInpu');
    var inputPadre = elemento.parentNode.parentNode;
    contenedor.removeChild(inputPadre);
}

function confirmDelete(product_id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminarlo'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-product-form-' + product_id).submit();
        }
    });
}