$("#armazones").DataTable({
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

let armazones;
$.post("./app/controllers/armazonesController.php", {
    obtenerArmazones: true
}).done(function (data) {
    armazones = JSON.parse(data)
}).then(() => {
    $.each(armazones, function (key, value) {
        console.log("#formEditarArmazon" + value.armazon_id)
        $("#formEditarArmazon" + value.armazon_id).submit(function () {
            $.post("./app/controllers/armazonesController.php", $("#formEditarArmazon" + value.armazon_id).serialize())
            .done(function(data){
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El armazon fue editado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'armazones'
                })
            })
            return false;
        })
    });
})


let estadoFormClientes= false;

function agregararmazon() {
    if (estadoFormClientes) {
        $("#divFormAddArmazon").hide(500);
        estadoFormClientes = false;
    } else {
        $("#divFormAddArmazon").show(500);
        estadoFormClientes = true;
    }
}

let estadoFormeExcel= false;

function agregarArmazonExcel() {
    if (estadoFormeExcel) {
        $("#divFormAddExcel").hide(500);
        estadoFormeExcel = false;
    } else {
        $("#divFormAddExcel").show(500);
        estadoFormeExcel = true;
    }
}

$("#formAddArmazon").submit(function () {
    $.post("./app/controllers/armazonesController.php", $("#formAddArmazon").serialize())
        .done(function (data) {
            console.log(data)
            Swal.fire(
                'Listo!',
                'El Armazon fue ingreso con éxito',
                'success'
            ).then(() => {
                window.location.href = 'armazones'
            })
        })
    return false;
})


function deshabilitarArmazon(armazonId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El armazon quedará no disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/armazonesController.php", {
                armazon:armazonId,
                deshabilitarArmazon: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El armazon fue eliminada con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'armazones'
                })
            })
        }
    })
}

function habilitarArmazon(armazonId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El armazon quedará disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, habilitar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/armazonesController.php", {
                armazon:armazonId,
                habilitarArmazon: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El armazon fue habilitado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'armazones'
                })
            })
        }
    })
}