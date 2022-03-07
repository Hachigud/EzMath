<?php

session_start();
if (!isset($_SESSION["Correo"])) {
    header("Location: ../../../../logearse.php");
}
if($_GET['aux']==''){
    header("Location: EjercicioEstadisticaNv2_2.php?aux=0&Pnivel=1");
}
if($_GET['Pnivel'] != 1 ){
    header("Location: EjercicioEstadisticaNv2_1.php?aux=0");
}
$email = $_SESSION["Correo"];
require '../../../../app/models/materia.php';
require '../../../../app/models/Usuario.php';
$usuarioNombre=Usuario::obtenerUsuarioPorEmail($email)->nombre." ".Usuario::obtenerUsuarioPorEmail($email)->apellido_paterno." ".Usuario::obtenerUsuarioPorEmail($email)->apellido_materno;
$Id_usuario = Usuario::obtenerUsuarioPorEmail($email)->id_usuario;
$usuarioTipo = Usuario::obtenerTipoUsuarioPorId($Id_usuario);
?>
<!DOCTYPE html>
<html lang="en">

    <!-- Bootstrap CSS -->
   
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../../img/icons/EzMath.png"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>EzMath</title>


    
    <link href="../../../../css/app.css" rel="stylesheet">
    <link href="../../../../css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="../../../../index.php">
                    <span class="align-middle">EzMath</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Paginas
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="../../../../index.php">
                        <i class="fas fa-calculator"></i> <span class="align-middle">Ejercicios</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../../../../contenido_teorico.php">
                        <i class="fas fa-book"></i> <span
                                class="align-middle">Contenido teorico</span>
                        </a>
                    </li>
                    <?php if($usuarioTipo->tipo_usuario_id == 4): ?>
                        <li class="sidebar-item">
                        <a class="sidebar-link" href="../../../../Reportes.php">
                        <i class="fa fa-flag"></i> <span
                                class="align-middle">Reportes</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../../../../Graficos.php">
                        <i class="fas fa-chart-area""></i> <span
                                class="align-middle">Graficas</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../../../../Usuarios.php">
                        <i class="fas fa-users""></i> <span
                                class="align-middle">Usuarios</span>
                        </a>
                    </li>
                    <?php endif; ?>
 
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../../../../SesionDestroy.php">
                        <i class="fa fa-user-times"></i> <span
                                class="align-middle">Cerrar Sesion</span>
                        </a>
                    </li>

        </nav>

        <div class="main">
            <?php include '../../../../nav.php' ?>
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Ejercicios Nivel N°2 Estadisticas</strong></h3>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                                    <li class="breadcrumb-item"><a href="#">EzMath</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="../../../../index.php">INICIO</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>


             <div name="Pregunta" >   <p> Pregunta  N°2 Estadisticas </p>  
             <br>
             <h2> Calcule la media de los siguientes datos: 1,3,5,7,10,23,6,8,11 </h2> 
            
             
            
             <div id="PizarraSol" name="PizarraSol" style="display: flex; flex-direction: row;">
             <div id="secPizarra" name= "secPizarra" style="margin-top: 20px;">
            <p> ¿Necesitas una pizarra?</p>    
            <button type="submit" class="btn btn-outline-success" onclick="MostrarPizarra()" id="BotonPizarra" name="BotonPizarra"> Pizarra</button>  
            </div>
            <div style="margin-left: 50px; ">
            <?php 
            $aux2=$_GET['aux'];       
            if($aux2 == 1): ?>
                <p style="margin-top: 20px; "> ¿Necesitas ayuda?</p> 
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal" id="BotonPizarra" name="BotonPizarra">
        Solucion
        </button>
        </div>
    <?php endif; ?>
    </div> 

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Solucion Ejercicio 2 Estadisticas Nivel 2</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">                    
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/vqkZwiFyz3Q" id="iframeVideo"></iframe>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>


            <div id="Pizarra">
            <button type="submit"  class="btn btn-outline-success" value="Cerrar"  id="BotonCerrarPizarra" onclick="CerrarPizarra()"> Cerrar Pizarra </button> 
            <section id="pizarra">
                color de linea: <input type="color" onchange="colorLinea(this)">
                ancho de linea:  <input type="range" onchange="anchoLinea(this)" max="200" min="1" value="1"><span id="valor">1</span>
                <input type="button" class="btn btn-outline-info" value="Limpiar" onclick="limpiar()"> 
                
            </section>
            <canvas id="canvas" width ="800" height="400">
                No funciona
            </canvas>


            </div>
            </div>


            </div>

                <br>
                <form id="Respuesta_ejercicio">
            <div class="quiz-container">
                <p class="form-label">Seleccione la alternativa correcta: </p>
                 <br>
                 <input type="hidden" name="RespuestaPregunta" value="1">
                 <input type="hidden" name="Pregunta" id="Pregunta" value="Pregunta Estadisticas Nivel 2 Ejercicio 2"> 
                 <input type="hidden" name="Nombre_Nivel" id="Nombre_Nivel" value="Estadisticas_Nv2">   
                 <ul id="Respuesta" >
                 <li> 
                     <input type="radio" id="a" value="a" name="respuesta">  
                     <label for="a"> 6.5 </label>
                </li> 
                <li> 
                    
                     <input type="radio" id="b" value="b" name="respuesta">  
                     <label for="b">8.2</label>
                </li> 
                <li> 
                     <input type="radio" id="c" value="c" name="respuesta">  
                     <label for="c">4</label>
                </li> 
                <li> 
                     <input type="radio" id="d"  value="d" name="respuesta">  
                     <label for="d">7</label>
                </li> 
                </ul> 
                  
                <button type="submit" class="btn btn-outline-dark" id="BotonPregunta" name="BotonPregunta" value="Ingresar"> Siguiente </button>                    
            </div>
            </form>

            
            <div style="margin-left: 50px; text-align: right;" >
    
    <p style="margin-top: 110px; "> ¿Algun problema o sugerencia? <br> No dudes en Contactarnos</p> 
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalReport" id="BotonReportar" name="BotonReportar" style="text-align: center;" >
Reportar
</button>
</div>

