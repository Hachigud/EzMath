<?php
require '../models/Graficos.php';
$Grafico = new Graficas();
$consulta = $Grafico-> TraerGraficoNiveles();
echo json_encode($consulta);
?>