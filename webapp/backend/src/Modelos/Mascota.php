<?php
namespace DogtorPET\Backend\Modelos;

class Mascota extends JsonEntity {

    public const SQL_SELECT_MASCOTA_POR_PROPIETARIO = 'SELECT * FROM mascota WHERE propietario=?';
    public const SQL_SELECT_MASCOTA_POR_ID = 'SELECT * FROM mascota WHERE id=?';
    public const SQL_INSERT_MASCOTA = 'INSERT INTO mascota(nombre, propietario, fechaNac, raza, color, genero, tipo, fotoUrl) VALUES(?,?,?,?,?,?,?,?)';
    public const SQL_UPDATE_MASCOTA = 'UPDATE mascota SET nombre=?, propietario=?, fechaNac=?, raza=?, color=?, genero=?, tipo=?, fotoUrl=? WHERE id=?';
    public const SQL_DELETE_MASCOTA = 'DELETE FROM mascota WHERE id=?';

    // No es necesario crear el arreglo con los atributos porque
    // PDO lo creara e inicializar√° por mi

    // protected array $atributos = [
    //     `id` => 0,
    //     `nombre` => null,
    //     `propietario` => null,
    //     `fechaNac` => null,
    //     `raza` => null,
    //     `color` => null,
    //     `genero` => null,
    //     `tipo` => 0,
    //     `fotoUrl` => null
    // ];

}


?>