$(document).ready(function () {
    $("#tableProductos").DataTable({
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
            'csvHtml5',
            'pdfHtml5'
        ]
    });

    let productos;
    $.post("./app/controllers/productosController.php", {
        obtenerProductosPorEmpresa: true
    }).done(function (data) {
        productos = JSON.parse(data)
    }).then(() => {
        $.each(productos, function (key, value) {
            console.log("#formEditarProducto" + value.producto_id)
            $("#formEditarProducto" + value.producto_id).submit(function () {
                $.post("./app/controllers/productosController.php", $("#formEditarProducto" + value.producto_id).serialize())
                .done(function(data){
                    console.log(data)
                    Swal.fire(
                        'Listo!',
                        'El producto fue editado con éxito',
                        'success'
                    ).then(() => {
                        window.location.href = 'productos'
                    })
                })
                return false;
            })
        });
    })
})

$("#formNuevoProducto").submit(function(){
    $.post("./app/controllers/productosController.php", $("#formNuevoProducto").serialize())
    .done(function(data){
        console.log(data)
        Swal.fire(
            'Listo!',
            'El producto fue ingresado con éxito',
            'success'
        ).then(() => {
            window.location.href = 'productos'
        })
    })
    return false;
})

function deshabilitarProducto(productoId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El producto no podrá ser cotizado",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/productosController.php", {
                producto: productoId,
                deshabilitarProducto: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El producto fue deshabilitado',
                    'success'
                ).then(() => {
                    window.location.href = 'productos'
                })
            })
        }
    })
}

let showFormState = false;
function mostrarForm(){
    if(!showFormState){
        $("#formNuevoProducto").show(500);
        showFormState = true;
    }else{
        $("#formNuevoProducto").hide(500);
        showFormState = false;
    }
}

function deshabilitarProducto(productoId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El producto se borrará del sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/productosController.php", {
                producto: productoId,
                deshabilitarProducto: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El producto fue eliminado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'productos'
                })
            })
        }
    })
}