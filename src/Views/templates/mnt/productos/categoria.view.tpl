<section class="depth-2 px-2 py-2">
    <h2>{{modeDsc}}</h2>
</section>
<section class="grid py-4 px-4 my-4">
    <div class="row">
        <div class="col-12 offset-m-1 col-m-10 offset-l-3 col-l-6">
            <form class="row" action="index.php?page=Mantenimientos-Productos-Categoria&mode={{mode}}&id={{id}}">
                <div class="row">
                    <label for="id" class="col-12 col-m-4">Id</label>
                    <input type="text" class="col-12 col-m-8" name="id" id="id" value="{{id}}" />
                </div>
                <div class="row">
                    <label for="categoria" class="col-12 col-m-4">Categoría</label>
                    <input type="text" class="col-12 col-m-8" name="categoria" id="categoria" value="{{categoria}}" />
                </div>
                <div class="row">
                    <label for="estado" class="col-12 col-m-4">Estado</label>
                    <select id="estado" name="estado" >
                        <option value="ACT" {{estadoACT}}>Activo</option>
                        <option value="INA" {{estadoINA}}>Inactivo</option>
                        <option value="RTR" {{estadoRTR}}>Retirado</option>
                    </select>
                </div>
                <div class="row flex-end">
                    <button id="btnCancel">Cancel</button>
                    &nbsp;
                    <button class="primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnCancel").addEventListener("click", (e)=>{
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=Mantenimientos-Productos-Categorias")
        });
    });
</script>