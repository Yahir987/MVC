<section class="depth-2 px-4 py-2">
    <h2>{{modeDsc}}</h2>
</section>

<section class="WWList my-4">
    <div><strong>Código: {{rolescod}}</strong></div>
    <div><strong>Descripción: {{rolesdsc}}</strong></div>
    <div><strong>Estado: {{rolesest}}</strong></div>
</section>

<section class="grid py-4 px-4 my-4">
    <div class="row">
        <div class="col-12 offset-m-1 col-m-10 offset-l-3 col-l-6">
            <form action="index.php?page=Mantenimientos-Roles-Rol&mode={{mode}}&id={{rolescod}}" method="post" class="row">
                <div class="row">
                    <label class="col-12 col-m-4">Código</label>
                    <input type="text" class="col-12 col-m-8" name="rolescod" value="{{rolescod}}" {{readonly}} />
                </div>
                <div class="row">
                    <label class="col-12 col-m-4">Descripción</label>
                    <input type="text" class="col-12 col-m-8" name="rolesdsc" value="{{rolesdsc}}" />
                </div>
                <div class="row">
                    <label class="col-12 col-m-4">Estado</label>
                    <select name="rolesest" class="col-12 col-m-8">
                        <option value="ACT" {{rolesestACT}}>Activo</option>
                        <option value="INA" {{rolesestINA}}>Inactivo</option>
                        <option value="RTR" {{rolesestRTR}}>Retirado</option>
                    </select>
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
        window.location.href = "index.php?page=Mantenimientos-Roles-Roles";
    });
});
</script>