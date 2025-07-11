<?php
namespace Dao\Roles;

use Dao\Table;

class Roles extends Table {
    public static function getAll() {
        $sqlstr = "SELECT * FROM roles";
        return self::obtenerRegistros($sqlstr, []);
    }

    public static function getById(string $rolescod) {
        $sqlstr = "SELECT * FROM roles WHERE rolescod = :rolescod";
        return self::obtenerUnRegistro($sqlstr, ['rolescod' => $rolescod]);
    }

    public static function insert(string $rolescod, ?string $rolesdsc, string $rolesest) {
        $sqlstr = "INSERT INTO roles (rolescod, rolesdsc, rolesest) VALUES (:rolescod, :rolesdsc, :rolesest)";
        return self::executeNonQuery($sqlstr, [
            'rolescod' => $rolescod,
            'rolesdsc' => $rolesdsc,
            'rolesest' => $rolesest
        ]);
    }

    public static function update(string $rolescod, ?string $rolesdsc, string $rolesest) {
        $sqlstr = "UPDATE roles SET rolesdsc = :rolesdsc, rolesest = :rolesest WHERE rolescod = :rolescod";
        return self::executeNonQuery($sqlstr, [
            'rolescod' => $rolescod,
            'rolesdsc' => $rolesdsc,
            'rolesest' => $rolesest
        ]);
    }

    public static function delete(string $rolescod) {
        $sqlstr = "DELETE FROM roles WHERE rolescod = :rolescod";
        return self::executeNonQuery($sqlstr, ['rolescod' => $rolescod]);
    }
}