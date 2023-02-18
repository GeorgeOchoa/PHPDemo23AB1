<?php
namespace DogtorPet\Backend\Rest;

use DogtorPet\Backend\Util\DataSource;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PDOException;
use PDO;

class RevisionController {

    private const SQL_SELECT_REVISIONES_POR_MASCOTA = 'SELECT * FROM revision WHERE mascota=? ORDER BY fecha ASC';
    private const SQL_INSERT_REVISION = 'INSERT INTO revision(fecha,mascota,peso,comentarios) VALUES(?,?,?,?)';
    private const SQL_DELETE_REVISION = 'DELETE FROM revision WHERE id=?';

    public function lista(Request $req, Response $res, array $args): Response {
        try {
            $conexion = DataSource::abrirConexion();
            $sentencia = $conexion->prepare(self::SQL_SELECT_REVISIONES_POR_MASCOTA);
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
            $sentencia = $conexion->prepare(self::SQL_INSERT_REVISION);
            $sentencia->bindParam(1, $datos['fecha']);
            $sentencia->bindParam(2, $datos['mascota']);
            $sentencia->bindParam(3, $datos['peso']);
            $sentencia->bindParam(4, $datos['comentarios']);
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
            $sentencia = $conexion->prepare(self::SQL_DELETE_REVISION);
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
