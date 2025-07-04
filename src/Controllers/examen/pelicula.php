<?php

namespace Controllers\examen\Pelicula\form;

use Controllers\PublicController;
use Dao\examen\peliculas as PeliculasDao;
use Utilities\Site;
use Utilities\Validators;
use Views\Renderer;

const LIST_URL = "index.php?page=Examen_Peliculas";
const XSR_KEY = "xsrToken_peliculas";

class pelicula extends PublicController
{
    private array $viewData;
    private array $modes;

    public function __construct()
    {
        $this->modes = [
            "INS" => 'Creando nueva Película',
            "UPD" => 'Modificando Película',
            "DEL" => 'Eliminando Película',
            "DSP" => 'Mostrando Película'
        ];
        $this->viewData = [
            "id_pelicula" => 0,
            "titulo" => "",
            "director" => "",
            "año_estreno" => "",
            "genero" => "",
            "duracion_min" => "",
            "mode" => "",
            "errores" => []
        ];
    }

    public function run(): void
    {
        $this->capturarModoPantalla();
        $this->datosDeDao();

        if ($this->isPostBack()) {
            $this->datosFormulario();
            $this->validarDatos();

            if (count($this->viewData["errores"]) === 0) {
                $this->procesarDatos();
            }
        }

        $this->prepararVista();
        Renderer::render("examen/pelicula_form", $this->viewData);
    }

    private function throwError(string $message)
    {
        Site::redirectToWithMsg(LIST_URL, $message);
    }
private function capturarModoPantalla()
{
    if (isset($_GET["mode"])) {
        $this->viewData["mode"] = $_GET["mode"];
        if (!isset($this->modes[$this->viewData["mode"]])) {
            $this->throwError("BAD REQUEST: Modo inválido.");
        }
    } else {
        // Redirecciona a la lista si no hay mode
        Site::redirectToWithMsg(LIST_URL, "Modo no especificado, redireccionado.");
    }
}



    private function datosDeDao()
    {
        if ($this->viewData["mode"] != "INS") {
            if (isset($_GET["id"])) {
                $this->viewData["id_pelicula"] = intval($_GET["id"]);
                $pelicula = PeliculasDao::getPeliculasById($this->viewData["id_pelicula"]);
                if ($pelicula) {
                    $this->viewData["titulo"] = $pelicula["titulo"];
                    $this->viewData["director"] = $pelicula["director"];
                    $this->viewData["año_estreno"] = $pelicula["año_estreno"];
                    $this->viewData["genero"] = $pelicula["genero"];
                    $this->viewData["duracion_min"] = $pelicula["duracion_min"];
                } else {
                    $this->throwError("No existe la película especificada.");
                }
            } else {
                $this->throwError("Falta el parámetro ID.");
            }
        }
    }

    private function datosFormulario()
    {
        $campos = ["titulo", "director", "año_estreno", "genero", "duracion_min"];
        foreach ($campos as $campo) {
            if (isset($_POST[$campo])) {
                $this->viewData[$campo] = trim($_POST[$campo]);
            }
        }

        if (isset($_POST["xsrToken"])) {
            $this->viewData["xsrToken"] = $_POST["xsrToken"];
        }
    }

    private function validarDatos()
    {
        if (Validators::IsEmpty($this->viewData["titulo"])) {
            $this->viewData["errores"]["titulo"] = "El título es requerido";
        }

        if (Validators::IsEmpty($this->viewData["director"])) {
         $this->viewData["errores"]["director"] = "El director es requerido";
        }

        if (Validators::IsEmpty($this->viewData["genero"])) {
            $this->viewData["errores"]["genero"] = "El género es requerido";
        }

        if (!is_numeric($this->viewData["año_estreno"]) || $this->viewData["año_estreno"] < 1800 || $this->viewData["año_estreno"] > date("Y")) {
            $this->viewData["errores"]["año_estreno"] = "El año de estreno debe ser un número válido entre 1800 y el año actual.";
        }

        if (!is_numeric($this->viewData["duracion_min"]) || $this->viewData["duracion_min"] <= 0) {
            $this->viewData["errores"]["duracion_min"] = "La duración debe ser un número positivo.";
        }

        if ($this->viewData["xsrToken"] !== $_SESSION[XSR_KEY]) {
            error_log("Token inválido detectado");
            $this->throwError("Solicitud no válida. Intente nuevamente.");
        }
    }

    private function procesarDatos()
    {
        switch ($this->viewData["mode"]) {
            case "INS":
                if (
                    PeliculasDao::nuevaPeliculas(
                        $this->viewData["titulo"],
                        $this->viewData["director"],
                        $this->viewData["año_estreno"],
                        $this->viewData["genero"],
                        $this->viewData["duracion_min"]
                    )
                ) {
                    Site::redirectToWithMsg(LIST_URL, "Película agregada exitosamente.");
                } else {
                   $this->viewData["errores"]["global"] = "Error al agregar la película.";
                }
                break;

            case "UPD":
                if (
                    PeliculasDao::actualizarPeliculas(
                        $this->viewData["id_pelicula"],
                        $this->viewData["titulo"],
                        $this->viewData["director"],
                        $this->viewData["año_estreno"],
                        $this->viewData["genero"],
                        $this->viewData["duracion_min"]
                    )
                ) {
                    Site::redirectToWithMsg(LIST_URL, "Película actualizada correctamente.");
                } else {
                    $this->viewData["errores"]["global"] = "Error al actualizar la película.";
                }
                break;

            case "DEL":
                if (
                    PeliculasDao::eliminarPeliculas($this->viewData["id_pelicula"])
                ) {
                    Site::redirectToWithMsg(LIST_URL, "Película eliminada correctamente.");
                } else {
                  $this->viewData["errores"]["global"] = "No se pudo eliminar la película.";
                }
                break;
        }
    }

    private function prepararVista()
    {
        $this->viewData["modeDsc"] = $this->modes[$this->viewData["mode"]];

        if (count($this->viewData["errores"]) > 0) {
            foreach ($this->viewData["errores"] as $campo => $error) {
                $this->viewData["error_" . $campo] = $error;
            }
        }

        if (in_array($this->viewData["mode"], ["DEL", "DSP"])) {
            $this->viewData["readonly"] = "readonly";
        }

        if ($this->viewData["mode"] === "DSP") {
            $this->viewData["showAction"] = false;
        }

        $this->viewData["xsrToken"] = hash("sha256", random_int(0, 1000000) . time() . 'peliculas' . $this->viewData["mode"]);
        $_SESSION[XSR_KEY] = $this->viewData["xsrToken"];
    }
}
