<section class="py-4 px-4 depth-2">
    <h2>Listado de Vehiculos</h2>
</section>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Id del Vehiculo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año de Fabricación</th>
                <th>Tipo de Combustible</th>
                <th>Kilometraje</th>
            </tr>
        </thead>
        <tbody>
            {{foreach vehiculos}}
            <tr>
                <td>{{id_vehiculo}}</td>
                <td>{{marca}}</td>
                <td>{{modelo}}</td>
                <td>{{ano_fabricacion}}</td>
                <td>{{tipo_combustible}}</td>
                <td>{{kilometraje}}</td>
            </tr>
            <tr>
                <td><a href="index.php?page=Mantenimientos-Vehiculo&mode=INS">Nuevo</a></td>
                <td><a href="index.php?page=Mantenimientos-Vehiculo&mode=UPD&id_vehiculo={{id_vehiculo}}">Editar</a></td>
                <td><a href="index.php?page=Mantenimientos-Vehiculo&mode=DEL&id_vehiculo={{id_vehiculo}}">Eliminar</a></td>
                <td><a href="index.php?page=Mantenimientos-Vehiculo&mode=DSP&id_vehiculo={{id_vehiculo}}">Ver</a></td>
            </tr>
            {{endfor vehiculos}}

        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="center">
                    Registros: {{total}}
                </td>
                <br>
            </tr>
        </tfoot>
    </table>
</section>