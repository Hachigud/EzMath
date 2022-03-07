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

    <title>Inicio Sesion | EzMath</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Bienvenido</h1>
                            <p class="lead">
                                Inicia sesion para continuar
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="src/img/avatars/Logo.png" alt="logo"
                                            class="img-fluid rounded-circle" width="132" height="132" />
                                    </div>
                                    <form id="Login">
                                        <div class="mb-3">
                                            <label class="form-label">Correo</label>                                          
                                            <input type="hidden" name="loguear" value="1"> 
                                                                               
                                            <input class="form-control form-control-lg" type="email" name="Correo" id="Correo"
                                                placeholder="Ingrese su correo" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Contraseña</label>
                                             
                                            <input class="form-control form-control-lg" type="password" name="Clave" id="Clave"
                                                placeholder="Ingrese su contraseña" />
                                            <small>
                                                <a hidden href="#">¿olvido su contraseña?</a>
                                            </small>
                                        </div>
                                        <div>
                                            <label class="form-check">
                                                
                                                <span class="form-check-label">
                                                    ¿No tienes una cuenta? Que esperas crea una <a href="registro.php"> AQUI! </a>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="text-center mt-3">
                                        <input type="submit" class="btn btn-outline-primary" value="Ingresar"><br><br>
                                            <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
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

    <script src="js/app.js"></script>
    <?php include './global-CDNS.php' ?>
    <script>
        $("#Login").submit(function() {
            $.post("./app/controllers/usuarioController.php", $("#Login").serialize())
                .done(function(data) {
                    console.log(data)
                    if (data == 'true') {   
                        
                        window.location.href = './index.php'
                    } else {
                        Swal.fire(
                            'Ups!',
                            'Error en la contraseña o correo',
                            'error'
                        ).then(() => {
                            window.location.href = 'logearse.php'
                        });
                    }
                })
            return false;
        })
    </script>
</body>

</html>