<section class="depth-2 px-4 py-2">
    <h2>Mantenimiento de Usuarios</h2>
</section>
<section class="WWList my-4">
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>
                    <a href="index.php?page=Mantenimientos-Usuarios-Usuario&mode=INS&id=">Nuevo</a>
                </th>
            </tr>
        </thead>
        <tbody>
            {{foreach usuarios}}
            <tr>
                <td>{{usercod}}</td>
                <td>{{useremail}}</td>
                <td>{{username}}</td>
                <td>{{userest}}</td>
                <td>
                    <a href="index.php?page=Mantenimientos-Usuarios-Usuario&mode=DSP&id={{usercod}}">Ver</a>&nbsp;
                    <a href="index.php?page=Mantenimientos-Usuarios-Usuario&mode=UPD&id={{usercod}}">Editar</a>&nbsp;
                    <a href="index.php?page=Mantenimientos-Usuarios-Usuario&mode=DEL&id={{usercod}}">Eliminar</a>
                </td>
            </tr>
            {{endfor usuarios}}
        </tbody>
    </table>
</section>