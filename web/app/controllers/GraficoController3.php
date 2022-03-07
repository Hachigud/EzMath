<?php
require '../models/Graficos.php';
$Grafico = new Graficas();
$consulta = $Grafico-> TraerGraficoFallas();
echo json_encode($consulta);
?>