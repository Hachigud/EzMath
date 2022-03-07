var stepper;
let estadoFormCliente = false;

$("#tableCliente").DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    dom: 'Bfrtip',
    buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
    ]
});

$("#region").change(function () {
    let comunas = '';
    $("#comuna").empty();
    $.post("./app/controllers/comunasController.php", {
        obtenerComunasPorRegion: true,
        region: $(this).val()
    }).done(function (data) {
        comunas = JSON.parse(data)
    }).then(() => {
        $.each(comunas, function (key, value) {
            $("#comuna").append($("<option>").attr('value', value.comuna_id).text(value.nombre_comuna));
        });
    })
})

function agregarCliente() {
    if (estadoFormCliente) {
        $("#divFormAddCliente").hide(500);
        estadoFormCliente = false;
    } else {
        $("#divFormAddCliente").show(500);
        estadoFormCliente = true;
    }
}

stepper = new Stepper($('.bs-stepper')[0])

$("#formDatosGenerales").submit(function () {
    stepper.next()
    return false;
})

$("#formDatosContacto").submit(function () {
    stepper.next()
    return false;
})

$("#formDireccion").submit(function () {
    $.post("./app/controllers/clientesController.php", {
        ingresarNuevoCliente: true,
        nombres: $("#nombres").val(),
        apellidos: $("#apellidos").val(),
        rut: $("#rut").val(),
        email: $("#email").val(),
        canal_ingreso: $("#canal_ingreso").val(),
        telefono_uno: $("#telefono_uno").val(),
        telefono_dos: $("#telefono_dos").val(),
        region: $("#region").val(),
        direccion: $("#direccion").val(),
        comuna: $("#comuna").val()
    }).done(function (data) {
        console.log(data)
        $("#formDatosGenerales")[0].reset()
        $("#formDatosContacto")[0].reset()
        $("#formDireccion")[0].reset()
        swal("Listo!", "Cliente ingresado", "success").then(() => {
            window.location.href = 'clientes'
        });
    })
    return false;
})

function volverAtras() {
    stepper = new Stepper($('.bs-stepper')[0])
}

function irAdos() {
    stepper.to(2)
}

function deshabilitarCliente(clienteId) {
    swal({
        title: "¿Está seguro/a?",
        text: "El cliente será deshabilitado del sistema",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.post("./app/controllers/clientesController.php", {
                deshabilitarCliente: true,
                cliente: clienteId
            }).done(function (data) {
                console.log(data)
                swal("Listo! el cliente fue deshabilitado!", {
                    icon: "success",
                }).then(() => {
                    window.location.href = 'clientes'
                });
            })
        }
    });
}