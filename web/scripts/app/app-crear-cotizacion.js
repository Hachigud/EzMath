$("#divUltimasCotizaciones").hide(500);
$("#formAddrodenstock").hide();
// CARGA DE PRODUCTOS CUANDO LA COTIZACIÓN ESTA SIENDO EDITADA
$("#cristalesCotizacion").load("./cristales-cotizaciones.php?cotizacion=" + $("#cotizacion").val() +
    "&obtenerCristalesPorCotizacion=true" +
    "&descuento=" + $(
        "#descuento").val() + "&neto=" + $(
        "#valorNeto").val());
$("#productosAdicionales").load("./productos-adicionales-cotizacion.php?cotizacion=" + $("#cotizacion").val() +
    "&obtenerProductosPorCotizacion=true" +
    "&descuento=" + $(
        "#descuento").val() + "&neto=" + $(
        "#valorNeto").val());
$("#divFiltroRodenstock").load("./rodenstock-cotizaciones.php?cotizacion=" + $("#cotizacion").val() +
    "&obtenerRodenstockPorCotizacion=true" +
    "&descuento=" + $(
        "#descuento").val() + "&neto=" + $(
        "#valorNeto").val());
// TERMINO DE CARGA

$("#tipo_producto").change(function() {
    switch ($(this).val()) {
        case "1":
            $("#formAddCristales").show(500);
            $("#formAddrodenstock").hide(500);
            break;
        case "2":
            $("#formAddrodenstock").show(500);
            $("#formAddCristales").hide(500);
        default:
            break;
    }
})

function aplicarDescuento() {
    let neto = document.getElementById('valorNeto').value;
    let descuento = $("#descuento").val();
    let iva;
    let total;
    document.getElementById('descuentos').innerHTML = numberWithDots($("#descuento").val());
    document.getElementById('neto_con_descuento').innerHTML = numberWithDots(neto - descuento);
    document.getElementById('iva').innerHTML = numberWithDots(Math.round(neto * 0.19));
    document.getElementById('total').innerHTML = numberWithDots(Math.round((iva = neto * 0.19) + (neto - descuento)));
}

function finalizarCotizacion() {
    let rut = document.getElementById('rut').value;
    let nombre_completo = $("#nombre_completo").val();
    let telefono = $("#telefono").val();
    let email = $("#email").val();
    let usuario = $("#usuario").val();
    let valorNeto = document.getElementById('valorNeto').value;
    let valorDescuento = $("#descuento").val();
    let valorIva = (document.getElementById('valorNeto').value - $("#descuento").val()) * 19 / 100;
    let valorTotal = valorNeto - valorDescuento + valorIva;
    let editCot = $("#editCot").val();
    let cotizacion = $("#cotizacion").val();
    let observaciones = $("#observaciones").val();
    if (rut == "") {
        alert('Ingrese Algun usuario');
    } else {
        let esf_d = $("#esf_d").val();
        let cli_d = $("#cli_d").val();
        let add_d = $("#add_d").val();
        let esf_i = $("#esf_i").val();
        let cli_i = $("#cli_i").val();
        let add_i = $("#add_i").val();
        Swal.fire({
            title: 'Confirmación',
            text: "¿Quiere finalizar la cotización?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, finalizar',
            cancelButtonText: 'Cancelar y seguir editando'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("./app/controllers/cotizacionesController.php", {
                    finalizarCotizacion: true,
                    valor_neto: valorNeto,
                    valor_descuento: valorDescuento,
                    valor_iva: valorIva,
                    valor_total: valorTotal,
                    usuario: $("#usuario").val(),
                    rut: $("#rut").val(),
                    nombre_completo: nombre_completo,
                    telefono: telefono,
                    email: email,
                    usuario: $("#usuario").val(),
                    editar_cotizacion: editCot,
                    cotizacion: cotizacion,
                    observaciones: observaciones
                }).done(function (data) {
                    console.log(data)
                    href = "./cotizacion-pdf.php?cotizacion=" + data;
                    window.open(href, "_blank");
                    window.location.href = 'cotizaciones';
                })
            }
        })
    }
}

localStorage.setItem('valorNeto', 0);


