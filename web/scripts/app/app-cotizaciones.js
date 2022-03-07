$("#tableCotizaciones").DataTable({
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

$("#tableCotizacionesConOT").DataTable({
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
$("#tableOT").DataTable({
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
$('#productos-select').load("./app/components/cotizaciones-productos-select.php");
var stepper;
$("#divFormAddCliente").hide();
let estadoFormCliente = false;
let arrayProductos = Array();
let index = 1;
let valorNeto = 0;
let valorIva = 0;
let valorTotal = 0;
function agregarProducto() {
    let productoId = $("#select-producto").val();
    arrayProductos.push(productoId)
    let valor;
    let eliminar = '';
    let htmlTags;
    $.post("./app/controllers/productosController.php", {
        producto: productoId,
        valor: valor,
        obtenerProductoPorId: true
    }).done(function (data) {
        data = JSON.parse(data)
        index++;
        eliminar = '<button class="btn btn-warning text-white" onclick="eliminarProducto(' + index + ',' + productoId + ',' + data[0].monto + ')"><i class="material-icons">delete</i></button>';
        let detalle = '';
        if (data[0].detalle != null) {
            detalle = data[0].detalle;
        }
        htmlTags = '<tr id="pro' + index + '">' +
            '<td>' + data[0].nombre_producto + '</td>' +
            '<td>' + detalle + '</td>' +
            '<td>$' + numberWithDots(data[0].monto) + '</td>' +
            '<td>' + eliminar + '</td>' +
            '</tr>';
        $('#tableProductos tbody').append(htmlTags);
        $('#select-producto').prop('selectedIndex', 0);
        valorNeto += Math.round(parseInt(data[0].monto));
        valorIva = Math.round(parseInt(valorNeto) * 0.19);
        valorTotal = Math.round(parseInt(valorNeto) + valorIva);
        valorTotal = Math.round(parseInt(valorNeto) + valorIva);
        actualizarMontosTotales(valorNeto, valorIva, valorTotal);
        toastr.success("Producto Agregado");
    })
}

function eliminarProducto(index, productoId, monto) {
    $("#pro" + index + "").remove();
    valorNeto -= Math.round(parseInt(monto));
    valorIva = Math.round(parseInt(valorNeto) * 0.19);
    valorTotal = Math.round(parseInt(valorNeto) + valorIva);
    actualizarMontosTotales(valorNeto, valorIva, valorTotal);
    for (var i = 0; i < arrayProductos.length; i++) {
        if (arrayProductos[i] == productoId) {
            arrayProductos.splice(i, 1);
        }
    }
    toastr.info("El producto fue sacado de la cotización");
}

function actualizarMontosTotales(valorNeto, valorIva, valorTotal) {
    $("#valor_neto").val("$" + numberWithDots(valorNeto) + ".-");
    $("#valor_iva").val("$" + numberWithDots(valorIva) + ".-");
    $("#total").val("$" + numberWithDots(valorTotal) + ".-");
}

function finalizarCotizacion() {
    let clienteId = document.getElementById("select-state").value;
    $.post("./app/controllers/cotizacionesController", {
        ingresarCotizacion: true,
        cliente: clienteId,
        valor_neto: valorNeto,
        valor_iva: valorIva,
        valor_total: valorTotal,
        productos: arrayProductos
    }).done(function (data) {
        console.log(data)
        Swal.fire(
            'Listo!',
            'La cotización fue realizada con éxito!',
            'success'
        ).then(() => {
            window.location.href = 'cotizaciones'
        })
        window.open('./cotizacion-pdf?cotizacion=' + data, '_blank');
    })
    //console.log("Cliente: "+document.getElementById("select-state").value);
}
function notificarordentrabajo(ordentrabajoId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "La orden sera notificada",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, notificar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/cotizacionesController.php", {
                usuario_id: $("#usuario_logueado").val(),
                orden_trabajo: ordentrabajoId,
                notificarOrdenTrabajo: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'La Orden fue notificada con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'ordenes_de_trabajo'
                })
            })
        }
    })
}

function mostrarFormProducto() {
    Swal.fire({
        title: 'Ingresar nuevo item',
        html: '<input type="text" id="nombre_prod" name="nombre_prod" class="swal2-input" placeholder="Nombre del producto o servicio"></input>' +
            '<textarea type="number" style="width: 100%; max-width: inherit; height: 100px;" id="detalle" name="detalle" class="swal2-input" placeholder="Detalle o descripción del producto..."></textarea>' +
            '<input type="number" style="width: 100%; max-width: inherit;" id="precio" name="precio" class="swal2-input" placeholder="Precio"></input>',
        confirmButtonText: 'Ingresar Producto',
        preConfirm: () => {
            let nombre_producto = Swal.getPopup().querySelector('#nombre_prod').value
            let precio = Swal.getPopup().querySelector('#precio').value
            let detalle = Swal.getPopup().querySelector('#detalle').value
            if (nombre_producto === '' || precio === '') {
                Swal.showValidationMessage(`Debe ingresar el nombre y el precio del producto`)
            } else {
                $.post("./app/controllers/productosController.php", {
                    nombre_producto: nombre_producto,
                    monto: precio,
                    detalle: detalle,
                    ingresarProductoCotizacion: true
                }).done(function (data) {
                    console.log(data)
                })
                Swal.fire("Producto Ingresado con éxito").then(() => {
                    $('#productos-select').load("./app/components/cotizaciones-productos-select.php");
                })
            }
            return {
                unombre_preoducto: nombre_producto,
                precio: precio
            }
        }
    }).then((result) => {

    })
}

function deshabilitarCotizacion(cotizacionId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "La cotización será eliminada del sistema",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/cotizacionesController.php", {
                cotizacion: cotizacionId,
                deshabilitarCotizacion: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'La cotización fue eliminada con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'cotizaciones'
                })
            })
        }
    })
}

$('#select-state').selectize({
    sortField: 'text',
    placeholder: "Escriba el nombre de su cliente",
});

function agregarCliente() {
    if (estadoFormCliente) {
        $("#divFormAddCliente").hide(500);
        estadoFormCliente = false;
    } else {
        $("#divFormAddCliente").show(500);
        estadoFormCliente = true;
    }
}


stepper = new Stepper($('.bs-stepper')[0])

$("#formDatosGenerales").submit(function () {
    stepper.next()
    return false;
})

$("#formDatosContacto").submit(function () {
    stepper.next()
    return false;
})

function volverAtras() {
    stepper = new Stepper($('.bs-stepper')[0])
}

function irAdos() {
    stepper.to(2)
}

function irATres() {
    stepper.to(3)
}

function numberWithDots(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function generarOT(cotizacionId) {
    Swal.fire({
        title: '¿Esta seguro/a?',
        icon: 'info',
        html: '<label>Fecha estimada de entrega</label>' +
            '<input type="date" id="fecha_entrega" class="form-control"/>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, proceder',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("./app/controllers/ordernesTrabajosController.php", {
                ingresarOrdenTrabajo: true,
                cotizacion: cotizacionId,
                fecha_entrega: $("#fecha_entrega").val()
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'La orden de trabajo fue generada',
                    'success'
                ).then(() => {
                    window.location.href = 'cotizaciones'
                })
            })
        }
    })
}