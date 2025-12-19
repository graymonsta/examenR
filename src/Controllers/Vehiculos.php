<?php

namespace Controllers\Mantenimientos;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Vehiculos\Vehiculos as DAOVehiculos;

class Vehiculos extends PublicController
{
    public function run(): void
    {
        $DataVehiculos = [];
        $tmpVehiculos = DAOVehiculos::obtenerVehiculos();
        $DataVehiculos["vehiculos"] = $tmpVehiculos;
        $DataVehiculos["total"] = count($DataVehiculos["vehiculos"]);
        Renderer::render("mantenimientos/vehiculos/listaVehic", $DataVehiculos);
    }
}
