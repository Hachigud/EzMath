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
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./Graficos.php">
                        <i class="fas fa-chart-area""></i> <span
                                class="align-middle">Graficas</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
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
                            <h3><strong>Usuarios</strong></h3>
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
                            <div class="card flex-fill p-4 table-responsive">


                                <h4>EzMath</h4>


                                <hr>
                                <table id="table_id"  data-page-length='10' class="display">
                                    <thead>
                                        <tr>
                                            <th> <p align="center">Nombre </p></th>
                                            <th><p align="center">Apellido paterno </p></th>
                                            <th><p align="center">Apellido Materno </p></th> 
                                            <th><p align="center">Correo </p></th>  
                                            <th><p align="center">Sexo </p></th>       
                                            <th><p align="center">Edad </p></th>
                                            <th><p align="center">Eliminar Usuario</p></th>      
                                            <th><p align="center">Niveles Completados</p></th>
                                                               
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($usuarios as $row) { ?>
                                                <tr>
                                                    <td><?= $row->nombre?></td>
                                                    <td><?= $row->apellido_paterno?></td>
                                                    <td><?= $row->apellido_materno?></td>
                                                    <td><?= $row->correo_usuario?></td>
                                                    <td><?= $row->sexo?></td>
                                                    <td><?= $row->edad?></td>
                                                    <td>
                                                        <button class="btn btn-danger"
                                                        onclick="borrarUsuario(<?= $row->id_usuario ?>)">Eliminar Usuario</button> 
                                                </td>

                                                    <?php $Ncompletado = Usuario::NivelesCompletados($row->id_usuario)?>

                                                    <td> <?php foreach ($Ncompletado as $row) { ?> 
                                                        <?= $row->contador?>
                                                      
                                                        <?php } ?>
                                                    </td>


                                            </tr>                                               
                                                
                                            <?php } ?>
                                    </tbody>
                                </table>
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

</body>

</html>






