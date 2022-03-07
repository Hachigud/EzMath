<?php
require '../models/Graficos.php';
$Grafico = new Graficas();
$consulta = $Grafico-> TraerGraficoReporte();
echo json_encode($consulta);
?>