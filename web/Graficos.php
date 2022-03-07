<?php
session_start();
if (!isset($_SESSION["Correo"])) {
    header("Location: logearse.php");
}
$email = $_SESSION["Correo"];
require './app/models/contenidoTeorico.php';
require './app/models/materia.php';
require './app/models/Usuario.php';
require './app/models/Reporte.php';
$Id_usuario = Usuario::obtenerUsuarioPorEmail($email)->id_usuario;
$usuarioNombre=Usuario::obtenerUsuarioPorEmail($email)->nombre." ".Usuario::obtenerUsuarioPorEmail($email)->apellido_paterno." ".Usuario::obtenerUsuarioPorEmail($email)->apellido_materno;
$usuarioTipo = Usuario::obtenerTipoUsuarioPorId($Id_usuario);
if ($usuarioTipo->tipo_usuario_id != 4){
    header("Location: index.php");
}
$usuarios = Usuario::obtenerUsuarios();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/EzMath.png"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>EzMath</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.php">
                    <span class="align-middle">EzMath</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Paginas
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./index.php">
                        <i class="fas fa-calculator"></i> <span
                                class="align-middle">Ejercicios</span>
                        </a>
                    </li>


         
                    <li class="sidebar-item ">
                        <a class="sidebar-link" href="./contenido_teorico.php">
                        <i class="fas fa-book"></i> <span class="align-middle">Contenido Teorico</span>
                        </a>
                    </li>

                    <?php if($usuarioTipo->tipo_usuario_id == 4): ?>
                        <li class="sidebar-item ">
                        <a class="sidebar-link" href="./Reportes.php">
                        <i class="fa fa-flag"></i> <span
                                class="align-middle">Reportes</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="./Graficos.php">
                        <i class="fas fa-chart-area""></i> <span
                                class="align-middle">Graficas</span>
                        </a>
                    </li>
                    <li class="sidebar-item ">
                        <a class="sidebar-link" href="./Usuarios.php">
                        <i class="fas fa-users""></i> <span
                                class="align-middle">Usuarios</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./SesionDestroy.php">
                        <i class="fa fa-user-times"></i> <span
                                class="align-middle">Cerrar Sesion</span>
                        </a>
                    </li>

        </nav>

        <div class="main">
            <?php include './nav2.php' ?>
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Graficos</strong></h3>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                                    <li class="breadcrumb-item"><a href="#">EzMath</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="index.php">INICIO</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill p-4">


                                <h4>EzMath</h4>

                                <div style=" display: flex; justify-content: space-around; " >
                            <div class="col-lg-2" >
                            <button  class="btn btn-outline-dark" onclick="CargarDatosGraficoReporte()"> Niveles Reportados </button>   
                             </div>
                             
                            <div class="col-lg-2" >
                            
                            <button  class="btn btn-outline-dark" onclick="CargarDatosGraficoNiveles()"> Niveles Completados</button>   
                             </div>
                             <div class="col-lg-2" >
                            
                            <button  class="btn btn-outline-dark" onclick="CargarDatosGraficoFallas()"> Fallos por nivel</button>   
                             </div>
                             </div>
                             
                             <div>  
                             <br>    
                             <div class="col-lg-2"  >
                             <a id="download" style="display: none;">
                             <p><a  class="btn btn-outline-secondary" style = " display:none " id="btnDownload1" download="Niveles_Reportados.png" href="">Descargar grafico</a></p>   
                            </a>
                        </div>
                        <div class="col-lg-2"  >
                             <a id="download" style="display: none;">
                             <p><a  class="btn btn-outline-secondary" style = "  display:none " id="btnDownload2" download="Niveles_Completados.png" href="">Descargar grafico</a></p>   
                            </a>
                        </div>
                        <div class="col-lg-2"  >
                             <a id="download" style="display: none;">
                             <p><a  class="btn btn-outline-secondary" style = "  display:none " id="btnDownload3" download="Fallos_Por_Nivel.png" href="">Descargar grafico</a></p>   
                            </a>
                        </div>
                        </div>
                            <div id= "chartReport">                      
                                <canvas id="GraficoReportes" width="400" height="400"></canvas>
                                <canvas id="GraficoNiveles" width="400" height="400"></canvas>
                                <canvas id="GraficoFallas" width="400" height="400"></canvas>
                            </div>
                        </div>
                        </div>
                        
                        </div>
                        
            </main>

            <?php include './footer2.php' ?>
        </div>
    </div>

    <?php include './global-CDNS.php' ?>
    <script src="./app/script/data-tables.js"></script>
    <script src="./app/script/gestionar-usuarios.js"></script>
    <script src="js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.1/chart.min.js" integrity="sha512-O2fWHvFel3xjQSi9FyzKXWLTvnom+lOYR/AUEThL/fbP4hv1Lo5LCFCGuTXBRyKC4K4DJldg5kxptkgXAzUpvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.1/chart.esm.min.js" integrity="sha512-aBIGzXypVlopT791nVFIrrkgZlCOJu3D6jNTxbQCZHa/mD8oMwwBDfs0rrdmu6hgp+CXRU/u0J7OkQuGPNwFtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.1/helpers.esm.min.js" integrity="sha512-Tr7rEJNzZS8JWzmaQbTL/99DQDgnsklnYBH+mXNvbngHVHPP0hhb2cjWLbFjyKTqE8QZXmEtgC1WDPKZwcrYEw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>




    <script>
