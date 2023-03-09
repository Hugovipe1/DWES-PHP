<?php
if ($_SESSION["perfil"] == "invitado") {

?>
    <form action="" method="post">
        <label>Usuario: <input type="text" name="usuario"></label><br /><br />
        <label>Password: <input type="password" name="password"></label>
        <label>Perfil:
            <select name="perfil">
                <option value="Admin">Administrador</option>
                <option value="Collaborator">Colaborador</option>
                <option value="User">Usuario</option>
            </select>
        </label>
        <input type="submit" name="enviar" value="Enviar"><br /><br />
    </form>
<?php
}
?>