<?php
namespace DogtorPET\Backend\Util;

use PDO;
use PDOException;

class DataSource {

    public static function abrirConexion(): PDO {
        $config = Config::obtenerInstancia();
        try {
            $params = $config->cargarParametros();
            extract( $params['database'] ); // Requiere un arreglo asociativo
            $conexion = new PDO($dburl, $dbuser, $dbpass);
            return $conexion;
        } catch(PDOException $e) {
            $log = $config->crearLog();
            $log->error( $e->getMessage(), $e->getTrace() );
            throw $e;
        }
    }

}
?>