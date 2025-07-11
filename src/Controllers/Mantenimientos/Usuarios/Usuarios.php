<?php 
namespace Controllers\Mantenimientos\Usuarios;

use Controllers\PublicController;
use Dao\Usuario\Usuarios as UsuariosDAO;
use Views\Renderer;

class Usuarios extends PublicController{
    private array $viewData;

    public function __construct(){
        $this->viewData = ["usuarios" => []];
    }

    public function run() :void {
        $this->viewData["usuarios"] = UsuariosDAO::getUsuarios();
        Renderer::render("mnt/usuarios/usuarios", $this->viewData);
    }
}