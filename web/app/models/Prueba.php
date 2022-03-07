<?php
require_once 'Conexion.php';
class Pruebas
{
    public static function obtenerPruebas()
    {
        try {
            $conexion = new Conexion();
            $sql = 'SELECT * FROM pruebas';
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $response = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $response;
        } catch (Exception $e) {
            //throw th;
        }
    }
 

    }