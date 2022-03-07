<?php
require_once 'Conexion.php';

Class Reporte{
    public static function ingresarReporte($id_usuario,$id_ejercicio,$DescripcionReporte,$CorreoUsuario,$pregunta){
        try{
            $conexion=new Conexion();
            $sql='INSERT INTO reporta (id_usuario, id_ejercicio, descripcion_reporte, correo_usuario,nombre_ejercicio) VALUES (?,?,?,?,?)';
            $consulta=$conexion->prepare($sql);
            $consulta->bindParam(1,$id_usuario);
            $consulta->bindParam(2,$id_ejercicio);
            $consulta->bindParam(3,$DescripcionReporte);
            $consulta->bindParam(4,$CorreoUsuario);
            $consulta->bindParam(5,$pregunta);
            $consulta->execute();
        }catch(Exception $e){
          echo $e;
        }
    }
    public static function obtenerReportes(){
        try {
            $conexion=new Conexion();
            $sql='SELECT * from reporta';
            $consulta=$conexion->prepare($sql);
            $consulta->execute();
            $registros = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $registros;
        }catch(Exception $e){
        }

    }

    public static function borrarReporte($idReporte){
        try {
            $conexion=new Conexion();
            $sql='DELETE from  reporta WHERE id_reporte = ?';
            $consulta=$conexion->prepare($sql);
            $consulta->bindParam(1,$idReporte);
            $consulta->execute();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}





