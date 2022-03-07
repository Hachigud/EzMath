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

    $('#producto').selectize({
        sortField: 'text',
        placeholder: "Ingrese el código de barras o palabra clave",
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
                        window.location.href = 'productos-punto-ventas'
                    })
                })
                return false;
            })
        });
    })
})

$("#formNuevoProducto").submit(function(){
    var form_data = new FormData();
    $("#ingresar").val("Cargando...");
    $("#ingresar").prop("disabled", true);
    /*var ins = document.getElementById('files').files.length;
    console.log(ins)
    for (var x = 0; x < ins; x++) {
        form_data.append("files[]", document.getElementById('files').files[x]);
    }*/
    form_data.append("imagen", document.getElementById('files').files[0]);
    form_data.append("nombre_producto", $("#nombre_producto").val());
    form_data.append("monto", $("#monto").val());
    form_data.append("codigo_barras", $("#codigo_barras").val());
    form_data.append("detalle", $("#detalle").val());
    form_data.append("ingresarProductoPuntoDeVentas", true);
    console.log("form_data")
    $.ajax({
        url: './app/controllers/productosController.php',
        dataType: 'text', 
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(response) {
            $("#ingresar").val("Ingresar");
            $("#ingresar").prop("disabled", false);
            console.log("respuesta servidor: "+response)
            Swal.fire(
                'Listo!',
                'El producto fue ingreso con éxito',
                'success'
            ).then(() => {
                window.location.href = 'productos-punto-ventas'
            })
            //$("#formAddClase")[0].reset();
        },
        error: function(response) {
            console.log("error: "+response)
        }
    });
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
                    window.location.href = 'productos-punto-ventas'
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
                    window.location.href = 'productos-punto-ventas'
                })
            })
        }
    })
}