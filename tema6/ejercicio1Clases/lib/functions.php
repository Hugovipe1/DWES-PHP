<?php
function conectaBD(){
    try {
        $dsn = "mysql:host=localhost;dbname=bd_cb_pokemons";
    
        $db = new PDO($dsn,USER,PASSWD);
        $db -> setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
        $db-> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAME utf8");
        return($db);
    } catch (PDOException $e) {
        echo "Error conexión";
        exit();
    }
}

function getAll($db){
    $sql = "SELECT * FROM equipos";
    $consulta = $db ->prepare($sql);
    $consulta->execute();
    $data = $consulta->fetchAll();
    return $data;
}

function getFilter($db, $equipo){
    $sql = "SELECT * FROM equipos WHERE equipo LIKE ?";
    $consulta = $db->prepare($sql);
    $consulta->execute(array("%$equipo%"));
    $data = $consulta->fetchAll();
    return $data;
}

function deleteTeam($db, $id){
    $sql = "DELETE FROM equipos WHERE id = ?";
    $consulta = $db->prepare($sql);
    $consulta->execute(array($id));
}
function editTeam($db, $data){
    $sql = "update equipos set equipo = ? WHERE id = ?";
    $consulta = $db->prepare($sql);
    $consulta->execute(array($data["nombre"], $data["id"]));
}

function addTeam($db, $data){
    $sql = "INSERT INTO equipos(equipo)values (?)";
    $consulta = $db->prepare($sql);
    $consulta->execute(array($data["nombre"]));
}
function getEquipoById($db,$id){
    $sql = "SELECT equipo FROM equipos WHERE id = ?";
    $consulta = $db->prepare($sql);
    $consulta->execute(array($id));
    $data = $consulta->fetchAll();
    return $data;
}

function getPerfil($db,$data){
    $sql = "SELECT perfil FROM usuarios WHERE user = ? and password = ?";
    $consulta = $db->prepare($sql);
    $consulta->execute(array($data["user"], $data["passwd"]));
    $data = $consulta->fetchAll();
    return $data;
}

?>