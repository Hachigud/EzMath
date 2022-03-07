$("#adicionales").DataTable({
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

let adicional;
$.post("./app/controllers/adicionalesController.php", {
    obteneradicional: true
}).done(function (data) {
    adicional = JSON.parse(data)
}).then(() => {
    $.each(adicional, function (key, value) {
        console.log("#formEditarAdicional" + value.adicional_id)
        $("#formEditarAdicional" + value.adicional_id).submit(function () {
            $.post("./app/controllers/adicionalesController.php", $("#formEditarAdicional" + value.adicional_id).serialize())
            .done(function(data){
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El adicional fue editado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'adicionales'
                })
            })
            return false;
        })
    });
})


let estadoFormClientes= false;

function agregaradicional() {
    if (estadoFormClientes) {
        $("#divFormAddAdicional").hide(500);
        estadoFormClientes = false;
    } else {
        $("#divFormAddAdicional").show(500);
        estadoFormClientes = true;
    }
}

$("#formAddAdicional").submit(function () {
    $.post("./app/controllers/adicionalesController.php", $("#formAddAdicional").serialize())
        .done(function (data) {
            console.log(data)
            Swal.fire(
                'Listo!',
                'El adicional fue agregado con éxito',
                'success'
            ).then(() => {
                window.location.href = 'adicionales'
            })
        })
    return false;
})


