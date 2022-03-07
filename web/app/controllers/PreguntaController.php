<?php

if (isset($_POST["RespuestaPregunta"])) {
    require '../models/Preguntas.php';
    $Pregunta= filter_input(INPUT_POST, 'Pregunta', FILTER_SANITIZE_STRING);
    $respuesta= filter_input(INPUT_POST, 'respuesta', FILTER_SANITIZE_STRING);
    $nombre_nivel = filter_input(INPUT_POST, 'Nombre_Nivel', FILTER_SANITIZE_STRING);
    $id_nivel = Preguntas::obtenerNivelPorNombre($nombre_nivel)->id_nivel;
    $id_ejer = Preguntas::ObtenerEjercicioPorNombre($Pregunta)->id_ejercicio;
    $RespuestaCorrecta = Preguntas::obtenerRespuesta($id_ejer, $respuesta, $id_nivel);
    if($respuesta == null){
        echo "Nres";
    }
    elseif ($RespuestaCorrecta != null) {
        
        echo "true";
    }else{
        Preguntas::SumarFallo($id_ejer);
        echo "false";
    }
}


if (isset($_POST["RespuestaPreguntaAcEs"])) {
    require '../models/Preguntas.php';
    require '../models/Usuario.php';
    $Pregunta= filter_input(INPUT_POST, 'Pregunta', FILTER_SANITIZE_STRING);
    $respuesta= filter_input(INPUT_POST, 'respuesta', FILTER_SANITIZE_STRING);
    $nombre_nivel = filter_input(INPUT_POST, 'Nombre_Nivel', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $id_nivel = Preguntas::obtenerNivelPorNombre($nombre_nivel)->id_nivel;
    $id_ejer = Preguntas::ObtenerEjercicioPorNombre($Pregunta)->id_ejercicio;
    $RespuestaCorrecta = Preguntas::obtenerRespuesta($id_ejer, $respuesta, $id_nivel);
    $Id_usuario = Usuario::obtenerUsuarioPorEmail($email)->id_usuario;
    if($respuesta == null){
        echo "Nres";
    }
    elseif ($RespuestaCorrecta != null) {
     $ActualizarEstado = Usuario::ActualizarEstado ($Id_usuario, $id_nivel);   
        echo "true";
    }else{
        
        echo "false";
    }    
}



if (isset($_POST["RespuestaReport"])) {
    require '../models/Preguntas.php';
    require '../models/Reporte.php';
    require '../models/Usuario.php';
    $CorreoUsuario= filter_input(INPUT_POST, 'CorreoUsuario', FILTER_SANITIZE_STRING);
    $Pregunta= filter_input(INPUT_POST, 'Pregunta', FILTER_SANITIZE_STRING);
    $CuerpoReporte= filter_input(INPUT_POST, 'CuerpoReport', FILTER_SANITIZE_STRING);
    $Id_usuario = Usuario::obtenerUsuarioPorEmail($CorreoUsuario)->id_usuario;
    $id_ejer = Preguntas::ObtenerEjercicioPorNombre($Pregunta)->id_ejercicio;
    if ($CuerpoReporte != null) {    
        echo $Id_usuario,$id_ejer,$CuerpoReporte,$CorreoUsuario;   
        $IngresarReporte = Reporte::ingresarReporte($Id_usuario,$id_ejer,$CuerpoReporte,$CorreoUsuario,$Pregunta) ;
    }else{      
    }
}



if (isset($_POST["borrarReporte"])) {
    require '../models/Reporte.php';
    $idReporte= filter_input(INPUT_POST, 'reporteId', FILTER_SANITIZE_STRING);
   if($idReporte==""){
   }else{
    Reporte::borrarReporte($idReporte);
    echo $idReporte;
   }    
}


