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
                        Pages
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="./index.php">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Tabla</span>  
                        </a>                                                                                            
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./formulario.php">
                            <i class="align-middle" data-feather="bar-chart-2"></i> <span
                                class="align-middle">Ejercicios</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="./botones.php">
                            <i class="align-middle" data-feather="bar-chart-2"></i> <span
                                class="align-middle">Contenido Teorico</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Login</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="logearse.php">logearse</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="registro.php">registro</a></li>
                        </ul>
                    </li>

        </nav>

        <div class="main">
            <?php include './nav.php' ?>
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Index</strong></h3>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                                    <li class="breadcrumb-item"><a href="#">EzMath</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">INDEX</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <div class="card flex-fill p-4">
                                <h4>Botones</h4>
                                <hr>
                                <div class="mb-3">
                                    <button class="btn btn-success btn-xs" onclick="aceptar()"><i
                                            class="align-middle me-2" data-feather="check"></i> <span
                                            class="align-middle">Aceptar/Enviar</span></button>
                                    <button class="btn btn-danger btn-xs" onclick="ELIMINAR(1)"><i
                                            class="align-middle me-2" data-feather="x"></i> <span
                                            class="align-middle">Eliminar</span></button>
                                    <button class="btn btn-info btn-xs" onclick="generarOT(1)"><i
                                            class="align-middle me-2" data-feather="info"></i> <span
                                            class="align-middle">info/Abrir</span></button>
                                </div>
                            </div>
                        </div>

            </main>
            <?php include './footer.php' ?>  
        </div>
    </div>

    <?php include './global-CDNS.php' ?>
    <script src="./app/script/data-tables.js"></script>
    <script src="js/app.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    <script>
    function aceptar() {
        Swal.fire(
            'Listo!',
            'A agregado o aceptado un objeto',
            'success'
        ).then(() => {
            window.location.href = './botones.php'
        })
    }

    function ELIMINAR(file) {
        Swal.fire({
            title: '¿Está seguro?',
            text: "EL objeto se eliminara o quedara fuera de operaciones",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar/deshabilitar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.post("./app/controllers/pruebaControllers.php", {
                    armazon: file,
                    eliminarprueba: true
                }).done(function(data) {
                    console.log(data)
                    Swal.fire(
                        'Listo!',
                        'El objeto se elimino/deshabilito con exito',
                        'success'
                    ).then(() => {
                        window.location.href = './botones.php'
                    })
                })
            }
        })
    }
    </script>
</body>

</html>