$("#formAddProductoAdicional").submit(function () {
    let neto = document.getElementById('valorNeto').value;
    let descuento = $("#descuento").val();
    let iva;
    let total;
    document.getElementById('descuentos').innerHTML = $("#descuento").val();
    document.getElementById('neto_con_descuento').innerHTML = neto - descuento;
    document.getElementById('iva').innerHTML = neto * 0.19;
    document.getElementById('total').innerHTML = (neto * 0.19) + (neto - descuento);
    $.post("./app/controllers/productosController.php", $("#formAddProductoAdicional").serialize())
        .done(function (data) {
            console.log(data)
            if ($("#filtroAdicionales").val() === "ingresarProductoUsuario") {
                $("#productosAdicionales").load("./productos-adicionales-cotizacion.php?filtros=" + $(
                    "#filtroAdicionales").val() + "&obtenerProductosPorUsuario=true" + "&usuario=" + $(
                        "#usuario").val() + "&descuento=" + $(
                            "#descuento").val() + "&neto=" + $(
                                "#valorNeto").val());
            }
            if ($("#filtroAdicionales").val() === "ingresarProductoCotizacion") {
                $("#productosAdicionales").load("./productos-adicionales-cotizacion.php?cotizacion=" + $("#cotizacion").val() +
                    "&obtenerProductosPorCotizacion=true" +
                    "&descuento=" + $(
                        "#descuento").val() + "&neto=" + $(
                            "#valorNeto").val());
            }

        })
    return false;
})


$('#busqueda_cliente').selectize({
    sortField: 'text',
    placeholder: "Ingrese el nombre del cliente",
});

$('#producto').selectize({
    sortField: 'text',
    placeholder: "Ingrese el nombre del producto",
});

$('.color').selectize({
    sortField: 'text',
    placeholder: "Color",
});

$('#precio_cristal').selectize({
    sortField: 'text',
    placeholder: "Cristal",
});

$('.armazon').selectize({
    sortField: 'text',
    placeholder: "Armazon",
});

$('.tratamiento').selectize({
    sortField: 'text',
    placeholder: "Tratamiento",
});

$('.tipo_cristal').selectize({
    sortField: 'text',
    placeholder: "Tipo de Cristal",
});

$('.adicional').selectize({
    sortField: 'text',
    placeholder: "Adicional",
});

$('#convenio').selectize({
    sortField: 'text',
    placeholder: "seleccione convenio",
});

$('#forma_pago').selectize({
    sortField: 'text',
    placeholder: "Seleccione forma de pago",
});

function guardarCotizacion() {
    let usuario = document.getElementById('usuario').value;
    let rut = document.getElementById('rut').value;
    console.log(rut);
    if (rut == "") {
        alert('Ingrese Algun usuario');
    } else {
        let rut = $("#rut").val();
        let nombre_completo = $("#nombre_completo").val();
        let telefono = $("#telefono").val();
        let email = $("#email").val();
        let usuario = $("#usuario").val();
        $.post("./app/controllers/cotizacionesController.php", {
            guardarCotizacion: true,
            rut: rut,
            nombre_completo: nombre_completo,
            telefono: telefono,
            email: email,
            usuario: $("#usuario").val()
        }).done(function (data) {
            console.log(data)
            Swal.fire(
                'Listo!',
                'La cotización fue guardada',
                'success'
            )
        })
    }
}

$("#busqueda_cliente").change(function () {
    let clienteId = $(this).val();
    $.post("./app/controllers/clientesController.php", {
        obtenerClientePorId: true,
        cliente: clienteId
    }).done(function (data) {
        data = JSON.parse(data)
        $("#rut").val(data.rut);
        $("#nombre_completo").val(data.nombre_completo);
        $("#telefono").val(data.telefono)
        $("#email").val(data.email)
        $("#divUltimasCotizaciones").show(500);
        $("#tableUltimasCotizaciones").load("table-ultimas-cotizaciones.php?cliente=" + clienteId)
    })
})

