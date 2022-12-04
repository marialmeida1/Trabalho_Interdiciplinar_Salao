<?php

/**
 **
 **  BY iCODEART
 **
 **********************************************************************
 **                      REDES SOCIALES                            ****
 **********************************************************************
 **                                                                ****
 ** FACEBOOK: https://www.facebook.com/icodeart                    ****
 ** TWIITER: https://twitter.com/icodeart                          ****
 ** YOUTUBE: https://www.youtube.com/c/icodeartdeveloper           ****
 ** GITHUB: https://github.com/icodeart                            ****
 ** TELEGRAM: https://telegram.me/icodeart                         ****
 ** EMAIL: info@icodeart.com                                       ****
 **                                                                ****
 **********************************************************************
 **********************************************************************
 **/

//incluimos nuestro archivo config
include 'config.php';

// Incluimos nuestro archivo de funciones
include 'funciones.php';

// Obtenemos el id del evento
$id  = evaluar($_GET['id']);

// y lo buscamos en la base de dato
$bd  = $conexion->query("SELECT * FROM evento WHERE eveId=$id");

// Obtenemos los datos
$row = $bd->fetch_assoc();

// titulo 
$result = "SELECT * FROM trabalhosalao.tiposervico";
$resultado = mysqli_query($conexion, $result);

while ($row_func = mysqli_fetch_assoc($resultado)) {
    $servico = $row_func['tipNome'];
}


// Fecha inicio
$inicio = $row['eveInicioNormal'];

// Fecha Termino
$final = $row['eveFimNormal'];

// Eliminar evento
if (isset($_POST['eliminar_evento'])) {
    $id = evaluar($_GET['id']);
    $sql = "DELETE FROM evento WHERE eveId = $id";
    if ($conexion->query($sql)) {
        echo "Evento eliminado";
    } else {
        echo "El evento no se pudo eliminar";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php $servico ?></title>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
</head>

<body>
    <h3><?php $servico ?></h3>
    <hr>
    <b>Fecha inicio:</b> <?php $inicio ?> <br>
    <b>Fecha termino:</b> <?php $final ?> <br>
    <b>Descripcion:</b>
    <p><?php $evento ?></p>
</body>
<form action="" method="post">
    <div class="modal-footer">
        <button type="submit" class="btn btn-danger" name="eliminar_evento">Eliminar</button>
    </div>
</form>

</html>