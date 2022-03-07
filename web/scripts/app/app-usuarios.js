$("#tableUsuarios").DataTable({
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
let usuarios;
$.post("./app/controllers/usuariosController.php", {
    obtenerusuarios: true
}).done(function (data) {
    usuarios = JSON.parse(data)
}).then(() => {
    $.each(usuarios, function (key, value) {
        console.log("#formEditarUsuario" + value.usuario_id)
        $("#formEditarUsuario" + value.usuario_id).submit(function () {
            $.post("./app/controllers/usuariosController.php", $("#formEditarUsuario" + value.usuario_id).serialize())
            .done(function(data){
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El usuario fue editado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'usuarios'
                })
            })
            return false;
        })
    });
})
let usuario;
$.post("./app/controllers/usuariosController.php", {
    obtenerusuarios: true
}).done(function (data) {
    usuario = JSON.parse(data)
}).then(() => {
    $.each(usuario, function (key, value) {
        console.log("#formEditarContraseña" + value.usuario_id)
        $("#formEditarContraseña" + value.usuario_id).submit(function () {
            $.post("./app/controllers/usuariosController.php", $("#formEditarContraseña" + value.usuario_id).serialize())
            .done(function(data){
                console.log(data)
                if(data == ''){
                    Swal.fire(
                        'Listo!',
                        'La contraseña fue editada con éxito',
                        'success'
                    ).then(() => {
                        window.location.href = 'usuarios'
                    })
                }
                else{
                     Swal.fire(
                        'Listo!',
                        data,
                        'error'
                    )
                }
               
            })
            return false;
        })
    });
})


$("#formNuevoUsuario").submit(function() {
    $.post("./app/controllers/usuariosController.php", $("#formNuevoUsuario").serialize())
        .done(function(data) {
            console.log(data)
            if (data != '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data
                })
            } else {
                Swal.fire(
                    'Listo!',
                    'El usuario fue ingresado con éxito!',
                    'success'
                ).then(() => {
                    window.location.href = 'usuarios'
                })
            }

        })
    return false;
})

let estadoFormUsuario = false;

function agregarUsuario() {
    if (estadoFormUsuario) {
        $("#formNuevoUsuario").hide(500);
        estadoFormUsuario = false;
    } else {
        $("#formNuevoUsuario").show(500);
        estadoFormUsuario = true;
    }
}
function habilitarUsuario(usuarioId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El usuario quedará disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, habilitar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/usuariosController.php", {
                usuario: usuarioId,
                habilitarUsuario: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El usuario fue habilitado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'usuarios'
                })
            })
        }
    })
}
function deshabilitarUsuario(usuarioId) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El usuario quedará disponible para operaciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, deshabilitar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/usuariosController.php", {
                usuario: usuarioId,
                deshabilitarUsuario: true
            }).done(function (data) {
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El usuario fue habilitado con éxito',
                    'success'
                ).then(() => {
                    window.location.href = 'usuarios'
                })
            })
        }
    })
}