function CargarDatosGraficoReporte(){
    document.querySelector("#chartReport").innerHTML = '<canvas id="GraficoReportes"></canvas>';
    $.ajax({
        url:'./app/controllers/GraficoController.php',
        type: 'POST'
    }).done(function(resp){
        if(resp.length>0){
        var titulo = [];
        var cantidad = [];
        var colores = [];
        var data = JSON.parse(resp);
        for(var i =0; i<data.length; i++){
            titulo.push(data[i][1]);
            cantidad.push (data[i][2])
            colores.push(colorRGB());
        }

        CrearGrafico(titulo,cantidad,colores,'bar','Cantidad reportes por nivel','GraficoReportes');
        document.getElementById("btnDownload1").style.display="block";
        document.getElementById("btnDownload2").style.display="none";
        document.getElementById("btnDownload3").style.display="none";
        document.getElementById("GraficoNiveles").style.display="none";
        document.getElementById("GraficoFallas").style.display="none";
        document.getElementById("GraficoReportes").style.display="block";
    }
    })
}


function CargarDatosGraficoNiveles(){
    document.querySelector("#chartReport").innerHTML = '<canvas id="GraficoNiveles"></canvas>';
    $.ajax({
        url:'./app/controllers/GraficoController2.php',
        type: 'POST'
    }).done(function(resp){
        if(resp.length>0){
        var titulo = [];
        var cantidad = [];
        var colores = [];
        var data = JSON.parse(resp);
        for(var i =0; i<data.length; i++){
            titulo.push(data[i][1]);
            cantidad.push (data[i][2])
            colores.push(colorRGB());
        }
        CrearGrafico(titulo,cantidad,colores,'bar','Cantidad Niveles Completados','GraficoNiveles');
        document.getElementById("btnDownload2").style.display="block";
        document.getElementById("btnDownload1").style.display="none";
        document.getElementById("btnDownload3").style.display="none";
        document.getElementById("GraficoReportes").style.display="none";
        document.getElementById("GraficoFallas").style.display="none";
        document.getElementById("GraficoNiveles").style.display="block";
    }
    })
}

function CargarDatosGraficoFallas(){
    document.querySelector("#chartReport").innerHTML = '<canvas id="GraficoFallas"></canvas>';
    $.ajax({
        url:'./app/controllers/GraficoController3.php',
        type: 'POST'
    }).done(function(resp){
        if(resp.length>0){
        var titulo = [];
        var cantidad = [];
        var colores = [];
        var data = JSON.parse(resp);
        for(var i =0; i<data.length; i++){
            titulo.push(data[i][1]);
            cantidad.push (data[i][0])
            colores.push(colorRGB());
        }

        CrearGrafico(titulo,cantidad,colores,'bar','Cantidad fallas por nivel','GraficoFallas');
        document.getElementById("btnDownload3").style.display="block";
        document.getElementById("btnDownload2").style.display="none";
        document.getElementById("btnDownload1").style.display="none";
        document.getElementById("GraficoNiveles").style.display="none";
        document.getElementById("GraficoReportes").style.display="none";
        document.getElementById("GraficoFallas").style.display="block";
    }
    })
}


function CrearGrafico(titulo,cantidad,colores,tipo, encabezado,char){
    const ctx = document.getElementById(char);
const myChart = new Chart(ctx, {
    type: tipo,
    data: {
        labels: titulo,
        datasets: [{
            label: encabezado,
            data: cantidad,
            backgroundColor:colores,
            borderColor: colores,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
}


function generarNumero(numero){
	return (Math.random()*numero).toFixed(0);
    }

    function colorRGB(){
        var valor = 0.3;
        var coolor = "("+generarNumero(255)+"," + generarNumero(255) + "," + generarNumero(255) + "," + 0.3 +")";
        return "rgb" + coolor;
    }
</script>

<script>
document.getElementById("btnDownload1").addEventListener('click', function(){  
  var base64_url = document.getElementById("GraficoReportes").toDataURL("image/png");    
  this.href = base64_url;
});
</script>
<script>
document.getElementById("btnDownload2").addEventListener('click', function(){  
  var base64_url = document.getElementById("GraficoNiveles").toDataURL("image/png");    
  this.href = base64_url;
});
</script>
<script>
document.getElementById("btnDownload3").addEventListener('click', function(){  
  var base64_url = document.getElementById("GraficoFallas").toDataURL("image/png");    
  this.href = base64_url;
});
</script>
</body>

</html>

