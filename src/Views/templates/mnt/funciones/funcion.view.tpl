<section class="depth-2 px-4 py-2">
    <h2>{{modeDsc}}</h2>
</section>

<section class="WWList my-4">
    <div><strong>Código: {{fncod}}</strong></div>
    <div><strong>Descripción: {{fndsc}}</strong></div>
    <div><strong>Estado: {{fnest}}</strong></div>
    <div><strong>Tipo: {{fntyp}}</strong></div>
</section>

<section class="grid py-4 px-4 my-4">
    <div class="row">
        <div class="col-12 offset-m-1 col-m-10 offset-l-3 col-l-6">
            <form action="index.php?page=Mantenimientos-Funciones-Funcion&mode={{mode}}&id={{fncod}}" method="post" class="row">
                <div class="row">
                    <label class="col-12 col-m-4">Código</label>
                    <input type="text" class="col-12 col-m-8" name="fncod" value="{{fncod}}" {{readonly}} />
                </div>
                <div class="row">
                    <label class="col-12 col-m-4">Descripción</label>
                    <input type="text" class="col-12 col-m-8" name="fndsc" value="{{fndsc}}" />
                </div>
                <div class="row">
                    <label class="col-12 col-m-4">Estado</label>
                    <select name="fnest" class="col-12 col-m-8">
                        <option value="ACT" {{fnestACT}}>Activo</option>
                        <option value="INA" {{fnestINA}}>Inactivo</option>
                        <option value="RTR" {{fnestRTR}}>Retirado</option>
                    </select>
                </div>
                <div class="row">
                    <label class="col-12 col-m-4">Tipo</label>
                    <input type="text" class="col-12 col-m-8" name="fntyp" value="{{fntyp}}" />
                </div>
                <div class="row flex-end">
                    <button id="btnCancel">Cancelar</button>&nbsp;
                    <button class="primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("btnCancel").addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "index.php?page=Mantenimientos-Funciones-Funciones";
    });
});
</script>

