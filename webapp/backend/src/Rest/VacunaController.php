<?php
namespace DogtorPet\Backend\Rest;

use DogtorPet\Backend\Util\DataSource;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PDOException;
use PDO;

class VacunaController {

    private const SQL_SELECT_VACUNAS_POR_MASCOTA = 'SELECT * FROM vacuna WHERE mascota=? ORDER BY fecha ASC';
    private const SQL_INSERT_VACUNA = 'INSERT INTO vacuna(fecha,mascota,descripcion) VALUES(?,?,?)';
    private const SQL_DELETE_VACUNA = 'DELETE FROM vacuna WHERE id=?';

    public function lista(Request $req, Response $res, array $args): Response {
        try {
            $conexion = DataSource::abrirConexion();
            $sentencia = $conexion->prepare(self::SQL_SELECT_VACUNAS_POR_MASCOTA);
            $sentencia->bindParam(1, $args['mascota']);
            $sentencia->execute();
            $resultSet = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            $res->getBody()->write( json_encode($resultSet) );
            return $res->withHeader('Content-Type','application/json')->withStatus(200);
        } catch(PDOException $e) {
            $excepcion = ['mensaje' => $e->getMessage(), 'codigo' => $e->getCode()];
            $res->getBody()->write( json_encode($excepcion) );
            return $res->withHeader('Content-Type','application/json')->withStatus(500);
        }
    }

    public function insertar(Request $req, Response $res, array $args): Response {
        try {
            $datos = json_decode( $req->getBody(), true );
            $conexion = DataSource::abrirConexion();
            $sentencia = $conexion->prepare(self::SQL_INSERT_VACUNA);
            $sentencia->bindParam(1, $datos['fecha']);
            $sentencia->bindParam(2, $datos['mascota']);
            $sentencia->bindParam(3, $datos['descripcion']);
            $sentencia->execute();
            $datos['id'] = $conexion->lastInsertId();
            $res->getBody()->write( json_encode($datos) );
            return $res->withHeader('Content-Type','application/json')->withStatus(200);
        } catch(PDOException $e) {
            $excepcion = ['mensaje' => $e->getMessage(), 'codigo' => $e->getCode()];
            $res->getBody()->write( json_encode($excepcion) );
            return $res->withHeader('Content-Type','application/json')->withStatus(500);
        }
    }

    public function eliminar(Request $req, Response $res, array $args): Response {
        try {
            $conexion = DataSource::abrirConexion();
            $sentencia = $conexion->prepare(self::SQL_DELETE_VACUNA);
            $sentencia->bindParam(1, $args['id']);
            $sentencia->execute();
            $documento = ['mensaje' => 'Registro eliminado exitosamente', 'codigo' => $args['id']];
            $res->getBody()->write( json_encode($documento) );
            return $res->withHeader('Content-Type','application/json')->withStatus(200);
        } catch(PDOException $e) {
            $excepcion = ['mensaje' => $e->getMessage(), 'codigo' => $e->getCode()];
            $res->getBody()->write( json_encode($excepcion) );
            return $res->withHeader('Content-Type','application/json')->withStatus(500);
        }
    }

}
?>