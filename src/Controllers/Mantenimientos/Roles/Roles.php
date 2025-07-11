<?php
namespace Controllers\Mantenimientos\Roles;

use Controllers\PublicController;
use Dao\Roles\Roles as RolesDAO;
use Views\Renderer;

class Roles extends PublicController {
    private array $viewData = [];

    public function run(): void {
        $this->viewData["roles"] = RolesDAO::getAll();
        Renderer::render("mnt/roles/roles", $this->viewData);
    }
}