function eliminarCristal(Id, precio) {
    console.log(Id)
    console.log(precio)
    Swal.fire({
        title: '¿Está seguro?',
        text: "El cristal  sera eliminado",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/cristalesCotizacionesController.php", {
                cristal: Id,
                eliminarCristal: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El cristal fue eliminada con éxito',
                    'success'
                ).then(() => {
                    if ($("#filtroCristales").val() === "ingresarCristalUsuario") {
                        $("#cristalesCotizacion").load("./cristales-cotizaciones.php?filtro=" + $(
                            "#filtroCristales").val() + "&obtenerCristalesPorUsuario=true" + "&usuario=" + $(
                                "#usuario").val() + "&descuento=" + $(
                                    "#descuento").val() + "&neto=" + $(
                                        "#valorNeto").val() + "&eliminar=true&precio=" + precio);
                    }
                    if ($("#filtroCristales").val() === "ingresarCristalCotizacion") {
                        console.log("Valor neto2: " + $("#valorNeto").val())
                        $("#cristalesCotizacion").load("./cristales-cotizaciones.php?cotizacion=" + $("#cotizacion").val() + "&obtenerCristalesPorCotizacion=true" +
                            "&descuento=" + $(
                                "#descuento").val() + "&neto=" + $(
                                    "#valorNeto").val() + "&eliminar=true&precio=" + precio);
                    }
                })
            })
        }
    })
}

function eliminarAdicional(Id, precio) {
    console.log(Id)
    Swal.fire({
        title: '¿Está seguro?',
        text: "El producto adicional sera eliminado",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/productosCotizacionesController.php", {
                adicional: Id,
                eliminarAdicional: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El producto fue eliminada con éxito',
                    'success'
                ).then(() => {
                    if ($("#filtroAdicionales").val() === "ingresarProductoUsuario") {
                        $("#productosAdicionales").load("./productos-adicionales-cotizacion.php?filtros=" + $(
                            "#filtros").val() + "&obtenerProductosPorUsuario=true" + "&usuario=" + $(
                                "#usuario").val() + "&descuento=" + $(
                                    "#descuento").val() + "&neto=" + $(
                                        "#valorNeto").val() + "&eliminar=true&precio=" + precio);
                    }
                    if ($("#filtroAdicionales").val() === "ingresarProductoCotizacion") {
                        $("#productosAdicionales").load("./productos-adicionales-cotizacion.php?cotizacion=" + $("#cotizacion").val() +
                            "&obtenerProductosPorCotizacion=true" +
                            "&descuento=" + $(
                                "#descuento").val() + "&neto=" + $(
                                    "#valorNeto").val() + "&eliminar=true&precio=" + precio);
                    }
                })
            })
        }
    })
}

function enviarCotizacion() {
    let rut = document.getElementById('rut').value;
    console.log(rut);
    if (rut == "") {
        alert('Ingrese Algun usuario');
    } else {
        let email = $("#input-email").val();
        let neto = document.getElementById('valorNeto').value
        let descuento = $("#descuento").val();
        let netoDescuento = neto - descuento;
        let iva = neto * 0.19;
        let total = (iva = neto * 0.19) + (neto - descuento);

        Swal.fire({
            title: '¿Está seguro?',
            text: "La cotizacion sera notificada",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, notificar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.post("./app/controllers/cotizacionesController.php", {
                    neto: neto,
                    descuento: descuento,
                    netoDescuento,
                    iva: iva,
                    email: email,
                    total: total,
                    enviarCotizacion: true
                }).done(function (data) {
                    console.log(data)
                    Swal.fire(
                        'Listo!',
                        'La cotizacion fue notificada con éxito',
                        'success'
                    ).then(() => {
                       window.location.href = 'crear-cotizacion'

                    })
                })
            }
        })
    }
}
function eliminarRodenstock(Id, precio) {
    console.log(Id)
    console.log(precio)
    Swal.fire({
        title: '¿Está seguro?',
        text: "El rodenstock  sera eliminado",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/rodenstockCotizacionesController.php", {
                rodenstocks: Id,
                eliminarRodenstock: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El rodenstock fue eliminado con éxito',
                    'success'
                ).then(() => {
                   
                    if ($("#filtroRodenstock").val() === "ingresarRodenstockUsuario") {
                        $("#divFiltroRodenstock").load("./rodenstock-cotizaciones.php?obtenerRodenstock=true&obtenerRodenstockPorUsuario=true" + "&usuario=" + $(
                                "#usuario").val() + "&descuento=" + $(
                                    "#descuento").val() + "&neto=" + $(
                                        "#valorNeto").val()+ "&reliminar=true&precio=" + precio);
                    }
                    if ($("#filtroRodenstock").val() === "ingresarRodenstockCotizacion") {
                        console.log("Valor neto2: " + $("#valorNeto").val())
                        $("#divFiltroRodenstock").load("./rodenstock-cotizaciones.php?cotizacion=" + $("#cotizacion").val() + "&obtenerRodenstockPorCotizacion=true" +
                            "&descuento=" + $(
                                "#descuento").val() + "&neto=" + $(
                                    "#valorNeto").val()+ "&reliminar=true&precio=" + precio);
                    }
                })
            })
        }
    })
}

