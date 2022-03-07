$("#laboratorios").DataTable({
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

let laboratorio;
$.post("./app/controllers/laboratoriosController.php", {
    obtenerlaboratorios: true
}).done(function (data) {
    laboratorio = JSON.parse(data)
}).then(() => {
    $.each(laboratorio, function (key, value) {
        console.log("#formEditarLaboratorio" + value.laboratorio_id)
        $("#formEditarLaboratorio" + value.laboratorio_id).submit(function () {
            $.post("./app/controllers/laboratoriosController.php", $("#formEditarLaboratorio" + value.laboratorio_id).serialize())
            .done(function(data){
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El laboratorio fue editado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'laboratorios'
                })
            })
            return false;
        })
    });
})


let estadoFormClientes= false;

function agregarlaboratorio() {
    if (estadoFormClientes) {
        $("#divFormAddLaboratorio").hide(500);
        estadoFormClientes = false;
    } else {
        $("#divFormAddLaboratorio").show(500);
        estadoFormClientes = true;
    }
}

$("#formAddLaboratorio").submit(function () {
    $.post("./app/controllers/laboratoriosController.php", $("#formAddLaboratorio").serialize())
        .done(function (data) {
            console.log(data)
            Swal.fire(
                'Listo!',
                'El laboratorio fue agregado con éxito',
                'success'
            ).then(() => {
                window.location.href = 'laboratorios'
            })
        })
    return false;
})


function deshabilitarlaboratorio(laboratorioId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El laboratorio quedará no disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/laboratoriosController.php", {
                laboratorioID:laboratorioId,
                deshabilitarlaboratorio: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El laboratorio fue eliminado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'laboratorios'
                })
            })
        }
    })
}

function habilitarlaboratorio(laboratorioId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El laboratorio quedará disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, habilitar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/laboratoriosController.php", {
                laboratorioID:laboratorioId,
                habilitarlaboratorio: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El laboratorio fue habilitado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'laboratorios'
                })
            })
        }
    })
}