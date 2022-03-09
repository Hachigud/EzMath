<?php
	class conexion2{
		private $servidor;
		private $usuario;
		private $contrasena;
		private $basedatos;
		public $conexion;
		public function __construct(){
		    $this->servidor = "mysql.face.ubiobio.cl";
			$this->usuario = "Tesisezmath";
			$this->contrasena = "EzMath20$21";
			$this->basedatos = "ezmath_bd";
		}
		function conectar(){
			$this->conexion = new mysqli($this->servidor,$this->usuario,$this->contrasena,$this->basedatos);
			$this->conexion->set_charset("utf8");
		}
		function cerrar(){
			$this->conexion->close();	
		}
	}
?> 