$("#formAddCristales").submit(function () {
    $.post("./app/controllers/cristalesCotizacionesController.php", $("#formAddCristales").serialize())
        .done(function (data) {
            console.log(data)
            let neto = document.getElementById('valorNeto').value;
            let descuento = $("#descuento").val();
            neto += parseInt(data)
            document.getElementById('descuentos').innerHTML = descuento;
            document.getElementById('neto_con_descuento').innerHTML = neto - descuento;
            document.getElementById('iva').innerHTML = (neto - descuento) * 0.19;
            document.getElementById('total').innerHTML = ((neto - descuento) * 0.19) + ((neto - descuento) * 0.19);
            if ($("#filtroCristales").val() === "ingresarCristalUsuario") {
                $("#cristalesCotizacion").load("./cristales-cotizaciones.php?filtro=" + $(
                    "#filtroCristales").val() + "&obtenerCristalesPorUsuario=true" + "&usuario=" + $(
                        "#usuario").val() + "&descuento=" + $(
                            "#descuento").val() + "&neto=" + $(
                                "#valorNeto").val());
            }
            if ($("#filtroCristales").val() === "ingresarCristalCotizacion") {
                console.log("Valor neto2: " + $("#valorNeto").val())
                $("#cristalesCotizacion").load("./cristales-cotizaciones.php?cotizacion=" + $("#cotizacion").val() + "&obtenerCristalesPorCotizacion=true" +
                    "&descuento=" + $(
                        "#descuento").val() + "&neto=" + $(
                            "#valorNeto").val());
            }
            $("#formAddCristales")[0].reset();
        })
    return false;
})


$("#labProductAdicional").change(function () {
    let laboratorioId = $(this).val();
    $("#productoAdicional").load("./select-productos-adicionales.php?laboratorio=" + laboratorioId);
})

function seleccionarCristal(precioCristalId) {
    var options = document.getElementById("precio_cristal").options;
    $('#precio_cristal').selectize()[0].selectize.destroy();
    for (var i = 0; i < options.length; i++) {
        if (options[i].value == precioCristalId) {
            options[i].selected = true;
            break;
        }
    }
    $('#precio_cristal').selectize({
        sortField: 'text',
        placeholder: "Seleccione...",
    });
    $('#modalCristalesPlenocentro').modal('toggle');
}

$("#formAddrodenstock").submit(function () {
    $.post("./app/controllers/rodenstockCotizacionesController.php", $("#formAddrodenstock").serialize())
        .done(function (data) {
            console.log(data)
            let neto = document.getElementById('valorNeto').value;
            let descuento = $("#descuento").val();
            neto += parseInt(data)
            document.getElementById('descuentos').innerHTML = descuento;
            document.getElementById('neto_con_descuento').innerHTML = neto - descuento;
            document.getElementById('iva').innerHTML = (neto - descuento) * 0.19;
            document.getElementById('total').innerHTML = ((neto - descuento) * 0.19) + ((neto - descuento) * 0.19);
            if ($("#filtroRodenstock").val() === "ingresarRodenstockUsuario") {
                $("#divFiltroRodenstock").load("./rodenstock-cotizaciones.php?obtenerRodenstock=true&obtenerRodenstockPorUsuario=true" + "&usuario=" + $(
                        "#usuario").val() + "&descuento=" + $(
                            "#descuento").val() + "&neto=" + $(
                                "#valorNeto").val());
            }
            if ($("#filtroRodenstock").val() === "ingresarRodenstockCotizacion") {
                console.log("Valor neto2: " + $("#valorNeto").val())
                $("#divFiltroRodenstock").load("./rodenstock-cotizaciones.php?cotizacion=" + $("#cotizacion").val() + "&obtenerRodenstockPorCotizacion=true" +
                    "&descuento=" + $(
                        "#descuento").val() + "&neto=" + $(
                            "#valorNeto").val());
            }
            $("#formAddrodenstock")[0].reset();
        })
    return false;
})
