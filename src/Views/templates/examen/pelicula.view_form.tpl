<section class="depth-2 px-2 py-2">
    <h2>{{modeDsc}}</h2>
</section>

<section class="grid py-4 px-4 my-4">
    <div class="row">
        <div class="col-12 offset-m-1 col-m-10 offset-l-3 col-l-6">
            <form class="row" action="index.php?page=Examen_Peliculas&mode={{mode}}&id={{id_pelicula}}" method="post">
                <div class="row">
                    <label for="id_pelicula" class="col-12 col-m-4">ID Película</label>
                    <input readonly type="text" class="col-12 col-m-8" name="id_pelicula" id="id_pelicula" value="{{id_pelicula}}" />
                    <input type="hidden" name="xsrToken" value="{{xsrToken}}" />
                </div>

                <div class="row">
                    <label for="titulo" class="col-12 col-m-4">Título</label>
                    <input type="text" class="col-12 col-m-8" name="titulo" id="titulo" value="{{titulo}}" {{readonly}} />
                    {{if error_titulo}}
                        <span class="error col-12 col-m-8">{{error_titulo}}</span>
                    {{endif error_titulo}}
                </div>

                <div class="row">
                    <label for="director" class="col-12 col-m-4">Director</label>
                    <input type="text" class="col-12 col-m-8" name="director" id="director" value="{{director}}" {{readonly}} />
                    {{if error_director}}
                        <span class="error col-12 col-m-8">{{error_director}}</span>
                    {{endif error_director}}
                </div>

                <div class="row">
                    <label for="año_estreno" class="col-12 col-m-4">Año de Estreno</label>
                    <input type="number" class="col-12 col-m-8" name="año_estreno" id="año_estreno" value="{{año_estreno}}" {{readonly}} />
                    {{if error_año_estreno}}
                        <span class="error col-12 col-m-8">{{error_año_estreno}}</span>
                    {{endif error_año_estreno}}
                </div>

                <div class="row">
                    <label for="genero" class="col-12 col-m-4">Género</label>
                    <input type="text" class="col-12 col-m-8" name="genero" id="genero" value="{{genero}}" {{readonly}} />
                    {{if error_genero}}
                        <span class="error col-12 col-m-8">{{error_genero}}</span>
                    {{endif error_genero}}
                </div>

                <div class="row">
                    <label for="duracion_min" class="col-12 col-m-4">Duración (minutos)</label>
                    <input type="number" class="col-12 col-m-8" name="duracion_min" id="duracion_min" value="{{duracion_min}}" {{readonly}} />
                    {{if error_duracion_min}}
                        <span class="error col-12 col-m-8">{{error_duracion_min}}</span>
                    {{endif error_duracion_min}}
                </div>

                <div class="row flex-end">
                    <button id="btnCancel">
                        {{if showAction}}
                            Cancelar
                        {{endif showAction}}
                        {{ifnot showAction}}
                            Volver
                        {{endifnot showAction}}
                    </button>
                    &nbsp;
                    {{if showAction}}
                    <button class="primary">Confirmar</button>
                    {{endif showAction}}
                </div>

                {{if error_global}}
                    {{foreach error_global}}
                        <div class="error col-12 col-m-8">{{this}}</div>
                    {{endfor error_global}}
                {{endif error_global}}

            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("btnCancel").addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=Examen_Peliculas");
        });
    });
</script>
