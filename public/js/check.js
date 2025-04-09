$(document).ready(function() {
    // Check if there's a selected value in local storage
    var selectedValue = localStorage.getItem('selectedAddress');

    if (selectedValue) {
        // Set the selected radio button based on the stored value
        $("input[type='radio'][value='" + selectedValue + "']").prop('checked', true);
    }

    // Listen for changes in the radio buttons
    $("input[type='radio']").on('change', function() {
        // Store the selected value in local storage
        localStorage.setItem('selectedAddress', $(this).val());
    });

    $('.delete-btn').on('click', function() {
        var direccionId = $('input[name="flexRadioDefault"]:checked').val();

        if (direccionId) {
            // Realizar una solicitud Ajax para eliminar la dirección
            $.ajax({
                url: '/eliminar-direccion/' + direccionId, // Reemplaza con la ruta adecuada en tu aplicación
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Manejar la respuesta del servidor (puede ser una redirección o actualizar la lista de direcciones, etc.)
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        } else {
            alert('Selecciona una dirección antes de eliminar.');
        }
    });
});
