/*=============================================
EDITAR Delivery
=============================================*/
$(document).ready(function() {
    $("#nuevaFechaNacimiento").change(function() {

        calcularEdad($(this).val());
    });

})

$(".tablas").on("click", ".btnEditarDelivery", function() {

    var idDelivery = $(this).attr("idDelivery");

    var nac = $(this).attr("editarFechaNacimiento");

    var datos = new FormData();
    datos.append("idDelivery", idDelivery);


    $.ajax({

        url: "ajax/delivery.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#idDelivery").val(respuesta["id"]);
            $("#editarDelivery").val(respuesta["nombre"]);
            $("#editarDocumentoId").val(respuesta["cedula"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarEstadoCivil").val(respuesta["estado_civil"]);
            $("#editarEstadoCivil").html(respuesta["estado_civil"]);
            $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);

            calcularEdad(respuesta["fecha_nacimiento"])
        },
        // error: function (jqXHR, exception) {
        //     console.log(jqXHR);
        //     // Your error handling logic here..
        // },
    })

})

/*=============================================
ELIMINAR Delivery
=============================================*/
$(".tablas").on("click", ".btnEliminarDelivery", function() {


    var idDelivery = $(this).attr("idDelivery");

    swal({
        title: '¿si Está seguro de borrar el Delivery?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Delivery!'
    }).then(function(result) {
        if (result.value) {

            window.location = "index.php?ruta=delivery&idDelivery=" + idDelivery;
        }

    })

})


$("#editarFechaNacimiento").change(function() {
    calcularEdad($(this).val());
});




function calcularEdad(fecha) {
    console.log("uuu")
    edad = 0;
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }
    //alert(edad)
    if (fecha != isNaN) {
        $('#age').val(edad + ' años');
        $('#ageA').val(edad + ' años');
    } else {
        $('#age').val('');
        $('#ageA').val('');
    }
}