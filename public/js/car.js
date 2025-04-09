$('.cantidad.sol').on('input', function() {
    var productId = $(this).data('product-id');
    var rowId = $(this).attr('id').split('_')[1]; // Reemplaza con la lógica adecuada para obtener el rowId

    console.log('rowcol: ' , rowId);
    console.log('id_prod: ' , productId);

    // Actualiza el valor del input en el carrito utilizando Ajax
    $.ajax({
        url: "/actualizar-carrito/" + productId + "/" + rowId,
        type: 'POST',
        data: {
            cantidad: $(this).val(),
            _token: '{{ csrf_token() }}'
        },
        success: function(data) {
            // Actualiza la página o realiza otras acciones según sea necesario
        },
        error: function(error) {
            console.error('Error al actualizar el carrito:', error);
        }
    });
});
