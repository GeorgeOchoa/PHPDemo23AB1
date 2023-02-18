<?php
namespace DogtorPET\Backend\Rest;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PDOException;
use PDO;

use DogtorPET\Backend\Util\DataSource;
use DogtorPET\Backend\Util\Config;
use PsrJwt\Factory\Jwt;

class LoginController {

  public const SQL_SELECT_LOGIN = 'SELECT * FROM usuario WHERE username=? AND password=SHA2(?,256)';

  public function login(Request $req, Response $res, array $args): Response {
    try {
      $credenciales = json_decode( $req->getBody(), true );
      $config = Config::obtenerInstancia();
      $conexion = DataSource::abrirConexion();
      $sentencia = $conexion->prepare(self::SQL_SELECT_LOGIN);
      $sentencia->bindParam(1, $credenciales['username']);
      $sentencia->bindParam(2, $credenciales['password']);
      $sentencia->execute();
      $resultset = $sentencia->fetch();
      if( $resultset ) {
        $factory = new Jwt();
        $builder = $factory->builder();
        $token = $builder->setSecret( $config->jwtSecret() )
          ->setPayloadClaim('username', $credenciales['username'])
          ->setExpiration( time() + (3600 * 2)  )
          ->build();
        $res->getBody()->write( json_encode( ['token' => $token->getToken()] ) );
        return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
      }
      $mensaje = [ 'codigo' => 'error', 'mensaje'=>'Login inválido' ];
      $res->getBody()->write( json_encode($mensaje) );
      return $res->withHeader('Content-Type', 'application/json')->withStatus(401);
    } catch(PDOException $e) {
      $mensaje = [ 'codigo' => $e->getCode(), 'mensaje'=>$e->getMessage() ];
      $res->getBody()->write( json_encode($mensaje) );
      return  $res->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
  }

}
?>
