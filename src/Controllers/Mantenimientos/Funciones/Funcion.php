<?php
namespace Controllers\Mantenimientos\Funciones;

use Controllers\PublicController;
use Dao\Funciones\Funciones as FuncionesDAO;
use Views\Renderer;
use Utilities\Site;

const LIST_URL = "index.php?page=Mantenimientos-Funciones-Funciones";

class Funcion extends PublicController {
    private array $viewData = [];
    private array $estados = ["ACT", "INA", "RTR"];
    private array $modes = [
        "INS" => "Creando nueva Función",
        "UPD" => "Modificando Función %s",
        "DEL" => "Eliminando Función %s",
        "DSP" => "Detalles de la Función %s"
    ];

    public function run(): void {
        $this->handleMode();
        $this->loadData();
        if ($this->isPostBack()) {
            $this->readFormData();
            $this->processAction();
        }
        $this->prepareView();
        Renderer::render("mnt/funciones/funcion", $this->viewData);
    }

    private function handleMode() {
        if (!isset($_GET["mode"]) || !isset($this->modes[$_GET["mode"]])) {
            Site::redirectToWithMsg(LIST_URL, "Modo no válido");
        }
        $this->viewData["mode"] = $_GET["mode"];
    }

    private function loadData() {
        $this->viewData["fncod"] = $_GET["id"] ?? "";
        if ($this->viewData["mode"] !== "INS") {
            $fn = FuncionesDAO::getById($this->viewData["fncod"]);
            if ($fn) {
                $this->viewData["fndsc"] = $fn["fndsc"];
                $this->viewData["fnest"] = $fn["fnest"];
                $this->viewData["fntyp"] = $fn["fntyp"];
            } else {
                Site::redirectToWithMsg(LIST_URL, "Función no encontrada");
            }
        }
    }

    private function readFormData() {
        $this->viewData["fncod"] = $_POST["fncod"] ?? $this->viewData["fncod"];
        $this->viewData["fndsc"] = $_POST["fndsc"] ?? "";
        $this->viewData["fnest"] = $_POST["fnest"] ?? "ACT";
        $this->viewData["fntyp"] = $_POST["fntyp"] ?? "";
    }

    private function processAction() {
        switch ($this->viewData["mode"]) {
            case "INS":
                FuncionesDAO::insert(
                    $this->viewData["fncod"],
                    $this->viewData["fndsc"],
                    $this->viewData["fnest"],
                    $this->viewData["fntyp"]
                );
                Site::redirectToWithMsg(LIST_URL, "Función creada exitosamente");
                break;
            case "UPD":
                FuncionesDAO::update(
                    $this->viewData["fncod"],
                    $this->viewData["fndsc"],
                    $this->viewData["fnest"],
                    $this->viewData["fntyp"]
                );
                Site::redirectToWithMsg(LIST_URL, "Función actualizada correctamente");
                break;
            case "DEL":
                FuncionesDAO::delete($this->viewData["fncod"]);
                Site::redirectToWithMsg(LIST_URL, "Función eliminada correctamente");
                break;
        }
    }

    private function prepareView() {
        $this->viewData["modeDsc"] = sprintf($this->modes[$this->viewData["mode"]], $this->viewData["fncod"]);
        $this->viewData["fnest" . $this->viewData["fnest"]] = "selected";
        $this->viewData["readonly"] = ($this->viewData["mode"] !== "INS") ? "readonly" : "";
    }
}