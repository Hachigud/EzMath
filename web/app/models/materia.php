<?php
require_once 'Conexion.php';
class Materias
{
  
    public static function obtenerMateria()
    {
        try {
            $conexion = new Conexion();
            $sql = 'SELECT * FROM materia';
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $response = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $response;
        } catch (Exception $e) {
            
        }
    }
}