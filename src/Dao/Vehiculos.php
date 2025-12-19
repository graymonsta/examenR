<?php

namespace Dao\Vehiculos;

use Dao\Table;

class Vehiculos extends Table
{
    public static function obtenerVehiculos(): array
    {
        $sqlstr = "SELECT * from DatosVehiculos;";
        return self::obtenerRegistros($sqlstr, []);
    }

    public static function obtenerVehiculosPorCodigo(string $id_vehiculo): array
    {
        $sqlstr = "SELECT * from DatosVehiculos where id_vehiculo=:id_vehiculo";
        return self::obtenerUnRegistro($sqlstr, ["id_vehiculo" => $id_vehiculo]);
    }

    public static function crearRegistroVehiculo(
        string $id_vehiculo,
        string $marca,
        string $modelo,
        int $ano_fabricacion,
        string $tipo_combustible,
        int $kilometraje
    ) {
        $insSql = "INSERT INTO DatosVehiculos (id_vehiculo, marca, modelo, ano_fabricacion, tipo_combustible, kilometraje)
        values (:id_vehiculo, :marca, :modelo, :ano_fabricacion, :tipo_combustible, :kilometraje);";

        $insertData = [
            "id_vehiculo" => $id_vehiculo,
            "marca" => $marca,
            "modelo" => $modelo,
            "ano_fabricacion" => $ano_fabricacion,
            "tipo_combustible" => $tipo_combustible,
            "kilometraje" => $kilometraje,
        ];
        return self::executeNonQuery($insSql, $insertData);
    }

    public static function actualizarVehiculo(
        string $id_vehiculo,
        string $marca,
        string $modelo,
        int $ano_fabricacion,
        string $tipo_combustible,
        int $kilometraje
    ) {
        $updSql = "UPDATE DatosVehiculos set marca=:marca, modelo=:modelo, ano_fabricacion=:ano_fabricacion, 
        tipo_combustible=: tipo_combustible, kilometraje=:kilometraje where id_vehiculo=:id_vehiculo;";

        $UpdateData = [
            "id_vehiculo" => $id_vehiculo,
            "marca" => $marca,
            "modelo" => $modelo,
            "ano_fabricacion" => $ano_fabricacion,
            "tipo_combustible" => $tipo_combustible,
            "kilometraje" => $kilometraje,
        ];
        return self::executeNonQuery($updSql, $UpdateData);
    }

    public static function eliminarVehiculo(string $id_vehiculo)
    {
        $delSql = "DELETE from DatosVehiculos where id_vehiculo=:id_vehiculo;";
        $DeleteParameter = [
            "id_vehiculo" => $id_vehiculo
        ];
        return self::executeNonQuery($delSql, $DeleteParameter);
    }
}
