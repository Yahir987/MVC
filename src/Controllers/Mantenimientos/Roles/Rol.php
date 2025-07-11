<?php
namespace Controllers\Mantenimientos\Roles;

use Controllers\PublicController;
use Dao\Roles\Roles as RolesDAO;
use Views\Renderer;
use Utilities\Site;

const LIST_URL = "index.php?page=Mantenimientos-Roles-Roles";

class Rol extends PublicController {
    private array $viewData = [];
    private array $estados = ["ACT", "INA", "RTR"];
    private array $modes = [
        "INS" => "Creando nuevo Rol",
        "UPD" => "Modificando Rol %s",
        "DEL" => "Eliminando Rol %s",
        "DSP" => "Detalles del Rol %s"
    ];

    public function run(): void {
        $this->handleMode();
        $this->loadData();
        if ($this->isPostBack()) {
            $this->readFormData();
            $this->processAction();
        }
        $this->prepareView();
        Renderer::render("mnt/roles/rol", $this->viewData);
    }

    private function handleMode() {
        if (!isset($_GET["mode"]) || !isset($this->modes[$_GET["mode"]])) {
            Site::redirectToWithMsg(LIST_URL, "Modo no válido");
        }
        $this->viewData["mode"] = $_GET["mode"];
    }

    private function loadData() {
        $this->viewData["rolescod"] = $_GET["id"] ?? "";
        if ($this->viewData["mode"] !== "INS") {
            $rol = RolesDAO::getById($this->viewData["rolescod"]);
            if ($rol) {
                $this->viewData["rolesdsc"] = $rol["rolesdsc"];
                $this->viewData["rolesest"] = $rol["rolesest"];
            } else {
                Site::redirectToWithMsg(LIST_URL, "Rol no encontrado");
            }
        }
    }

    private function readFormData() {
        $this->viewData["rolescod"] = $_POST["rolescod"] ?? $this->viewData["rolescod"];
        $this->viewData["rolesdsc"] = $_POST["rolesdsc"] ?? "";
        $this->viewData["rolesest"] = $_POST["rolesest"] ?? "ACT";
    }

    private function processAction() {
        switch ($this->viewData["mode"]) {
            case "INS":
                RolesDAO::insert($this->viewData["rolescod"], $this->viewData["rolesdsc"], $this->viewData["rolesest"]);
                Site::redirectToWithMsg(LIST_URL, "Rol creado exitosamente");
                break;
            case "UPD":
                RolesDAO::update($this->viewData["rolescod"], $this->viewData["rolesdsc"], $this->viewData["rolesest"]);
                Site::redirectToWithMsg(LIST_URL, "Rol actualizado correctamente");
                break;
            case "DEL":
                RolesDAO::delete($this->viewData["rolescod"]);
                Site::redirectToWithMsg(LIST_URL, "Rol eliminado correctamente");
                break;
        }
    }

    private function prepareView() {
        $this->viewData["modeDsc"] = sprintf($this->modes[$this->viewData["mode"]], $this->viewData["rolescod"]);
        $this->viewData["rolesest" . $this->viewData["rolesest"]] = "selected";
        $this->viewData["readonly"] = ($this->viewData["mode"] !== "INS") ? "readonly" : "";
    }
}