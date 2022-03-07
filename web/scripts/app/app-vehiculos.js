$("#tableVehiculos").DataTable({
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

let vehiculos;
$.post("./app/controllers/vehiculosController.php", {
    obtenerVehiculosPorEmpresa: true
}).done(function (data) {
    vehiculos = JSON.parse(data)
    console.log(vehiculos)
}).then(() => {
    $.each(vehiculos, function (key, value) {
        console.log("#formEditarVehiculo" + value.vehiculo_id)
        $("#formEditarVehiculo" + value.vehiculo_id).submit(function () {
            $.post("./app/controllers/vehiculosController.php", $("#formEditarVehiculo" + value.vehiculo_id).serialize())
            .done(function(data){
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El vehículo fue editado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'vehiculos'
                })
            })
            return false;
        })
    });
})


let estadoFormCliente = false;

function agregarVehiculo() {
    if (estadoFormCliente) {
        $("#divFormAddVehiculo").hide(500);
        estadoFormCliente = false;
    } else {
        $("#divFormAddVehiculo").show(500);
        estadoFormCliente = true;
    }
}

$("#formAddVehiculo").submit(function () {
    $.post("./app/controllers/vehiculosController.php", $("#formAddVehiculo").serialize())
        .done(function (data) {
            console.log(data)
            Swal.fire(
                'Listo!',
                'El vehículo fue ingreso con éxito',
                'success'
            ).then(() => {
                window.location.href = 'vehiculos'
            })
        })
    return false;
})


function deshabilitarVehiculo(vehiculoId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El vehículo quedará no disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/vehiculosController.php", {
                vehiculo: vehiculoId,
                deshabilitarVehiculo: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El vehículo fue eliminado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'vehiculos'
                })
            })
        }
    })
}

function habilitarVehiculo(vehiculoId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El vehículo quedará disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/vehiculosController.php", {
                vehiculo: vehiculoId,
                habilitarVehiculo: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El vehículo fue habilitado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'vehiculos'
                })
            })
        }
    })
}