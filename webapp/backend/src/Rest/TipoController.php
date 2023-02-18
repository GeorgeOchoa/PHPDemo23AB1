<?php
namespace DogtorPET\Backend\Rest;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PDOException;
use PDO;

use DogtorPET\Backend\Util\DataSource;

class TipoController {

  public const SQL_SELECT_TIPOS = 'SELECT * FROM tipo';

  public function lista(Request $req, Response $res, array $args): Response {
      try {
          $conexion = DataSource::abrirConexion();
          $sentencia = $conexion->prepare(self::SQL_SELECT_TIPOS);
          $sentencia->execute();
          $tipos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
          $res->getBody()->write( json_encode($tipos) );
          return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
      } catch(PDOException $e) {
          $mensaje = [ 'codigo' => $e->getCode(), 'mensaje'=>$e->getMessage() ];
          $res->getBody()->write( json_encode($mensaje) );
          return  $res->withHeader('Content-Type', 'application/json')->withStatus(500);
      }
  }

}
?>