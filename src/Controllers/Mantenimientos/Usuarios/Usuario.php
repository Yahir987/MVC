<?php 
namespace Controllers\Mantenimientos\Usuarios;

use Controllers\PublicController;
use Dao\Usuario\Usuarios as UsuariosDAO;
use Views\Renderer;
use Utilities\Site;
use Utilities\Validators;

const LIST_URL = "index.php?page=Mantenimientos-Usuarios-Usuarios";

class Usuario extends PublicController {
    private array $viewData;
    private array $estados;
    private array $tipos;
    private array $modes;

    public function __construct() {
        $this->modes = [
            "INS" => "Creando nuevo Usuario",
            "UPD" => "Modificando Usuario %s (%s)",
            "DEL" => "Eliminando Usuario %s (%s)",
            "DSP" => "Detalles del Usuario %s (%s)",
        ];

        $this->estados = ["ACT", "INA", "RTR"];
        $this->tipos = ["NRM", "CON", "CLI"];

        $this->viewData = [
            "usercod" => 0,
            "useremail" => "",
            "username" => "",
            "userest" => "ACT",
            "usertipo" => "NRM",
            "mode" => "",
            "modeDsc" => "",
            "userestACT" => "",
            "userestINA" => "",
            "userestRTR" => "",
            "usertipoNRM" => "",
            "usertipoCON" => "",
            "usertipoCLI" => "",
            "errores" => []
        ];
    }

    public function run(): void {
        $this->capturarModo();
        $this->cargarDatos();
        if ($this->isPostBack()) {
            $this->leerFormulario();
            $this->validarDatos();
            if (count($this->viewData["errores"]) === 0) {
                $this->procesarAccion();
            }
        }
        $this->prepararVista();
        Renderer::render("mnt/usuarios/usuario", $this->viewData);
    }

    private function capturarModo() {
        if (!isset($_GET["mode"]) || !isset($this->modes[$_GET["mode"]])) {
            Site::redirectToWithMsg(LIST_URL, "Modo no válido");
        }
        $this->viewData["mode"] = $_GET["mode"];
    }

    private function cargarDatos() {
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["usercod"] = intval($_GET["id"]);
            $tmpUsuario = UsuariosDAO::getUsuarioById($this->viewData["usercod"]);
            if ($tmpUsuario) {
                $this->viewData["useremail"] = $tmpUsuario["useremail"];
                $this->viewData["username"] = $tmpUsuario["username"];
                $this->viewData["userest"] = $tmpUsuario["userest"];
                $this->viewData["usertipo"] = $tmpUsuario["usertipo"];
            } else {
                Site::redirectToWithMsg(LIST_URL, "Usuario no encontrado");
            }
        }
    }

    private function leerFormulario() {
        $this->viewData["useremail"] = $_POST["useremail"] ?? "";
        $this->viewData["username"] = $_POST["username"] ?? "";
        $this->viewData["userest"] = $_POST["userest"] ?? "ACT";
        $this->viewData["usertipo"] = $_POST["usertipo"] ?? "NRM";
    }

    private function validarDatos() {
        if (Validators::IsEmpty($this->viewData["useremail"])) {
            $this->viewData["errores"]["useremail"] = "El email es obligatorio";
        } elseif (!Validators::IsValidEmail($this->viewData["useremail"])) {
            $this->viewData["errores"]["useremail"] = "Email inválido";
        }

        if (!in_array($this->viewData["userest"], $this->estados)) {
            $this->viewData["errores"]["userest"] = "Estado no válido";
        }

        if (!in_array($this->viewData["usertipo"], $this->tipos)) {
            $this->viewData["errores"]["usertipo"] = "Tipo de usuario no válido";
        }
    }

    private function procesarAccion() {
        switch ($this->viewData["mode"]) {
            case "INS":
                if (UsuariosDAO::nuevoUsuario(
                    $this->viewData["useremail"],
                    $this->viewData["username"],
                    $this->viewData["userest"],
                    $this->viewData["usertipo"]
                ) > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Usuario creado exitosamente");
                } else {
                    $this->viewData["errores"]["global"] = ["Error al crear usuario"];
                }
                break;

            case "UPD":
                if (UsuariosDAO::actualizarUsuario(
                    $this->viewData["usercod"],
                    $this->viewData["useremail"],
                    $this->viewData["username"],
                    $this->viewData["userest"],
                    $this->viewData["usertipo"]
                ) > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Usuario actualizado correctamente");
                } else {
                    $this->viewData["errores"]["global"] = ["No se pudo actualizar el usuario"];
                }
                break;

            case "DEL":
                if (UsuariosDAO::eliminarUsuario($this->viewData["usercod"])) {
                    Site::redirectToWithMsg(LIST_URL, "Usuario eliminado correctamente");
                } else {
                    $this->viewData["errores"]["global"] = ["No se pudo eliminar el usuario"];
                }
                break;
        }
    }

    private function prepararVista() {
        $this->viewData["modeDsc"] = sprintf(
            $this->modes[$this->viewData["mode"]],
            $this->viewData["useremail"],
            $this->viewData["usercod"]
        );

        $this->viewData["userest" . $this->viewData["userest"]] = "selected";
        $this->viewData["usertipo" . $this->viewData["usertipo"]] = "selected";

        if (count($this->viewData["errores"]) > 0) {
            foreach ($this->viewData["errores"] as $campo => $error) {
                $this->viewData["error_" . $campo] = $error;
            }
        }
    }
}