<div class="modal fade" id="ModalReport" tabindex="-1" role="dialog" aria-labelledby="ModalReport" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Gracias por informarnos!</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">                    
<form id="Respuesta_Report">
<div class="quiz-container">
    <h3 class="form-label">Escriba su reporte o sugerencia aqui </h3>
    <p class="form-label">Muchas gracias por contactarnos :) </p>
     <br>
     <input type="hidden" name="RespuestaReport" value="1">
     <input type="hidden" name="CorreoUsuario" id="CorreoUsuario" value="<?php echo $email ?>"> 
     <input type="hidden" name="Pregunta" id="Pregunta" value="Pregunta Estadistica Nivel 2 Ejercicio 2"> 

     <div class="form-group col-lg-12">
               
     <textarea id="CuerpoReport" name="CuerpoReport" class="form-control" rows="10" ></textarea>
            </div>  
    <button type="submit"  class="btn btn-primary" id="BotonPregunta" name="BotonPregunta" value="Ingresar"> Enviar </button>                    
</div>
</form>    
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>
</div>
</div>
</div>
            </main>


            <?php include '../../../../footer.php' ?>
        </div>
    </div>





    <?php include '../../../../global-CDNS.php' ?>
    <script src="../../../../js/app.js"></script>
    <script src="../../../../app/script/app.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
      //Url del video a reproducir
      var videoSrc='https://www.youtube.com/embed/vqkZwiFyz3Q';

      //Al abrir la ventana modal, le agregué autoplay igual a 1, para que se reproduzca
      //automáticamente, en caso de que no se requiera la autoreproducción, se quita 
      //esa parte "?autoplay=1".
      $('#exampleModal').on('show.bs.modal', function () {  
        var iframe=$('#iframeVideo');
        iframe.attr("src", videoSrc+"?autoplay=1");
      });

      //Al cerrar la ventana modal, solamente reasignamos el video al atributo del iframe
      //y eso ocasiona que se detenga la reproducción del archivo,
      //aunque también podríamos haber dejado el valor src en null. :)
      $('#exampleModal').on('hidden.bs.modal', function (e) {
        
        var iframe=$('#iframeVideo');
        iframe.attr("src", videoSrc);

      });
    </script>
    
    <script type= "text/javascript">
        function MostrarPizarra(){
            document.getElementById('Pizarra').style.display = 'block';
        }
        function CerrarPizarra(){
            document.getElementById('Pizarra').style.display = 'none';
        }
    </script>


<script>
        $("#Respuesta_ejercicio").submit(function() {
            $.post("../../../../app/controllers/PreguntaController.php", $("#Respuesta_ejercicio").serialize())
                .done(function(data) {
                    console.log(data)
                    if (data == 'Nres') { 
                        
                        Swal.fire(
                            'Cuidado!',
                            'Recuerda que Debes escoger una respuesta',
                            'info'
                        ).then(() => {
                            window.location.href = 'EjercicioEstadisticaNv2_2.php?aux=0&Pnivel=1'
                        });
                        
                      
                    }
                    else if (data == 'true') { 
                        
                        Swal.fire(
                            'Correcto!',
                            'La respuesta es Correcta :)',
                            'success'
                        ).then(() => {
                            window.location.href = './EjercicioEstadisticaNv2_3?aux=0.php&Pnivel=1'
                        });
                        
                      
                    } else {
                        Swal.fire(
                            'Ups!',
                            'La respuesta es incorrecta, Intentalo denuevo :(',
                            'error'
                        ).then(() => {
                            window.location.href = 'EjercicioEstadisticaNv2_2?aux=1.php&Pnivel=1'
                        });
                    }
                })
            return false;
        })
    </script>

<script>
$("#Respuesta_Report").submit(function() {
    $.post("../../../../app/controllers/PreguntaController.php", $("#Respuesta_Report").serialize())
        .done(function(data) {
            console.log(data)
            if (data != '') {
                Swal.fire("Muchas Gracias!", "El  Reporte fue Enviado con éxito! :)", "success").then(
                    function() {
                        window.location.href = 'EjercicioEstadisticaNv2_2.php?aux=0&Pnivel=1';
                    });
            } else {
                Swal.fire("Ups!", "El Reporte no  fue Enviado con exito! :(", "error").then(
                    function() {
                        window.location.href = 'EjercicioEstadisticaNv2_2.php?aux=0&Pnivel=1';
                    });
            }
        })
    return false;
})
    </script>
</body>

</html>