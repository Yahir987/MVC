<?php

namespace Dao\examen;

use Dao\Table;

class peliculas extends Table{
    //metodos estaticos publicos de CRUD
    //Obtener Pelicula
     public static function getPeliculas()
    {
        $sqlstr = "SELECT * from peliculas;";
        return self::obtenerRegistros($sqlstr, []);
    }

    //Obtener Peliculas por ID
    
    public static function getPeliculasById(int $id_pelicula)
    {
        $sqlstr = "SELECT * from peliculas where id_pelicula= :id_pelicula;";
        return self::obtenerUnRegistro($sqlstr, ["id_pelicula" => $id_pelicula]);
    }

    //Nueva Pelicula
    public static function nuevaPeliculas(string $titulo, string $director, int $año_estreno, string $genero, int $duracion_min)
    {
        $sqlstr = "INSERT INTO peliculas (titulo, director, año_estreno, genero, duracion_min) VALUES (:titulo, :director, :año_estreno, :genero, :duracion_min);";
        return self::executeNonQuery(
            $sqlstr,
            [
                "titulo" => $titulo,
                "director" => $director,
                "año_estreno" => $año_estreno,
                "genero" => $genero,
                "duracion_min" => $duracion_min 
            ]
        );
    }

    //actualizar Pelicula
        public static function actualizarPeliculas(int $id_pelicula, string $titulo, string $director, int $año_estreno, string $genero, int $duracion_min): int
    {
        $sqlstr = "UPDATE peliculas set titulo = :titulo, director = :director, año_estreno = :año_estreno, genero = :genero, duracion_min = :duracion_min  where id = :id;";

        return self::executeNonQuery(
            $sqlstr,
            [
                "titulo" => $titulo,
                "director" => $director,
                "año_estreno" => $año_estreno,
                "genero" => $genero,
                "duracion_min" => $duracion_min,
                "id_pelicula" => $id_pelicula
            ]
        );


    }

    //Eliminar
        public static function eliminarPeliculas(int $id_pelicula): int
    {
        $sqlstr = "DELETE from peliculas where id_pelicula = :id_pelicula;";
        return self::executeNonQuery(
            $sqlstr,
            [
                "id_pelicula" => $id_pelicula
            ]
        );
    }




}