

//ingresar usuario swwet alert
 let usuarios;
$("#usuario").submit(function() {
    $.post("./app/controllers/usuarioController.php", $("#usuario").serialize())
        .done(function(data) {
            console.log(data)
            if (data != '') {
                Swal.fire("Bien hecho!", "El Usuario fue ingresado con éxito!", "success").then(
                    function() {
                        window.location.href = 'logearse.php';
                    });
            } else {
                Swal.fire("ERROR!", "El Usuario no fue registrado con exito!", "error").then(
                    function() {
                        window.location.href = 'registro.php';
                    });
            }
        })
    return false;
})



function borrarUsuario(id) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "El usuario se eliminara para siempre!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.post("./app/controllers/usuarioController.php", {
                usuarioId: id,
                borrarUsuario: true
            }).done(function(data) {
                if(data!=""){
                console.log(data)
                Swal.fire(
                    'Listo!',
                    'El usuario se elimino con exito',
                    'success'
                ).then(() => {
                    window.location.href = './Usuarios.php'
                })
                }else{
                Swal.fire(
                    'ERROR!',
                    'Algo salio mal No se elimino  correctamente',
                    'error'
                ).then(() => {
                    window.location.href = './Usuarios.php'
                })
                    
                }
            })
        }
    })
}