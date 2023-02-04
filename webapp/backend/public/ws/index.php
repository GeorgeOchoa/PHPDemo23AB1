<?php
require '../../vendor/autoload.php';

use DogtorPET\Backend\Util\DataSource;

$conexion = DataSource::abrirConexion();
$sentencia = $conexion->prepare("SELECT * FROM mascota");
$sentencia->execute();
$resultSet = $sentencia->fetch(PDO::FETCH_ASSOC);
var_dump($resultSet);
?>