<?php
require_once 'Conexion.php';

Class Preguntas{


    public static function obtenerRespuesta($Id_ejercicio,$Respuesta,$id_nivel)
    {
        try {
            $conexion = new Conexion();
            $sql = 'SELECT * FROM ejercicios 
            WHERE id_ejercicio = ?  AND respuesta = ? AND id_nivel = ?';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $Id_ejercicio);
            $consulta->bindParam(2, $Respuesta);
            $consulta->bindParam(3, $id_nivel);
            $consulta->execute();
            $response = $consulta->fetch(PDO::FETCH_OBJ);
            return $response;
        } catch (Exception $e) {
            //throw th;
        }
    }


    public static function obtenerNivelPorNombre($Nombre_Nivel)
    {
        try {
            $conexion = new Conexion();
            $sql = 'SELECT * FROM nivel 
            WHERE nombre_nivel = ?';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $Nombre_Nivel);
            $consulta->execute();
            $response = $consulta->fetch(PDO::FETCH_OBJ);
            return $response;
        } catch (Exception $e) {
            //throw th;
        }
    }
    public static function obtenerIdNivelPorNombre($Nombre_Nivel)
    {
        try {
            $conexion = new Conexion();
            $sql = 'SELECT id_nivel FROM nivel 
            WHERE nombre_nivel = ?';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $Nombre_Nivel);
            $consulta->execute();
            $response = $consulta->fetch(PDO::FETCH_OBJ);
            return $response;
        } catch (Exception $e) {
            //throw th;
        }
    }

    public static function obtenerEjercicioPorNombre($Nombre_Ejercicio)
    {
        try {
            $conexion = new Conexion();
            $sql = 'SELECT * FROM ejercicios
            WHERE pregunta = ?';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $Nombre_Ejercicio);
            $consulta->execute();
            $response = $consulta->fetch(PDO::FETCH_OBJ);
            return $response;
        } catch (Exception $e) {
            //throw th;
        }
    }

    public static function SumarFallo( $id_ejercicio)
    {
        try {
            $conexion = new Conexion();
            $sql = 'UPDATE falla SET cantidad_fallos = cantidad_fallos + 1 WHERE id_ejercicio = ?';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1,$id_ejercicio);
            if ($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            //throw th;
        }
    }
}