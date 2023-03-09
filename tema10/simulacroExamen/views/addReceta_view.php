<?php
/**
 * @author Hugo Vicente Peligro
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Receta</title>
</head>

<body>
    <h1>Cocina Saludable</h1>
    <h3>Añadir Recetas</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Titulo de la receta: <input type="text" name="titulo"></label>
        <label>Ingredientes: <input type="text" name="ingredientes"></label>
        <label>Elaboración <input type="text" name="elaboracion"></label>
        <label>Etiquetas: <input type="text" name="etiquetas"></label>
        <label>Publicar: <input type="number" name="publica"></label>
        <label>Imagen: <input type="file" name="file"></label>
        <input type="submit" name="add" value="Añadir">
    </form>
    <form action="" method="POST">
        <input type="submit" name="inicio" value="Volver al inicio">
    </form>
</body>

</html>