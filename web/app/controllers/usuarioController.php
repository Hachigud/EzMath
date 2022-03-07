<?php
if (isset($_POST["ingresarUsuario"])) {
    require '../models/Usuario.php';
    $nombre= filter_input(INPUT_POST, 'Nombre', FILTER_SANITIZE_STRING);
    $apellidoPaterno= filter_input(INPUT_POST, 'ApellidoPaterno', FILTER_SANITIZE_STRING);
    $apellidoMaterno= filter_input(INPUT_POST, 'ApellidoMaterno', FILTER_SANITIZE_STRING);
    $email= filter_input(INPUT_POST, 'Correo', FILTER_SANITIZE_STRING);
    $edad= filter_input(INPUT_POST, 'Edad', FILTER_SANITIZE_STRING);
    $contraseña= filter_input(INPUT_POST, 'Contraseña', FILTER_SANITIZE_STRING);
    $sexo= filter_input(INPUT_POST, 'Sexo', FILTER_SANITIZE_STRING);
    $usuario = Usuario::obtenerUsuarioPorEmail($email);
    if ($usuario != null) {  
              
    }else{
        echo $nombre,$apellidoPaterno,$apellidoMaterno,$email,$edad,$contraseña,$sexo;
        Usuario::ingresarUsuario($nombre,$apellidoPaterno,$apellidoMaterno,$email,$edad,$contraseña,$sexo); 
    }
}


if (isset($_POST["loguear"])) {
    session_start();
    require '../models/Usuario.php';
    require '../utils/Utils.php';
    date_default_timezone_set("America/Santiago");
    $fechaIngreso = date("Y-m-d G:i:s");
    $email = filter_input(INPUT_POST, 'Correo', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'Clave', FILTER_SANITIZE_STRING);
    $usuarioId = Usuario::obtenerUsuarioPorEmail($email)->id_usuario;
    $direccionIp = Utils::getRealIP();
    $result = Usuario::validarUsuario($email, $password);
    if ($result) {
        $_SESSION["Correo"] = $email;
        $tablet_browser = 0;
        $mobile_browser = 0;
        $body_class = 'desktop';
        $tipoDispositivoId = null;
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
            $body_class = "tablet";
        }

        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
            $body_class = "mobile";
        }

        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
            $body_class = "mobile";
        }

        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-');

        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }

        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
            $mobile_browser++;
            //Check for tablets on opera mini alternative headers
            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $tablet_browser++;
            }
        }
        if ($tablet_browser > 0) {
            // Si es tablet has lo que necesites
            $tipoDispositivoId = 1;
        } else if ($mobile_browser > 0) {
            // Si es dispositivo mobil has lo que necesites
            $tipoDispositivoId = 2;
        } else {
            // Si es ordenador de escritorio has lo que necesites
            $tipoDispositivoId = 3;
        }
        // generamos un registro de usuario para estadisticas
      
        echo "true";
    } else {
        echo "false";
    }
}
if (isset($_POST["obtenerUsuarios"])) {
    require '../models/Usuario.php';
    $usuarios=Usuario::obtenerUsuarios();
    echo json_encode($usuarios);
}
if (isset($_POST["editarUsuarioContraseña"])) {
    require '../models/Usuario.php';
    if (isset($_POST["contraseñaA"]) && isset($_POST["contraseñaN"])) {
        $usuarioId = filter_input(INPUT_POST, 'usuarioId', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'contraseñaA', FILTER_SANITIZE_STRING);
        $passwordNuevo = filter_input(INPUT_POST, 'contraseñaN', FILTER_SANITIZE_STRING);
        $verificar_user = Usuario::validarContrasena($usuarioId,$password);
        if ($verificar_user == true) {
            Usuario::updatePassword($passwordNuevo,$usuarioId);
        } else {
        //devolvemos al formulario de logueo con un mensaje de error
            echo "error al actualizar contraseña";
        }
    } 
}





if (isset($_POST["TCompleta"])) {
    require '../models/Usuario.php';
    $email = filter_input(INPUT_POST, 'Correo', FILTER_SANITIZE_STRING);
    $usuarioId = Usuario::obtenerUsuarioPorEmail($email)->id_usuario;
    echo "TCOMPLETA SI";
    if ($usuario != null) {
      
    }else{
        $DatoCompleta::ObetenerCompleta($usuarioId); 
        if($DatoCompleta != null){

        }else{
          Usuario::CreaCompleta($usuarioId)  ;
        }
    }
}


if (isset($_POST["borrarUsuario"])) {
    require '../models/Usuario.php';
    $idUsuario= filter_input(INPUT_POST, 'usuarioId', FILTER_SANITIZE_STRING);
   if($idUsuario==""){
   }else{
    Usuario::borrarUsuario($idUsuario);
    echo $idUsuario;
   }    
}
