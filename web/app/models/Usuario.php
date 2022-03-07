<?php
require_once 'Conexion.php';
class Usuario
{

    public static function obtenerUsuarioPorEmail($email)
    {
        try {
            $conexion = new Conexion();
            $sql = 'SELECT usr.id_usuario,usr.nombre,usr.apellido_paterno,usr.apellido_materno,
            usr.correo_usuario,usr.contraseña,usr.sexo, usr.edad FROM usuario AS usr
            WHERE usr.correo_usuario = ?';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $email);
            $consulta->execute();
            $response = $consulta->fetch(PDO::FETCH_OBJ);
            return $response;
        } catch (Exception $e) {
            //throw th;
        }
    }

    public static function ingresarUsuario($nombre,$apellidoParterno,$apellidoMaterno,$email,$edad,$contraseña,$sexo){
    try{
        $conexion=new Conexion();
        $sql='INSERT INTO usuario (nombre, apellido_paterno, apellido_materno, correo_usuario, contraseña, sexo, edad, tipo_usuario_id) VALUES (?,?,?,?,?,?,?,1)';
        $consulta=$conexion->prepare($sql);
        $consulta->bindParam(1,$nombre);
        $consulta->bindParam(2,$apellidoParterno);
        $consulta->bindParam(3,$apellidoMaterno);
        $consulta->bindParam(4,$email);
        $pass=password_hash($contraseña, PASSWORD_DEFAULT);
        $consulta->bindParam(5,$pass);
        $consulta->bindParam(6,$sexo);
        $consulta->bindParam(7,$edad);   
        $consulta->execute();
    }catch(Exception $e){
      echo $e;
    }
    }
    public static function obtenerUsuarios(){
        try {
            $conexion=new Conexion();
            $sql='SELECT * from usuario';
            $consulta=$conexion->prepare($sql);
            $consulta->execute();
            $registros = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $registros;
        }catch(Exception $e){
        }

    }

    public static function NivelesCompletados($id_usuario){
        try {
            $conexion=new Conexion();
            $sql='SELECT COUNT(*) AS contador FROM completa
            WHERE id_usuario= ? AND estado_nivel="SI" ';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $id_usuario);
            $consulta->execute();
            $response = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $response;
        }catch(Exception $e){
        }

    }


    public static function updatePassword($password, $usuarioId)
    {
        try {
            $conexion = new Conexion();
            $sql = 'UPDATE usuario SET clave = ? WHERE id_usuario = ?';
            $consulta = $conexion->prepare($sql);
            $pass=password_hash($password, PASSWORD_DEFAULT);
            $consulta->bindParam(1,$pass);
            $consulta->bindParam(2, $usuarioId);
            if ($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            //throw th;
        }
    }

    public static function validarContrasena($usuarioId, $password)
    {
        try {
            $conexion = new Conexion();
            $sql = "SELECT * From usuario WHERE id_usuario = ?";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $usuarioId);
            $consulta->execute();
            $registro = $consulta->fetch(PDO::FETCH_OBJ);
            if (password_verify($password, $registro->contraseña)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
        }
    }
    public static function validarUsuario($email, $password)
    {
        try {
            $conexion = new Conexion();
            $sql = "SELECT correo_usuario,contraseña FROM usuario WHERE correo_usuario = ?";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $email);
            $consulta->execute();
            $registro = $consulta->fetch(PDO::FETCH_OBJ);
            if (password_verify($password, $registro->contraseña)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
        }
    }


    
    public static function ObtenerCompleta($id_usuario)
    {
        try {
            $conexion = new Conexion();
            $sql = 'SELECT estado_nivel, id_nivel FROM completa 
            WHERE id_usuario = ?';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $id_usuario);
            $consulta->execute();
            $response = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $response;
        } catch (Exception $e) {
            //throw th;
        }
    }


    public static function ObtenerEstado($id_usuario, $id_nivel)
    {
        try {
            $conexion = new Conexion();
            $sql = 'SELECT estado_nivel FROM completa 
            WHERE id_usuario = ? AND id_nivel = ?';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $id_usuario);
            $consulta->bindParam(2, $id_nivel);
            $consulta->execute();
            $response = $consulta->fetch(PDO::FETCH_OBJ);
            return $response;
        } catch (Exception $e) {
            //throw th;
        }
    }
    


    public static function CreaCompleta($id_usuario)
    {
        try {
            $conexion = new Conexion();
            $sql = "INSERT  INTO completa (id_nivel,id_usuario) VALUES (5,?),(6,?),(7,?),(8,?),(9,?),(10,?),(11,?),(12,?),(13,?),(14,?),(15,?),(16,?),(17,?),(18,?),(19,?),(20,?),(21,?),(22,?)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $id_usuario);
            $consulta->bindParam(2, $id_usuario);
            $consulta->bindParam(3, $id_usuario);
            $consulta->bindParam(4, $id_usuario);
            $consulta->bindParam(5, $id_usuario);
            $consulta->bindParam(6, $id_usuario);
            $consulta->bindParam(7, $id_usuario);
            $consulta->bindParam(8, $id_usuario);
            $consulta->bindParam(9, $id_usuario);
            $consulta->bindParam(10, $id_usuario);
            $consulta->bindParam(11, $id_usuario);
            $consulta->bindParam(12, $id_usuario);
            $consulta->bindParam(13, $id_usuario);
            $consulta->bindParam(14, $id_usuario);
            $consulta->bindParam(15, $id_usuario);
            $consulta->bindParam(16, $id_usuario);
            $consulta->bindParam(17, $id_usuario);
            $consulta->bindParam(18, $id_usuario);

            $consulta->execute();    
        } catch (Exception $e) {
        }
    }


    public static function ActualizarEstado( $usuarioId, $id_nivel)
    {
        try {
            $conexion = new Conexion();
            $sql = 'UPDATE completa SET estado_nivel = "SI" WHERE id_usuario = ? AND id_nivel =?';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1,$usuarioId);
            $consulta->bindParam(2, $id_nivel);
            if ($consulta->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            //throw th;
        }
    }

    public static function obtenerTipoUsuarioPorId($id_usuario)
    {
        try {
            $conexion = new Conexion();
            $sql = 'SELECT tipo_usuario_id FROM usuario 
            WHERE id_usuario = ?';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $id_usuario);
            $consulta->execute();
            $response = $consulta->fetch(PDO::FETCH_OBJ);
            return $response;
        } catch (Exception $e) {
            //throw th;
        }
    }
    public static function obtenerCorreoPorId($id_usuario)
    {
        try {
            $conexion = new Conexion();
            $sql = 'SELECT corre_usuario FROM usuario 
            WHERE id_usuario = ?';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(1, $id_usuario);
            $consulta->execute();
            $response = $consulta->fetch(PDO::FETCH_OBJ);
            return $response;
        } catch (Exception $e) {
            //throw th;
        }
    }

    public static function borrarUsuario($idUsuario){
        try {
            $conexion=new Conexion();
            $sql='DELETE FROM usuario WHERE id_usuario = ?';
            $consulta=$conexion->prepare($sql);
            $consulta->bindParam(1,$idUsuario);
            $consulta->execute();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }



}




