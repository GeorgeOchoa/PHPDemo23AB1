<?php
namespace DogtorPET\Backend\Modelos;

use JsonSerializable;

class JsonEntity implements JsonSerializable {

    // Arreglo asociativo que será inicializado por PDO
    protected array $atributos = [];

    public function __get(String $campo): mixed {
        return $this->atributos[$campo];
    }

    public function __set(String $campo, mixed $valor): void {
        $this->atributos[$campo] = $valor;
    }

    public function jsonSerialize(): array {
        return $this->atributos;
    }

}
?>