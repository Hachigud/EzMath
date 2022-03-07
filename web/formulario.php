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
                                class="align-middle">Contenido teorico</span>
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
                                <h4>Formulario</h4>
                                <hr>
                                <form>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text">We'll never share your email with anyone
                                            else.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Default file input example</label>
                                        <input class="form-control" type="file" id="formFile">
                                    </div>
                                    <button type="submit" class="btn btn-success">enviar</button>
                                </form>
                            </div>
                        </div>
            </main>
            <?php include './footer.php' ?>
        </div>
    </div>

    <?php include './global-CDNS.php' ?>
    <script src="./app/script/data-tables.js"></script>
    <script src="js/app.js"></script>



</body>

</html>