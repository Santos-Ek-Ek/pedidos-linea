$(document).ready(function() {
    // Función para deshabilitar campos al cargar la página
    function deshabilitarCampos() {
        var inputs = $("input");
        var selects = $("select");
        inputs.prop("readonly", true);
        selects.prop("disabled", true);
    }

    // Función para manejar el clic en el botón
    $("#editarBtn").click(function() {
        var isEditing = $(this).text() === "Guardar";
        var inputs = $("input");
        var selects = $("select");
        inputs.prop("readonly", isEditing);
        selects.prop("disabled", isEditing);

        if (isEditing) {
            // Si estamos guardando, enviamos el formulario
            $("form").submit();
        }

        $(this).text(isEditing ? "Editar datos" : "Guardar");
    });

    // Llama a la función al cargar la página
    deshabilitarCampos();

    // Otros códigos específicos de la segunda vista...
});
