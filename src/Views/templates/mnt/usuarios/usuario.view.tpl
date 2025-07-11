<section class="depth-2 px-4 py-2">
    <h2>{{modeDsc}}</h2>
</section>

<section class="WWList my-4">
    <div> <strong>Código: {{usercod}} </strong></div>
    <div> <strong>Email: {{useremail}} </strong></div>
    <div> <strong>Estado: {{userest}} </strong></div>
</section>

<section class="grid py-4 px-4 my-4">
    <div class="row">
        <div class="col-12 offset-m-1 col-m-10 offset-l-3 col-l-6">
            <form action="index.php?page=Mantenimientos-Usuarios-Usuario&mode={{mode}}&id={{usercod}}" method="post" class="row">
                <div class="row">
                    <label class="col-12 col-m-4">Email</label>
                    <input type="email" class="col-12 col-m-8" name="useremail" value="{{useremail}}" required />
                    {{if error_useremail}} <span class="error">{{error_useremail}}</span> {{endif error_useremail}}
                </div>
                <div class="row">
                    <label class="col-12 col-m-4">Nombre</label>
                    <input type="text" class="col-12 col-m-8" name="username" value="{{username}}" />
                </div>
                <div class="row">
                    <label class="col-12 col-m-4">Estado</label>
                    <select name="userest" class="col-12 col-m-8">
                        <option value="ACT" {{userestACT}}>Activo</option>
                        <option value="INA" {{userestINA}}>Inactivo</option>
                        <option value="RTR" {{userestRTR}}>Retirado</option>
                    </select>
                    {{if error_userest}} <span class="error">{{error_userest}}</span> {{endif error_userest}}
                </div>
                <div class="row">
                    <label class="col-12 col-m-4">Tipo</label>
                    <select name="usertipo" class="col-12 col-m-8">
                        <option value="NRM" {{usertipoNRM}}>Normal</option>
                        <option value="CON" {{usertipoCON}}>Consultor</option>
                        <option value="CLI" {{usertipoCLI}}>Cliente</option>
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
        window.location.href = "index.php?page=Mantenimientos-Usuarios-Usuarios";
    });
});
</script>