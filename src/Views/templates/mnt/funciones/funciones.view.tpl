<section class="depth-2 px-4 py-2">
    <h2>Mantenimiento de Funciones</h2>
</section>
<section class="WWList my-4">
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Tipo</th>
                <th>
                    <a href="index.php?page=Mantenimientos-Funciones-Funcion&mode=INS&id=">Nuevo</a>
                </th>
            </tr>
        </thead>
        <tbody>
            {{foreach funciones}}
            <tr>
                <td>{{fncod}}</td>
                <td>{{fndsc}}</td>
                <td>{{fnest}}</td>
                <td>{{fntyp}}</td>
                <td>
                    <a href="index.php?page=Mantenimientos-Funciones-Funcion&mode=DSP&id={{fncod}}">Ver</a>&nbsp;
                    <a href="index.php?page=Mantenimientos-Funciones-Funcion&mode=UPD&id={{fncod}}">Editar</a>&nbsp;
                    <a href="index.php?page=Mantenimientos-Funciones-Funcion&mode=DEL&id={{fncod}}">Eliminar</a>
                </td>
            </tr>
            {{endfor funciones}}
        </tbody>
    </table>
</section>