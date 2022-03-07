let estadoFormNuevaAccion = false;
let estadoFormNuevaLlamada = false;
let estadoFormNuevaNota = false;
let estadoFormNuevoArchivo = false;
/* $("#estado_accion").change(function() {
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Estado Actualizado',
        showConfirmButton: false,
        timer: 1500
    })
}) */
// setUp

$.post("./app/controllers/clientesController.php", {
    obtenerInformacionBasicahtml: true,
    cliente: $("#cliente").val()
}).done(function (data) {
    console.log(data)
    $("#informacion_basica").html(data)
})

// end SetUp
$("#region").change(function () {
    let comunas = '';
    $('#comuna').selectize()[0].selectize.destroy();
    $("#comuna").empty();
    $.post("./app/controllers/comunasController.php", {
        obtenerComunasPorRegion: true,
        region: $(this).val()
    }).done(function (data) {
        comunas = JSON.parse(data)
    }).then(() => {
        $.each(comunas, function (key, value) {
            $("#comuna").append($("<option>").attr('value', value.comuna_id).text(value.nombre_comuna));
        });
        $('#comuna').selectize({
            sortField: 'text',
            placeholder: "Comuna...",
        });
    })
})


function agregarAccion() {
    if (estadoFormNuevaAccion) {
        $("#divFormNuevaAccion").hide(500);
        estadoFormNuevaAccion = false;
    } else {
        $("#btnActividad").removeClass("btn-secondary").addClass("btn-primary");
        $("#btnLlamada").removeClass("btn-primary").addClass("btn-secondary");
        $("#btnNota").removeClass("btn-primary").addClass("btn-secondary");
        $("#btnArchivo").removeClass("btn-primary").addClass("btn-secondary");
        $("#divFormNuevaAccion").show(500);
        estadoFormNuevaAccion = true;
        $("#divFormNuevaLlamada").hide(500);
        estadoFormNuevaLlamada = false;
        $("#divFormNuevaNota").hide(500);
        estadoFormNuevaNota = false;
        $("#divFormNuevoArchivo").hide(500);
        estadoFormNuevoArchivo = false;
    }
}

function agendarLlamada() {
    if (estadoFormNuevaLlamada) {
        $("#divFormNuevaLlamada").hide(500);
        estadoFormNuevaLlamada = false;
    } else {
        $("#btnLlamada").removeClass("btn-secondary").addClass("btn-primary");
        $("#btnActividad").removeClass("btn-primary").addClass("btn-secondary");
        $("#btnNota").removeClass("btn-primary").addClass("btn-secondary");
        $("#btnArchivo").removeClass("btn-primary").addClass("btn-secondary");
        $("#divFormNuevaLlamada").show(500);
        estadoFormNuevaLlamada = true;
        $("#divFormNuevaAccion").hide(500);
        estadoFormNuevaAccion = false;
        $("#divFormNuevaNota").hide(500);
        estadoFormNuevaNota = false;
        $("#divFormNuevoArchivo").hide(500);
        estadoFormNuevoArchivo = false;
    }
}

function agregarNota() {
    if (estadoFormNuevaNota) {
        $("#divFormNuevaNota").hide(500);
        estadoFormNuevaNota = false;
    } else {
        $("#btnNota").removeClass("btn-secondary").addClass("btn-primary");
        $("#btnActividad").removeClass("btn-primary").addClass("btn-secondary");
        $("#btnLlamada").removeClass("btn-primary").addClass("btn-secondary");
        $("#btnArchivo").removeClass("btn-primary").addClass("btn-secondary");
        $("#divFormNuevaNota").show(500);
        estadoFormNuevaNota = true;
        $("#divFormNuevaAccion").hide(500);
        estadoFormNuevaAccion = false;
        $("#divFormNuevaLlamada").hide(500);
        divFormNuevaLlamada = false;
        $("#divFormNuevoArchivo").hide(500);
        estadoFormNuevoArchivo = false;
    }
}

function agregarArchivo() {
    if (estadoFormNuevoArchivo) {
        $("#divFormNuevoArchivo").hide(500);
        estadoFormNuevoArchivo = false;
    } else {
        $("#btnArchivo").removeClass("btn-secondary").addClass("btn-primary");
        $("#btnActividad").removeClass("btn-primary").addClass("btn-secondary");
        $("#btnNota").removeClass("btn-primary").addClass("btn-secondary");
        $("#btnLlamada").removeClass("btn-primary").addClass("btn-secondary");
        $("#divFormNuevoArchivo").show(500);
        estadoFormNuevoArchivo = true;
        $("#divFormNuevaNota").hide(500);
        estadoFormNuevaNota = false;
        $("#divFormNuevaAccion").hide(500);
        estadoFormNuevaAccion = false;
        $("#divFormNuevaLlamada").hide(500);
        divFormNuevaLlamada = false;
    }
}


$("#formNuevaAccion").submit(function () {
    $.post("./app/controllers/actividadesController.php", $("#formNuevaAccion").serialize())
        .done(function (data) {
            console.log(data)
            $("#formNuevaAccion")[0].reset()
            Swal.fire(
                'Bien Hecho!',
                'Actividad ingresada con éxito',
                'success'
            ).then(() => {
                window.location.href = 'gestion-cliente?cliente=' + $("#cliente").val() + '&ref=actividades'
            })
        })
    return false;
})

$("#formNuevaLlamada").submit(function () {
    $.post("./app/controllers/llamadasController.php", $("#formNuevaLlamada").serialize())
        .done(function (data) {
            console.log(data)
            $("#formNuevaLlamada")[0].reset()
            Swal.fire(
                'Bien Hecho!',
                'Llamada ingresada con éxito',
                'success'
            ).then(() => {
                window.location.href = 'gestion-cliente?cliente=' + $("#cliente").val() + '&ref=llamadas'
            })
        })
    return false;
})

