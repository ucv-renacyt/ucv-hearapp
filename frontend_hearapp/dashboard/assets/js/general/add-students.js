$(document).ready(function () {
    var form = $("#addStudents");

    form.submit(function (e) {
        e.preventDefault();

        var formData5 = new FormData(this);
        $.ajax({
            url: "config/general/add-students.php",
            method: "POST",
            data: formData5,
            processData: false,
            contentType: false,
            dataType: "json", // Especifica que esperas una respuesta JSON
            beforeSend: function () {
                // Muestra el overlay de carga antes de enviar la solicitud
                $("#loading-overlay").css("display", "flex");
            },
            success: function (response) {
                // Oculta el overlay de carga después de procesar la respuesta
                $("#loading-overlay").css("display", "none");

                // Maneja la respuesta del servidor
                if (response.status === "success") {
                    // Muestra la alerta de éxito
                    Swal.fire({
                        icon: "success",
                        title: "Creado con éxito.",
                        text: response.message,
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#exampleModal").modal("hide");
                            getTable(dataTable);
                        }
                    });
                } else {
                    // Muestra la alerta de error
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                        confirmButtonText: "OK",
                    });
                }
            },
            error: function (xhr, status, error) {
                // Oculta el overlay de carga en caso de error
                $("#loading-overlay").css("display", "none");
                console.error(xhr.responseText);
            },
        });
    });
});
$(document).on("click", ".edit", function() {
    var resultId = $(this).data("id");

    $.ajax({
        url: "config/general/get-general.php",
        method: "POST",
        data: {
            action: "get_all_teacher_id",
            resultId: resultId,
        },
        dataType: "json",
        success: function(data) {

            $("#editarModal .modal-body #id").val(data.id);
            $("#editarModal .modal-body #nombres").val(data.full_name);
            $("#editarModal .modal-body #codigo").val(data.code);
            $("#editarModal .modal-body #sexo").val(data.gender);
            $("#editarModal .modal-body #estado_civil").val(data.civil_status);
            $("#editarModal .modal-body #correo_institucional").val(data.institutional_mail);
            $("#editarModal .modal-body #corre_personal").val(data.personal_mail);
            $("#editarModal .modal-body #campus_id").val(data.campus_id);
            $("#editarModal .modal-body #celular").val(data.phone);
            $("#editarModal .modal-body #pass").val(data.password);
            $("#editarModal .modal-body #estado").val(data.state);
   

        },
    });
});

