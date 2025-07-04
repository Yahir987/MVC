<section class="depth-2 px-2 py-2">
    <h2>Listado de Películas</h2>
</section>

<section class="WWList my-4">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Director</th>
                <th>Año</th>
                <th>Género</th>
                <th>Duración (min)</th>
                <th>
                    <a href="index.php?page=Examen_Peliculas&mode=INS">
                        Nueva
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            {{foreach peliculas}}
            <tr>
                <td>{{id_pelicula}}</td>
                <td>{{titulo}}</td>
                <td>{{director}}</td>
                <td>{{año_estreno}}</td>
                <td>{{genero}}</td>
                <td>{{duracion_min}}</td>
                <td>
                    <a href="index.php?page=Examen_Peliculas&mode=DSP&id={{id_pelicula}}">
                        Ver
                    </a>
                    &nbsp;
                    <a href="index.php?page=Examen_Peliculas&mode=UPD&id={{id_pelicula}}">
                        Editar
                    </a>
                    &nbsp;
                    <a href="index.php?page=Examen_Peliculas&mode=DEL&id={{id_pelicula}}">
                        Eliminar
                    </a>
                </td>
            </tr>
            {{endfor peliculas}}
        </tbody>
    </table>
</section>
