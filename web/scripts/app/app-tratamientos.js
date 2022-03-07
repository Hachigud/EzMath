$("#tratamientos").DataTable({
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

let tratamiento;
$.post("./app/controllers/tratamientosController.php", {
    obtenertratamiento: true
}).done(function (data) {
    tratamiento = JSON.parse(data)
}).then(() => {
    $.each(tratamiento, function (key, value) {
        console.log("#formEditarTratamiento" + value.tratamiento_id)
        $("#formEditarTratamiento" + value.tratamiento_id).submit(function () {
            $.post("./app/controllers/tratamientosController.php", $("#formEditarTratamiento" + value.tratamiento_id).serialize())
            .done(function(data){
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El tratamiento fue editado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'tratamientos'
                })
            })
            return false;
        })
    });
})


let estadoFormClientes= false;

function agregartratamiento() {
    if (estadoFormClientes) {
        $("#divFormAddTratamiento").hide(500);
        estadoFormClientes = false;
    } else {
        $("#divFormAddTratamiento").show(500);
        estadoFormClientes = true;
    }
}

$("#formAddTratamiento").submit(function () {
    $.post("./app/controllers/tratamientosController.php", $("#formAddTratamiento").serialize())
        .done(function (data) {
            console.log(data)
            Swal.fire(
                'Listo!',
                'El tratamiento fue agregado con éxito',
                'success'
            ).then(() => {
                window.location.href = 'tratamientos'
            })
        })
    return false;
})


