<?php

namespace Controllers\examen;

use Controllers\PublicController;
use Dao\examen\peliculas as ExamenPeliculas;
use Views\Renderer;

class peliculas extends PublicController{
    
    private array $viewData;
    
    public function __construct()
    {
        $this->viewData =[
            "peliculas" => []
        ];
    }


    public function run():void{
        //Implementacion de la lista
        $this ->viewData["peliculas"] = ExamenPeliculas::getPeliculas();
        Renderer::render("examen/peliculas", $this->viewData);
    }
}

