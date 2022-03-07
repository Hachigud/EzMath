<?php
session_start();
if (!isset($_SESSION["Correo"])) {
    header("Location: logearse.php");
    
}
$email = $_SESSION["Correo"];
$indicador1 = 'index';
require './app/models/materia.php';
require './app/models/Usuario.php';
$materia= Materias::obtenerMateria();
$usuarioNombre=Usuario::obtenerUsuarioPorEmail($email)->nombre." ".Usuario::obtenerUsuarioPorEmail($email)->apellido_paterno." ".Usuario::obtenerUsuarioPorEmail($email)->apellido_materno;
$Id_usuario = Usuario::obtenerUsuarioPorEmail($email)->id_usuario;
$usuarioTipo = Usuario::obtenerTipoUsuarioPorId($Id_usuario);
$completa = Usuario::ObtenerCompleta($Id_usuario);
$EstadoA1 = Usuario::ObtenerEstado($Id_usuario, 5);
$EstadoA2 = Usuario::ObtenerEstado($Id_usuario, 6);
$EstadoA3 = Usuario::ObtenerEstado($Id_usuario, 7);
$EstadoFra1 = Usuario::ObtenerEstado($Id_usuario, 8);
$EstadoFra2 = Usuario::ObtenerEstado($Id_usuario, 9);
$EstadoFra3 = Usuario::ObtenerEstado($Id_usuario, 10);
$EstadoEc1 = Usuario::ObtenerEstado($Id_usuario, 11);
$EstadoEc2 = Usuario::ObtenerEstado($Id_usuario, 12);
$EstadoEc3 = Usuario::ObtenerEstado($Id_usuario, 13);
$EstadoEs1 = Usuario::ObtenerEstado($Id_usuario, 14);
$EstadoEs2 = Usuario::ObtenerEstado($Id_usuario, 15);
$EstadoEs3 = Usuario::ObtenerEstado($Id_usuario, 16);
$EstadoPo1 = Usuario::ObtenerEstado($Id_usuario, 17);
$EstadoPo2 = Usuario::ObtenerEstado($Id_usuario, 18);
$EstadoPo3 = Usuario::ObtenerEstado($Id_usuario, 19);
$EstadoLo1 = Usuario::ObtenerEstado($Id_usuario, 20);
$EstadoLo2 = Usuario::ObtenerEstado($Id_usuario, 21);
$EstadoLo3 = Usuario::ObtenerEstado($Id_usuario, 22);

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
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/EzMath.png"/>







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

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="./index.php">
                        <i class="fas fa-calculator"></i> <span class="align-middle">Ejercicios</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./contenido_teorico.php">
                        <i class="fas fa-book"></i> <span
                                class="align-middle">Contenido Teorico</span>
                        </a>
                    </li>      
                    
                    
                    <?php if($usuarioTipo->tipo_usuario_id == 4): ?>
                        <li class="sidebar-item">
                        <a class="sidebar-link" href="./Reportes.php">
                        <i class="fa fa-flag"></i> <span
                                class="align-middle">Reportes</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./Graficos.php">
                        <i class="fas fa-chart-area""></i> <span
                                class="align-middle">Graficas</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
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
                            <h3><strong>Ejercicios</strong></h3>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                                    <li class="breadcrumb-item"><a href="#">EzMath</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">INICIO</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill p-4 table-responsive">


                                <h4>EzMath</h4>


                                <hr>
                                <table id="table_id" data-page-length='4' class="display">
                                    <thead>
                                        <tr>
                                            <th style="width:13%"><p align="center">Materia </p></th>
                                            <th style="width:13%"> <p align="center">Nivel 1 </p></th>
                                            <th style="width:13%"><p align="center">Nivel 2 </p></th>
                                            <th style="width:13%"> <p align="center">Nivel 3 </p></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                        <td>
                                            <div align="center">
                                            
                                            <img  src=img/Materias/Logaritmos.png> </div>
                                            
                                            
                                            <p align="center">Logaritmos </p></td>

                                            <td><div align="center">
                                            
                                            <?php if ( $EstadoLo1->estado_nivel === "NO" ): ?>
                                                <a href="views/materia/Logaritmos/nivel1/EjercicioLogaritmosNv1_1.php?aux=0"><img  src=img/Niveles/Logaritmoslv1.png> </a>
                                            <?php elseif ( $EstadoLo1->estado_nivel === "SI" ): ?>
                                            <a href="views/materia/Logaritmos/nivel1/EjercicioLogaritmosNv1_1.php?aux=0"><img  src=img/Niveles/Logaritmoslv1Completado.png  title="Nivel completado :)"> </a>                                                
                                            <?php endif; ?>                                                                                                                                                                                                                                                                     
                                          </td> 
                                            <td><div align="center">
                                            <?php if ( $EstadoLo2->estado_nivel === "NO" ): ?>  
                                            <a href="views/materia/Logaritmos/nivel2/EjercicioLogaritmosNv2_1.php?aux=0"><img  src=img/Niveles/Logaritmoslv2.png> </a> 
                                            <?php elseif ( $EstadoLo2->estado_nivel === "SI" ): ?>
                                                <a href="views/materia/Logaritmos/nivel2/EjercicioLogaritmosNv2_1.php?aux=0"><img  src=img/Niveles/Logaritmoslv2Completado.png title="Nivel completado :)"> </a> 
                                            <?php endif; ?> 
                                        </td>
                                             
                                            <td><div align="center">
                                            <?php if ( $EstadoLo3->estado_nivel === "NO" ): ?> 
                                            <a href="views/materia/Logaritmos/nivel3/EjercicioLogaritmosNv3_1.php?aux=0"><img  src=img/Niveles/Logaritmoslv3.png> </a> 
                                            <?php elseif ( $EstadoLo3->estado_nivel === "SI" ): ?>
                                            <a href="views/materia/Logaritmos/nivel3/EjercicioLogaritmosNv3_1.php?aux=0"><img  src=img/Niveles/Logaritmoslv3Completado.png title="Nivel completado :)"> </a> 
                                            <?php endif; ?> 
                                        </td>
                                        </tr>


                                        <tr>
                                            <td>
                                            <div align="center">
                                            <img  src=img/Materias/Algebra.png> </div>
                                           
                                            
                                            <p align="center">Algebra </p></td>


                                            <td><div align="center"> 
                                            <?php if ( $EstadoA1->estado_nivel === "NO" ): ?>                  
                                            <a href="views/materia/Algebra/nivel1/EjercicioAlgebraNv1_1.php?aux=0"><img  src=img/Niveles/Algebralv1.png> </a> 
                                            <?php elseif ( $EstadoA1->estado_nivel === "SI" ): ?>    
                                            <a href="views/materia/Algebra/nivel1/EjercicioAlgebraNv1_1.php?aux=0"><img  src=img/Niveles/Algebralv1Completado.png title="Nivel completado :)"> </a>  
                                            <?php endif; ?>                                      
                                         </td> 


                                            <td><div align="center">
                                            <?php if ( $EstadoA2->estado_nivel === "NO" ): ?>                  
                                            <a href="views/materia/Algebra/nivel2/EjercicioAlgebraNv2_1.php?aux=0"><img  src=img/Niveles/Algebralv2.png> </a> 
                                            <?php elseif ( $EstadoA2->estado_nivel === "SI" ): ?>    
                                            <a href="views/materia/Algebra/nivel2/EjercicioAlgebraNv2_1.php?aux=0"><img  src=img/Niveles/Algebralv2Completado.png title="Nivel completado :)"> </a>  
                                            <?php endif; ?>
                                        </td> 
                                            <td><div align="center">
                                            <?php if ( $EstadoA3->estado_nivel === "NO" ): ?>                  
                                            <a href="views/materia/Algebra/nivel3/EjercicioAlgebraNv3_1.php?aux=0"><img  src=img/Niveles/Algebralv3.png> </a> 
                                            <?php elseif ( $EstadoA3->estado_nivel === "SI" ): ?>    
                                            <a href="views/materia/Algebra/nivel3/EjercicioAlgebraNv3_1.php?aux=0"><img  src=img/Niveles/Algebralv3Completado.png title="Nivel completado :)"> </a>  
                                            <?php endif; ?>
                                        </td> 
                                            
                                        </tr>

                                        <tr>
                                        <td>
                                            <div align="center">
                                            <img  src=img/Materias/Ecuaciones.png> </div>
                                           
                                            
                                            <p align="center">Ecuaciones </p></td>
                                            <td><div align="center">
                                            <?php if ( $EstadoEc1->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Ecuaciones/nivel1/EjercicioEcuacionesNv1_1.php?aux=0"><img  src=img/Niveles/Ecuacioneslv1.png> </a>
                                            <?php elseif ( $EstadoEc1->estado_nivel === "SI" ): ?>
                                                <a href="views/materia/Ecuaciones/nivel1/EjercicioEcuacionesNv1_1.php?aux=0"><img  src=img/Niveles/Ecuacioneslv1Completado.png title="Nivel completado :)"> </a>
                                                <?php endif; ?>  
                                        </td> 
                                            <td><div align="center">
                                            <?php if ( $EstadoEc2->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Ecuaciones/nivel2/EjercicioEcuacionesNv2_1.php?aux=0"><img  src=img/Niveles/Ecuacioneslv2.png> </a>
                                            <?php elseif ( $EstadoEc2->estado_nivel === "SI" ): ?>
                                                <a href="views/materia/Ecuaciones/nivel2/EjercicioEcuacionesNv2_1.php?aux=0"><img  src=img/Niveles/Ecuacioneslv2Completado.png title="Nivel completado :)"> </a>
                                                <?php endif; ?>  
                                        </td> 
                                            <td><div align="center">
                                            <?php if ( $EstadoEc3->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Ecuaciones/nivel3/EjercicioEcuacionesNv3_1.php?aux=0"><img  src=img/Niveles/Ecuacioneslv3.png> </a>
                                            <?php elseif ( $EstadoEc3->estado_nivel === "SI" ): ?>
                                                <a href="views/materia/Ecuaciones/nivel3/EjercicioEcuacionesNv3_1.php?aux=0"><img  src=img/Niveles/Ecuacioneslv3Completado.png title="Nivel completado :)"> </a>
                                                <?php endif; ?>  
                                        </td>
                                        </tr>


                                        <tr>
                                        <td>
                                            <div align="center">
                                            <img  src=img/Materias/Porcentajes.png> </div>
                                           
                                            
                                            <p align="center">Porcentajes </p></td>
                                            <td><div align="center">
                                            <?php if ( $EstadoPo1->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Porcentajes/nivel1/EjercicioPorcentajesNv1_1.php?aux=0"><img  src=img/Niveles/Porcentajeslv1.png> </a>
                                            <?php elseif ( $EstadoPo1->estado_nivel === "SI" ): ?> 
                                                <a href="views/materia/Porcentajes/nivel1/EjercicioPorcentajesNv1_1.php?aux=0"><img  src=img/Niveles/Porcentajeslv1Completado.png title="Nivel completado :)"> </a>
                                                <?php endif; ?>  
                                        </td> 
                                            <td><div align="center">
                                            <?php if ( $EstadoPo2->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Porcentajes/nivel2/EjercicioPorcentajesNv2_1.php?aux=0"><img  src=img/Niveles/Porcentajeslv2.png> </a>
                                            <?php elseif ( $EstadoPo2->estado_nivel === "SI" ): ?> 
                                                <a href="views/materia/Porcentajes/nivel2/EjercicioPorcentajesNv2_1.php?aux=0"><img  src=img/Niveles/Porcentajeslv2Completado.png title="Nivel completado :)"> </a>
                                                <?php endif; ?>   
                                        </td> 
                                            <td><div align="center">
                                            <?php if ( $EstadoPo3->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Porcentajes/nivel3/EjercicioPorcentajesNv3_1.php?aux=0"><img  src=img/Niveles/Porcentajeslv3.png> </a>
                                            <?php elseif ( $EstadoPo3->estado_nivel === "SI" ): ?> 
                                                <a href="views/materia/Porcentajes/nivel3/EjercicioPorcentajesNv3_1.php?aux=0"><img  src=img/Niveles/Porcentajeslv3Completado.png title="Nivel completado :)"> </a>
                                                <?php endif; ?>  
                                        </td>
                                        </tr>


                                        <tr>
                                        <td>
                                            <div align="center">
                                            <img  src=img/Materias/Estadisticas.png> </div>
                                           
                                            
                                            <p align="center">Estadisticas </p></td>
                                            <td><div align="center">
                                            <?php if ( $EstadoEs1->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Estadistica/nivel1/EjercicioEstadisticaNv1_1.php?aux=0"><img  src=img/Niveles/Estadisticaslv1.png> </a>
                                            <?php elseif ( $EstadoEs1->estado_nivel === "SI" ): ?> 
                                                <a href="views/materia/Estadistica/nivel1/EjercicioEstadisticaNv1_1.php?aux=0"><img  src=img/Niveles/Estadisticaslv1Completado.png title="Nivel completado :)"> </a> 
                                                <?php endif; ?>
                                        </td> 
                                            <td><div align="center">
                                            <?php if ( $EstadoEs2->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Estadistica/nivel2/EjercicioEstadisticaNv2_1.php?aux=0"><img  src=img/Niveles/Estadisticaslv2.png> </a>
                                            <?php elseif ( $EstadoEs2->estado_nivel === "SI" ): ?> 
                                                <a href="views/materia/Estadistica/nivel2/EjercicioEstadisticaNv2_1.php?aux=0"><img  src=img/Niveles/Estadisticaslv2Completado.png title="Nivel completado :)"> </a> 
                                                <?php endif; ?> 
                                        </td> 
                                            <td><div align="center">
                                            <?php if ( $EstadoEs3->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Estadistica/nivel3/EjercicioEstadisticaNv3_1.php?aux=0"><img  src=img/Niveles/Estadisticaslv3.png> </a>
                                            <?php elseif ( $EstadoEs3->estado_nivel === "SI" ): ?> 
                                                <a href="views/materia/Estadistica/nivel3/EjercicioEstadisticaNv3_1.php?aux=0"><img  src=img/Niveles/Estadisticaslv3Completado.png title="Nivel completado :)"> </a> 
                                                <?php endif; ?>
                                        </td> 
                                        </tr>


                                        <tr>
                                        <td>
                                            <div align="center">
                                            <img  src=img/Materias/Fracciones.png> </div>
                                           
                                            
                                            <p align="center">Fracciones </p></td>
                                            <td><div align="center">
                                            <?php if ( $EstadoFra1->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Fracciones/nivel1/EjercicioFraccionesNv1_1.php?aux=0"><img  src=img/Niveles/Fraccioneslv1.png> </a> 
                                            <?php elseif ( $EstadoFra1->estado_nivel === "SI" ): ?>
                                                <a href="views/materia/Fracciones/nivel1/EjercicioFraccionesNv1_1.php?aux=0"><img  src=img/Niveles/Fraccioneslv1Completado.png title="Nivel completado :)"> </a>  
                                                <?php endif; ?>
                                        </td> 
                                            <td><div align="center">
                                            <?php if ( $EstadoFra2->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Fracciones/nivel2/EjercicioFraccionesNv2_1.php?aux=0"><img  src=img/Niveles/Fraccioneslv2.png> </a> 
                                            <?php elseif ( $EstadoFra2->estado_nivel === "SI" ): ?>
                                                <a href="views/materia/Fracciones/nivel2/EjercicioFraccionesNv2_1.php?aux=0"><img  src=img/Niveles/Fraccioneslv2Completado.png title="Nivel completado :)"> </a>  
                                                <?php endif; ?>
                                        </td> 
                                            <td><div align="center">
                                            <?php if ( $EstadoFra3->estado_nivel === "NO" ): ?>
                                            <a href="views/materia/Fracciones/nivel3/EjercicioFraccionesNv3_1.php?aux=0"><img  src=img/Niveles/Fraccioneslv3.png> </a> 
                                            <?php elseif ( $EstadoFra3->estado_nivel === "SI" ): ?>
                                                <a href="views/materia/Fracciones/nivel3/EjercicioFraccionesNv3_1.php?aux=0"><img  src=img/Niveles/Fraccioneslv3Completado.png title="Nivel completado :)"> </a>  
                                                <?php endif; ?>
                                        </tr>
                                       
                                    </tbody>
                                </table>


                                
                            </div>
                        </div>
                        </div>    

            </main>

            <?php include './footer2.php' ?>
        </div>
    </div>

    <?php include './global-CDNS.php' ?>
    <script src="./app/script/data-tables.js"></script>
    <script src="js/app.js"></script>
    <?php include './validadores.php' ?>
   


</body>

</html>