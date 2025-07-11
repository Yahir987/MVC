<?php
namespace Controllers\Mantenimientos\Funciones;

use Controllers\PublicController;
use Dao\Funciones\Funciones as FuncionesDAO;
use Views\Renderer;

class Funciones extends PublicController {
    private array $viewData = [];

    public function run(): void {
        $this->viewData["funciones"] = FuncionesDAO::getAll();
        Renderer::render("mnt/funciones/funciones", $this->viewData);
    }
}