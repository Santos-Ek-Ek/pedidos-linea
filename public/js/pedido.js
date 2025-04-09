$(document).ready(function () {
    $('.change-status').each(function () {
        var button = $(this);
        var productId = button.data('id');
        var storedStatus = localStorage.getItem('status_' + productId);

        if (storedStatus) {
            // Se encontró un estado almacenado, actualiza el botón
            updateButtonState(button, storedStatus);
        }

        button.on('click', function () {
            var currentStatus = button.data('status');
            var newStatus = (currentStatus === 'ENVIADO') ? 'PENDIENTE' : 'ENVIADO';

            // Realiza la solicitud Ajax
            $.ajax({
                url: '/cambiar-estado/' + productId,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { status: newStatus },
                success: function (response) {
                    // Actualiza el estado visual en la interfaz de usuario
                    if (response.success) {
                        // Actualiza el valor en el span dentro de la misma fila que el botón
                        button.closest('tr').find('#envioValue').text(newStatus);

                        // Actualiza el atributo data-status del botón
                        button.data('status', newStatus);

                        // Cambia el texto del botón y el color
                        updateButtonState(button, newStatus);
                        
                        // Almacena el estado en localStorage
                        localStorage.setItem('status_' + productId, newStatus);
                    } else {
                        console.error('Error al cambiar el estado.');
                    }
                },
                error: function (error) {
                    console.error('Error en la solicitud Ajax:', error);
                }
            });
        });
    });

    function updateButtonState(button, status) {
        var productId = button.data('id');
        var icon = (status === 'ENVIADO') ? 'fas fa-exclamation-triangle' : 'fas fa-paper-plane';
        var oppositeStatus = (status === 'ENVIADO') ? 'PENDIENTE' : 'ENVIADO';
    
        // Actualiza el valor en el span dentro de la misma fila que el botón
        var envioValueSpan = button.closest('tr').find('#envioValue');
        envioValueSpan.text(status);
    
        // Actualiza las clases de color
        envioValueSpan.removeClass('text-success text-warning').addClass((status === 'ENVIADO') ? 'text-success' : 'text-warning');
    
        // Actualiza el atributo data-status del botón
        button.data('status', status);
    
        // Cambia el texto del botón y el color
        button.removeClass('btn-outline-success btn-outline-warning').addClass('btn-outline-' + ((status === 'ENVIADO') ? 'warning' : 'success'));
        button.html('<i class="' + icon + ' d-flex"> ' + oppositeStatus + '</i>');
    }
    

       // Captura el cambio en los checkboxes
       $('#checkEnviados, #checkPendientes, #searchInput').on('input', function () {
        // Filtra las filas según el estado de los checkboxes y el valor de búsqueda
        filterRows();
    });

    // Función para filtrar las filas
    function filterRows() {
        var checkEnviados = $('#checkEnviados').is(':checked');
        var checkPendientes = $('#checkPendientes').is(':checked');
        var searchValue = $('#searchInput').val().trim().toLowerCase();
    
        var noPendientesMessage = $('#noPendientesMessage');
        var noEnviadosMessage = $('#noEnviadosMessage');
    
        // Itera sobre cada fila y muestra u oculta según el estado y la búsqueda
        $('#tbl2 tbody tr').each(function () {
            var envioValue = $(this).find('#envioValue').text();
            var transactionId = $(this).find('td').eq(0).text().trim().toLowerCase();
    
            // Muestra u oculta según el estado y la búsqueda
            if (
                ((checkEnviados && envioValue === 'ENVIADO') || (checkPendientes && envioValue === 'PENDIENTE')) &&
                (transactionId.includes(searchValue) || searchValue === '')
            ) {
                $(this).show();
            } else if (!checkEnviados && !checkPendientes && (transactionId.includes(searchValue) || searchValue === '')) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    
        // Muestra u oculta la fila del mensaje
        if (checkPendientes && $('#tbl2 tbody tr:visible').length === 0) {
            noPendientesMessage.show();
        } else {
            noPendientesMessage.hide();
        }
        if (checkEnviados && $('#tbl2 tbody tr:visible').length === 0) {
            noEnviadosMessage.show();
        } else {
            noEnviadosMessage.hide();
        }
    }
    
    

});
