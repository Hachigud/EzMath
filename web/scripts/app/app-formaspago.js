$("#formaspago").DataTable({
    "order": [
        [0, "desc"]
    ],
    "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    dom: 'Bfrtip',
    buttons: [
        'copyHtml5',
        'excelHtml5',
    ]
});     

let formaspago;
$.post("./app/controllers/formasPagoController.php", {
    obtenerFormaspago: true
}).done(function (data) {
    formaspago = JSON.parse(data)
}).then(() => {
    $.each(formaspago, function (key, value) {
        console.log("#formEditarFormapago" + value.pago_id)
        $("#formEditarFormapago" + value.pago_id).submit(function () {
            $.post("./app/controllers/formasPagoController.php", $("#formEditarFormapago" + value.pago_id).serialize())
            .done(function(data){
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'la forma de pago fue editada con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'forma-pago'
                })
            })
            return false;
        })
    });
})


let estadoFormClientes= false;

function agregarformapago() {
    if (estadoFormClientes) {
        $("#divFormAddFormapago").hide(500);
        estadoFormClientes = false;
    } else {
        $("#divFormAddFormapago").show(500);
        estadoFormClientes = true;
    }
}

$("#formAddFormapago").submit(function () {
    $.post("./app/controllers/formasPagoController.php", $("#formAddFormapago").serialize())
        .done(function (data) {
            console.log(data)
            Swal.fire(
                'Listo!',
                'la forma de pago fue agregada con éxito',
                'success'
            ).then(() => {
                window.location.href = 'forma-pago'
            })
        })
    return false;
})


function deshabilitarformapago(formapagoId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "La forma de pago quedará no disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/formasPagoController.php", {
                formapago:formapagoId,
                deshabilitarformapago: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'La forma de pago fue eliminada con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'forma-pago'
                })
            })
        }
    })
}

function habilitarformapago(formapagoId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "La forma de pago quedará disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, habilitar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/formasPagoController.php", {
                formapago:formapagoId,
                habilitarformapago: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'La forma de pago fue habilitada con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'forma-pago'
                })
            })
        }
    })
}