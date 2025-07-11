<section class="depth-2 px-4 py-2">
    <h2>Mantenimiento de Roles</h2>
</section>
<section class="WWList my-4">
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>
                    <a href="index.php?page=Mantenimientos-Roles-Rol&mode=INS&id=">Nuevo</a>
                </th>
            </tr>
        </thead>
        <tbody>
            {{foreach roles}}
            <tr>
                <td>{{rolescod}}</td>
                <td>{{rolesdsc}}</td>
                <td>{{rolesest}}</td>
                <td>
                    <a href="index.php?page=Mantenimientos-Roles-Rol&mode=DSP&id={{rolescod}}">Ver</a>&nbsp;
                    <a href="index.php?page=Mantenimientos-Roles-Rol&mode=UPD&id={{rolescod}}">Editar</a>&nbsp;
                    <a href="index.php?page=Mantenimientos-Roles-Rol&mode=DEL&id={{rolescod}}">Eliminar</a>
                </td>
            </tr>
            {{endfor roles}}
        </tbody>
    </table>
</section>