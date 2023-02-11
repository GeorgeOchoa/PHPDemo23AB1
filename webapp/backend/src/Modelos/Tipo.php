<?php
namespace DogtorPET\Backend\Modelos;

use JsonSerializable;

class Tipo implements JsonSerializable {

    public const SQL_SELECT_TIPOS = 'SELECT * FROM tipo';

    private int $id;
    private String $descripcion;

    public function __get(String $atributo): mixed {
        switch($atributo) {
            case 'id': return $this->id;
            case 'descripcion': return $this->descripcion;
            default: return null;
        }
    }

    public function __set(String $atributo, mixed $valor): void {
        switch($atributo) {
            case 'id': $this->id = (int) $valor; break;
            case 'descripcion': $this->descripcion = $valor; break;
        }
    }

    public function jsonSerialize(): array {
        return[
            'id' => $this->id,
            'descripcion' => $this->descripcion
        ];
    }

}

?>