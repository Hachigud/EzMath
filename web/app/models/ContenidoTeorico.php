<?php
require_once 'Conexion.php';
class ContenidoTeorico
{



    public static function ingresarContenidoTeorico($idmateria,$descripcion){
    try{
        $conexion=new Conexion();
        $sql='INSERT INTO contenido_teorico (id_materia, descripcion_contenido_teorico) VALUES (?,?)';
        $consulta=$conexion->prepare($sql);
        $consulta->bindParam(1,$idmateria);
        $consulta->bindParam(2,$descripcion);
        $consulta->execute();
    }catch(Exception $e){
      echo $e;
    }
    }

    public static function obtenerContenidoTeorico(){
        try {
            $conexion=new Conexion();
            $sql='SELECT * from contenido_teorico';
            $consulta=$conexion->prepare($sql);
            $consulta->execute();
            $registros = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $registros;
        }catch(Exception $e){
        }

    }

    public static function obtenerContenidoMateria(){
        try {
            $conexion=new Conexion();
            $sql=' SELECT contenido_teorico.id_contenido_teorico, materia.descripcion_materia, contenido_teorico.descripcion_contenido_teorico FROM contenido_teorico
            INNER JOIN  materia
            WHERE materia.id_materia = contenido_teorico.id_materia';
            $consulta=$conexion->prepare($sql);
            $consulta->execute();
            $registros = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $registros;
        }catch(Exception $e){
        }

    }





}
