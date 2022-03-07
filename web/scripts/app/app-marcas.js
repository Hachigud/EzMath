$("#marcas").DataTable({
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

let marcas;
$.post("./app/controllers/marcasController.php", {
    obtenerMarcas: true
}).done(function (data) {
    marcas = JSON.parse(data)
}).then(() => {
    $.each(marcas, function (key, value) {
        console.log("#formEditarMarca" + value.marca_id)
        $("#formEditarMarca" + value.marca_id).submit(function () {
            $.post("./app/controllers/marcasController.php", $("#formEditarMarca" + value.marca_id).serialize())
            .done(function(data){
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'La marca fue editada con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'marcas'
                })
            })
            return false;
        })
    });
})


let estadoFormClientes= false;

function agregarmarca() {
    if (estadoFormClientes) {
        $("#divFormAddMarca").hide(500);
        estadoFormClientes = false;
    } else {
        $("#divFormAddMarca").show(500);
        estadoFormClientes = true;
    }
}

$("#formAddMarca").submit(function () {
    $.post("./app/controllers/marcasController.php", $("#formAddMarca").serialize())
        .done(function (data) {
            console.log(data)
            Swal.fire(
                'Listo!',
                'El vehículo fue ingreso con éxito',
                'success'
            ).then(() => {
                window.location.href = 'marcas'
            })
        })
    return false;
})


function deshabilitarMarca(marcaId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "La marca quedará no disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/marcasController.php", {
                marca:marcaId,
                deshabilitarMarca: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'La marca fue eliminada con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'marcas'
                })
            })
        }
    })
}

function habilitarMarca(marcaId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "La marca quedará disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, habilitar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/marcasController.php", {
                marca: marcaId,
                habilitarMarca: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'La marca fue habilitado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'marcas'
                })
            })
        }
    })
}