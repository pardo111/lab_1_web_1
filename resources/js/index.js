$(document).ready(() => {
    console.log("si sale");

    $("#submit").click(() => {
        $("#submit").prop('disabled', true).html("procesando...");
        const form = {
            nombre: $("#nombre").val(),
            sueldo: $("#sueldo").val(),
            edad: $('#edad').val()
        }
        $.ajax({
            url: "app/models/procesar.php",
            type: "POST",
            data: form,
            success: function (res) {


                console.log(res);

                if (res.status) {
                    Swal.fire({
                        title: "Excelente",
                        text: res.mensaje,
                        icon: "success"
                    });
                    return;
                }


                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: res.mensaje,
                });

            },
            error: function (err) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "el servidor en este momento no sirve",
                });
                console.log("Error:", err);
            }
        });
    });



});