<?php

namespace Controllers\Mantenimientos;

use Controllers\PublicController;
use Utilities\Site;
use Utilities\Validators;
use Views\Renderer;
use Exception;
use Dao\Vehiculos\Vehiculos as DAOVehiculos;

const VehiculosList = 'index.php?page=Mantenimientos-Vehiculos';
const VehiculosView = "mantenimientos/vehiculos/formVehic";

class Vehiculo extends PublicController
{
    private $modes = [
        "INS" => "Registro de Vehículo",
        "UPD" => "Actualizando vehículo: %s",
        "DSP" => "Información del vehículo: %s",
        "DEL" => "Remoción del vehículo: %s"
    ];

    private string $mode = '';

    private string $id_vehiculo = '';
    private string $marca = '';
    private string $modelo = '';
    private int $ano_fabricacion = 0;
    private string $tipo_combustible = '';
    private int $kilometraje = 0;

    private string $Token = '';

    private array $errores = [];

    public function run(): void
    {
        try {
            $this->page_init();

            if ($this->isPostBack()) {
                $this->errores = $this->validarPostData();

                if (count($this->errores) === 0) {
                    switch ($this->mode) {
                        case "INS":
                            $resultado = DAOVehiculos::crearRegistroVehiculo(
                                $this->id_vehiculo,
                                $this->marca,
                                $this->modelo,
                                $this->ano_fabricacion,
                                $this->tipo_combustible,
                                $this->kilometraje
                            );
                            if ($resultado > 0) {
                                Site::redirectToWithMsg(VehiculosList, "Vehículo registrado correctamente.");
                            }
                            break;

                        case "UPD":
                            $resultado = DAOVehiculos::actualizarVehiculo(
                                $this->id_vehiculo,
                                $this->marca,
                                $this->modelo,
                                $this->ano_fabricacion,
                                $this->tipo_combustible,
                                $this->kilometraje
                            );
                            if ($resultado > 0) {
                                Site::redirectToWithMsg(VehiculosList, "Los datos del vehículo fueron actualizados.");
                            }
                            break;

                        case "DEL":
                            $resultado = DAOVehiculos::eliminarVehiculo($this->id_vehiculo);
                            if ($resultado > 0) {
                                Site::redirectToWithMsg(VehiculosList, "Vehículo eliminado del sistema.");
                            }
                            break;
                    }
                }
            }

            Renderer::render(VehiculosView, $this->preparar_datos_vista());

        } catch (Exception $ex) {
            error_log($ex->getMessage());
            Site::redirectToWithMsg(VehiculosList, "Ocurrió un inconveniente. Intente nuevamente.");
        }
    }

    private function page_init()
    {
        if (!isset($_GET["mode"]) || !isset($this->modes[$_GET["mode"]])) {
            throw new Exception("Modo de operación inválido");
        }

        $this->mode = $_GET["mode"];

        if ($this->mode !== "INS") {
            if (!isset($_GET["id_vehiculo"])) {
                throw new Exception("Identificador de vehículo no proporcionado");
            }

            $registro = DAOVehiculos::obtenerVehiculosPorCodigo($_GET["id_vehiculo"]);

            if (!$registro) {
                throw new Exception("No se encontró el vehículo solicitado");
            }

            $this->id_vehiculo = $registro["id_vehiculo"];
            $this->marca = $registro["marca"];
            $this->modelo = $registro["modelo"];
            $this->ano_fabricacion = $registro["ano_fabricacion"];
            $this->tipo_combustible = $registro["tipo_combustible"];
            $this->kilometraje = $registro["kilometraje"];
        }
    }

    private function validarPostData(): array
    {
        $errores = [];

        $this->Token = $_POST["vlt"] ?? '';
        if (
            isset($_SESSION[$this->name . "_token"]) &&
            $_SESSION[$this->name . "_token"] !== $this->Token
        ) {
            throw new Exception("Token de seguridad inválido");
        }

        $this->id_vehiculo = $_POST["id_vehiculo"] ?? '';
        $this->marca = $_POST["marca"] ?? '';
        $this->modelo = $_POST["modelo"] ?? '';
        $this->ano_fabricacion = intval($_POST["ano_fabricacion"] ?? 0);
        $this->tipo_combustible = $_POST["tipo_combustible"] ?? '';
        $this->kilometraje = intval($_POST["kilometraje"] ?? 0);

        if (Validators::IsEmpty($this->marca)) {
            $errores[] = "Debe especificar la marca del vehículo.";
        }

        if (Validators::IsEmpty($this->modelo)) {
            $errores[] = "Debe especificar el modelo del vehículo.";
        }

        return $errores;
    }

    private function TokenValidacion()
    {
        $this->Token = md5(gettimeofday(true) . $this->name . rand(1000, 9999));
        $_SESSION[$this->name . "_token"] = $this->Token;
    }

    private function preparar_datos_vista(): array
    {
        $data = [];

        $data["mode"] = $this->mode;
        $data["modeDsc"] = $this->mode !== "INS"
            ? sprintf($this->modes[$this->mode], $this->marca)
            : $this->modes[$this->mode];

        $data["id_vehiculo"] = $this->id_vehiculo;
        $data["marca"] = $this->marca;
        $data["modelo"] = $this->modelo;
        $data["ano_fabricacion"] = $this->ano_fabricacion;
        $data["tipo_combustible"] = $this->tipo_combustible;
        $data["kilometraje"] = $this->kilometraje;

        $this->TokenValidacion();
        $data["token"] = $this->Token;

        $data["errores"] = $this->errores;
        $data["hasErrores"] = count($this->errores) > 0;

        $data["codigoReadonly"] = $this->mode !== "INS" ? "readonly" : "";
        $data["readonly"] = in_array($this->mode, ["DSP", "DEL"]) ? "readonly" : "";
        $data["isDisplay"] = $this->mode === "DSP";

        return $data;
    }
}
