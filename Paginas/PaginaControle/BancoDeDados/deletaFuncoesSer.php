<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    include("../../BancoDeDados/conexaoBD.php");

    $idPagina = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $resut_ser = "DELETE FROM tiposervico WHERE id='$idPagina'";


    $resultado_ser =  mysqli_query($conn, $resut_ser);



    ?>

</body>

</html>