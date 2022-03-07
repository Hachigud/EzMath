<?php
require './app/models/Usuario.php';
$indicador1 = 'Usuarios';
$indicador2 = 'gestionar-usuarios';
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

    <title>Registro | EzMath</title>  

    <link href="./css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Empezemos</h1>
                            <p class="lead">
                               Registrate para entrar a la plataforma.
                            </p>
                        </div>

                        <div  class="card" >
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <form id="usuario">
                                        <div class="mb-3">
                                            <label for=""class="form-label">Nombre</label>
                                            <input type="hidden" name="ingresarUsuario" value="1">
                                            <input class="form-control form-control-lg" type="text" id="Nombre" name="Nombre"
                                                placeholder="Ingrese su nombre"    onchange="validarNombreUsuario()" required/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Apellido Paterno</label>
                                            <input class="form-control form-control-lg" type="text" id="ApellidoPaterno" name="ApellidoPaterno"
                                                placeholder="Ingrese su apellido paterno" onchange="validarapellidoPaternoUsuario()" required/>
                                        </div>
                                        <div class="mb-3">
                                            <label for ="" class="form-label">Apellido Materno</label>
                                            <input class="form-control form-control-lg" type="text" id="ApellidoMaterno" name="ApellidoMaterno"
                                                placeholder="Ingrese su apellido Materno" onchange="validarapellidoMaternoUsuario()" required />
                                        </div>

                                        <div class="mb-3">
                                            <label  for= "" class="form-label">Correo</label>
                                            <input class="form-control form-control-lg" type="email" id="Correo" name="Correo"
                                                placeholder="Ingrese su correo" onchange="validarEmail()" required />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Edad</label>
                                            <input class="form-control form-control-lg" type="number" min="8" pattern="^[0-9]+"  onchange="validarEdad()" id= "Edad" name="Edad"
                                                placeholder="Ingrese su edad"  required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Contraseña</label>
                                            <input class="form-control form-control-lg" type="password"  onchange="validarContraseña()" id= "Contraseña" name="Contraseña"
                                                placeholder="Ingrese su contraseña"  required/>
                                        </div>
                                      
                                        <div class="mb-3">
                                            <label class="form-label">Sexo: </label>
                                            <input type="radio"  name="Sexo" value="H" /> Hombre
                                            <input type="radio"  name="Sexo" value="M" /> Mujer
                                        </div>

                                        <span class="form-check-label">
                                                    ¿Ya tienes una cuenta? click <a href="logearse.php"> AQUI! </a>
                                                </span>
                                        <div class="text-center mt-3">

                                            <input type="submit" class="btn btn-outline-primary" value="Registrarse">
                                            <!-- <button type="submit" class="btn btn-lg btn-primary">Sign up</button> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php include './global-CDNS.php' ?>
    <?php include './validadores.php' ?>
    <script src="./js/app.js"></script>
    <script src="./app/script/data-tables.js"></script>
    <script src="./app/script/gestionar-usuarios.js"></script>
</body>

</html>