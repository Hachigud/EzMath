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
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/modal.css" rel="stylesheet">
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
                                class="align-middle">Contenido teorico</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Login</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="./logearse.php">logearse</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="./registro.php">registro</a></li>
                        </ul>
                    </li>

        </nav>

        <div class="main">
            <?php include './nav.php' ?>
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Ejercicio x Materia</strong></h3>
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




             <div name="Pregunta" >   <p> Pregunta Numero X </p>  
             <br>
             <h2> La siguiente imagen presenta un problema, resuelvalo </h2> 
            
             <img  src=img/Problemas/Problema_Prueba.png> </a>
            
             <div > 
            <p> ¿Necesitas una pizarra?</p>    
            <button type="submit" class="btn btn-outline-success" onclick="MostrarPizarra()" id="BotonPizarra" name="BotonPizarra"> Pizarra</button>  


            <p style="margin-top: 20px; display: none"> ¿Necesitas Ayuda?</p> 
            <button type="button" class="btn btn-outline-success"  id="BotonPizarra"  data-open="modal1" >
            Solución
         </button>



            <div id="Pizarra">
            <button type="submit"  class="btn btn-outline-success" value="Cerrar"  id="BotonCerrarPizarra" onclick="CerrarPizarra()"> Cerrar Pizarra </button> 
            <section id="pizarra">
                color de linea: <input type="color" onchange="colorLinea(this)">
                ancho de linea:  <input type="range" onchange="anchoLinea(this)" max="200" min="1" value="1"><span id="valor">1</span>
                <input type="button" class="btn btn-outline-info" value="Limpiar" onclick="limpiar()"> 
                
            </section>
            <canvas id="canvas" width ="800" height="500">
                No funciona
            </canvas>


            </div>
            </div>


            </div>

                <br>
            <div class="quiz-container">
                <p class="form-label">Seleccione la alternativa correcta: </p>
                 <br>
                 <ul>
                 <li> 
                     <input type="radio" id="a" value="a" name="respuesta">  
                     <label for="a"> 13 </label>
                </li> 
                <li> 
                    
                     <input type="radio" id="b" value="b" name="respuesta">  
                     <label for="b">21</label>
                </li> 
                <li> 
                     <input type="radio" id="c" value="c" name="respuesta">  
                     <label for="c">10</label>
                </li> 
                <li> 
                     <input type="radio" id="d"  value="d" name="respuesta">  
                     <label for="d">20</label>
                </li> 
                </ul>   
                <button type="submit" class="btn btn-outline-dark" id="BotonPregunta" name="BotonPregunta"> Siguiente </button>                    
            </div>


            <div class="modal" id="modal1" data-animation="slideInOutLeft">
  <div class="modal-dialog">
    <header class="modal-header">
      Solución Ejercicio X
      <button  class="close-modal" aria-label="close modal" data-close>
        ✕  
      </button>
    </header>
    <section  class="modal-content">
    <div id="VideoId">

    <iframe id="VideoId" width="560" height="315" src="https://www.youtube.com/embed/4PhD3vetuvQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </section>
    <footer class="modal-footer">
      
    </footer>
  </div>
</div>

            

            </main>


            <?php include './footer.php' ?>
        </div>
    </div>





    <?php include './global-CDNS.php' ?>
    <script src="./app/script/data-tables.js"></script>
    <script src="js/app.js"></script>
    <script src="./app/script/app.js"></script>
    <script src="./app/script/scriptModal.js"></script>
  
    <script type= "text/javascript">
        function MostrarPizarra(){
            document.getElementById('Pizarra').style.display = 'block';
        }
        function CerrarPizarra(){
            document.getElementById('Pizarra').style.display = 'none';
        }
    </script>



</body>

</html>