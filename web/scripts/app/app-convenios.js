$("#convenios").DataTable({
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

let convenio;
$.post("./app/controllers/conveniosController.php", {
    obtenerconvenios: true
}).done(function (data) {
    convenio = JSON.parse(data)
}).then(() => {
    $.each(convenio, function (key, value) {
        console.log("#formEditarConvenio" + value.convenio_id)
        $("#formEditarConvenio" + value.convenio_id).submit(function () {
            $.post("./app/controllers/conveniosController.php", $("#formEditarConvenio" + value.convenio_id).serialize())
            .done(function(data){
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El convenio fue editado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'convenios'
                })
            })
            return false;
        })
    });
})


let estadoFormClientes= false;

function agregarconvenio() {
    if (estadoFormClientes) {
        $("#divFormAddConvenio").hide(500);
        estadoFormClientes = false;
    } else {
        $("#divFormAddConvenio").show(500);
        estadoFormClientes = true;
    }
}

$("#formAddConvenio").submit(function () {
    $.post("./app/controllers/conveniosController.php", $("#formAddConvenio").serialize())
        .done(function (data) {
            console.log(data)
            Swal.fire(
                'Listo!',
                'El convenio fue agregado con éxito',
                'success'
            ).then(() => {
                window.location.href = 'convenios'
            })
        })
    return false;
})


function deshabilitarconvenio(convenioId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El convenio quedará no disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/conveniosController.php", {
                convenio:convenioId,
                deshabilitarconvenio: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El convenio fue eliminado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'convenios'
                })
            })
        }
    })
}

function habilitarconvenio(convenioId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El convenio quedará disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, habilitar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/conveniosController.php", {
                convenio:convenioId,
                habilitarconvenio: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El convenio fue habilitado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'convenios'
                })
            })
        }
    })
}