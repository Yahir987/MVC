<?php 
namespace Dao\Usuario;
use Dao\Table;

class Usuarios extends Table {
    public static function getUsuarios() {
        $sqlstr = "SELECT * FROM usuario;";
        return self::obtenerRegistros($sqlstr, []);
    }

    public static function getUsuarioById(int $usercod) {
        $sqlstr = "SELECT * FROM usuario WHERE usercod = :usercod;";
        return self::obtenerUnRegistro($sqlstr, ['usercod' => $usercod]);
    }

    public static function nuevoUsuario(string $useremail, string $username, string $userest, string $usertipo) {
        $sqlstr = "INSERT INTO usuario (useremail, username, userest, usertipo) VALUES (:useremail, :username, :userest, :usertipo);";
        return self::executeNonQuery($sqlstr, [
            'useremail' => $useremail,
            'username' => $username,
            'userest' => $userest,
            'usertipo' => $usertipo
        ]);
    }

    public static function actualizarUsuario(int $usercod, string $useremail, string $username, string $userest, string $usertipo) {
        $sqlstr = "UPDATE usuario SET useremail = :useremail, username = :username, userest = :userest, usertipo = :usertipo WHERE usercod = :usercod;";
        return self::executeNonQuery($sqlstr, [
            'usercod' => $usercod,
            'useremail' => $useremail,
            'username' => $username,
            'userest' => $userest,
            'usertipo' => $usertipo
        ]);
    }

    public static function eliminarUsuario(int $usercod) {
        $sqlstr = "DELETE FROM usuario WHERE usercod = :usercod;";
        return self::executeNonQuery($sqlstr, ['usercod' => $usercod]);
    }
}

?>