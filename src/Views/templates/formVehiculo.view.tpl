<section class="container">
    <section class="depth-2">
        <h2>{{modeDsc}}</h2>
    </section>
    {{if hasErrores}}
    <ul class="error">
        {{foreach errores}}
        <li>{{this}}</li>
        {{endfor errores}}
    </ul>
    {{endif hasErrores}}
    <form action="index.php?page=Mantenimientos-Vehiculo&mode={{mode}}&id={{id_vehiculo}}" method="POST">
        <div>
            <label for="id">Id</label>
            <input type="text" name="id" id="id" value="{{id_vehiculo}}" {{codigoReadonly}} />
            <input type="hidden" name="vlt" value="{{token}}">
        </div>
        <div>
            <label for="marca">Marca</label>
            <input type="text" name="marca" id="marca" value="{{marca}}" {{readonly}} />
        </div>
        <div>
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo" id="modelo" value="{{modelo}}" {{readonly}} />
        </div>
        <div>
            <label for="ano_fabricacion">Año de Fabricación</label>
            <input type="text" name="ano_fabricacion" id="ano_fabricacion" value="{{ano_fabricacion}}" {{readonly}} />
        </div>
        <div>
            <label for="tipo_combustible">Tipo de Combustible</label>
            <input type="text" name="tipo_combustible" id="tipo_combustible" value="{{tipo_combustible}}" {{readonly}} />
        </div>
        <div>
            <label for="kilometraje">Kilometraje</label>
            <input type="text" name="kilometraje" id="kilometraje" value="{{kilometraje}}" {{readonly}} />
        </div>
        <div>
            <button id="btnCancelar">Cancelar</button>
            {{ifnot isDisplay}}
            <button id="btnConfirmar" type="submit">Confirmar</button>
            {{endifnot isDisplay}}
        </div>
    </form>
</section>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("btnCancelar").addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=Mantenimientos-Vehiculos");
        });
    });
</script>
