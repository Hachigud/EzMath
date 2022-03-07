
     
  let reportes;
     function borrarReporte(id) {
        Swal.fire({
            title: '¿Está seguro?',
            text: "El reporte se eliminara para siempre!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.post("./app/controllers/PreguntaController.php", {
                    reporteId: id,
                    borrarReporte: true
                }).done(function(data) {
                    if(data!=""){
                    console.log(data)
                    Swal.fire(
                        'Listo!',
                        'El reporte se elimino con exito',
                        'success'
                    ).then(() => {
                        window.location.href = 'Reportes.php'
                    })
                    }else{
                    Swal.fire(
                        'ERROR!',
                        'Algo salio mal No se elimino  correctamente',
                        'error'
                    ).then(() => {
                        window.location.href = 'Reportes.php'
                    })
                        
                    }
                })
            }
        })
    }