$("#formAddDireccion").submit(function () {
    $.post("./app/controllers/direccionesController.php", $("#formAddDireccion").serialize())
        .done(function (data) {
            console.log(data)
            $("#formAddDireccion")[0].reset()
            Swal.fire(
                'Bien Hecho!',
                'Dirección ingresada con éxito',
                'success'
            ).then(() => {
                window.location.href = 'gestion-cliente?cliente=' + $("#cliente").val()
            })
        })
    return false;
})

$("#formNuevaNota").submit(function () {
    $.post("./app/controllers/notasController.php", $("#formNuevaNota").serialize())
        .done(function (data) {
            console.log(data)
            $("#formNuevaNota")[0].reset()
            Swal.fire(
                'Bien Hecho!',
                'Nota ingresada con éxito',
                'success'
            ).then(() => {
                window.location.href = 'gestion-cliente?cliente=' + $("#cliente").val() + '&ref=notas'
            })
        })
    return false;
})

$("#formNuevoArchivo").submit(function () {
    var form_data = new FormData();
    $("#ingresarFile").val("Cargando...");
    $("#ingresarFile").prop("disabled", true);
    var ins = document.getElementById('archivo').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("archivos[]", document.getElementById('archivo').files[x]);
    }
    form_data.append("cliente", $("#cliente").val());
    form_data.append("observaciones", $("#observaciones").val());
    form_data.append("subirArchivo", true);
    $.ajax({
        url: './app/controllers/archivosController.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            $("#ingresarFile").val("Ingresar");
            $("#ingresarFile").prop("disabled", false);
            console.log(response)
            Swal.fire(
                'Bien Hecho!',
                'Archivo ingresado con éxito',
                'success'
            )
            $.post("./app/controllers/archivosController.php", {
                cargarTabArchivos: true,
                cliente: $("#cliente").val()
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Bien Hecho!',
                    'Archivo ingresado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'gestion-cliente?cliente=' + $("#cliente").val() + '&ref=archivos'
                })
              //  $("#listArchivos").html(data)
            })
            //$("#formAddClase")[0].reset();
        },
        error: function (response) {
            console.log(response)
        }
    })
    return false;
})

function editarInformacionGeneral(clienteId, nombre, apellido, email, canalIngresoId) {
    let selectCIngresos = '';
    let items = '<div class="row">';
    $.post("./app/controllers/canalesIngresoController.php", {
        obtenerCanalesIngreso: true,
    }).done(function (data) {
        canalesIngresos = JSON.parse(data);
        selectCIngresos += '<div class="col-md-6">';
        selectCIngresos += '<br><label>Canal de Ingreso</label>';
        selectCIngresos += '<select class="form-control" name="canal_ingreso" id="canal_ingreso" required>';
        selectCIngresos += '<option>Seleccione</option>';
        $.each(canalesIngresos, function (key, value) {
            if (value.canal_ingreso_id == canalIngresoId) {
                selectCIngresos += '<option value="' + value.canal_ingreso_id + '" selected>' + value.canal_ingreso + '</option>';
            } else {
                selectCIngresos += '<option value="' + value.canal_ingreso_id + '">' + value.canal_ingreso + '</option>';
            }
        });
        selectCIngresos += '</select>';
        selectCIngresos += '</div>';
        console.log(selectCIngresos);
    }).then(() => {
        items += '<div class="col-md-6">';
        items += '<label>Nombres</label>';
        items += '<input type="text" name="nombres" id="nombres" class="form-control" value="' + nombre + '" required>';
        items += '</div>';
        items += '<div class="col-md-6">';
        items += '<label>Apellidos</label>';
        items += '<input type="text" name="apellidos" id="apellidos" class="form-control" value="' + apellido + '" required>';
        items += '</div>';
        items += '<div class="col-md-6">';
        items += '<br><label>Email</label>';
        items += '<input type="email" name="email" id="email" class="form-control" value="' + email + '" required>';
        items += '</div>';
        items += selectCIngresos;
        items += '</div>';
        Swal.fire({
            title: '<strong>Información Básica</strong><hr>',
            icon: '',
            html: '<br>' +
                items +
                '<input type="hidden" name="editarCliente" value="1">' +
                '<input type="hidden" name="cliente" value="' + clienteId + '">' +
                '<br><br><button type="button" onclick="actualizarInformacionBasica()" class="btn btn-success"><i class="material-icons">edit</i> EDITAR INFORMACIÓN</button>' +
                '',
            showCloseButton: true,
            width: 800,
            showCancelButton: false,
            showConfirmButton: false,
            focusConfirm: false,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Editar Información',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText: '<i class="fa fa-close"></i> Cerrar',
            cancelButtonAriaLabel: 'Thumbs down'
        })
    });
}

function actualizarInformacionBasica() {
    console.log("entra")
    $.post("./app/controllers/clientesController.php", {
        nombres: document.getElementById("nombres").value,
        apellidos: document.getElementById("apellidos").value,
        email: document.getElementById("email").value,
        canal_ingreso: document.getElementById("canal_ingreso").value,
        cliente: document.getElementById("cliente").value,
        editarCliente: true
    }).done(function (data) {
        console.log(data)
        Swal.fire(
            'Listo!',
            'Información básica actualizada!',
            'success'
        )
        $.post("./app/controllers/clientesController.php", {
            obtenerInformacionBasicahtml: true,
            cliente: $("#cliente").val()
        }).done(function (data) {
            console.log(data)
            $("#informacion_basica").html(data)
        })
    })
}


