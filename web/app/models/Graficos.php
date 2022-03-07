

<?php
	class Graficas{
		private $conexion;
		function __construct()
		{
			require_once('Conexion2.php');
			$this->conexion = new conexion2();
			$this->conexion->conectar();
        }


		function TraerGraficoReporte(){
			$sql = "SELECT
            id_ejercicio, nombre_ejercicio,
            COUNT(*) AS cantidad
        FROM
            reporta
        GROUP BY
            id_ejercicio, nombre_ejercicio
        ORDER BY cantidad ASC;
        ";	
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}

        function TraerGraficoNiveles(){
			$sql = "SELECT 
            completa.estado_nivel, nivel.nombre_nivel,
            COUNT(*) AS cantidad
            FROM completa  INNER JOIN nivel 
            WHERE
            completa.estado_nivel ='Si' AND completa.id_nivel = nivel.id_nivel
            GROUP BY
            estado_nivel, nombre_nivel
            ORDER BY cantidad ASC;
        ";	
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}

        function TraerGraficoFallas(){
			$sql = "SELECT falla.cantidad_fallos, ejercicios.pregunta
             FROM
            falla INNER JOIN ejercicios
            WHERE falla.id_ejercicio = ejercicios.id_ejercicio AND falla.cantidad_fallos >=1 
            GROUP BY
            cantidad_fallos, pregunta
            ORDER BY cantidad_fallos ASC;;

        ";	
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}
	}
?>