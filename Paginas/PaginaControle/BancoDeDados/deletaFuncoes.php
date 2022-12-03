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

    $resut_ende = "DELETE FROM endereco WHERE endPes_id='$idPagina'";
    $resut_tel = "DELETE FROM telefone WHERE telPes_id='$idPagina'";
    $resut_func = "DELETE FROM funcionario WHERE funPes_id='$idPagina'";
    $resut_pessoa = "DELETE FROM pessoa WHERE pesId='$idPagina'";


    $resultado_ende =  mysqli_query($conn, $resut_ende);
    $resultado_tel =  mysqli_query($conn, $resut_tel);
    $resultado_func =  mysqli_query($conn, $resut_func);
    $resultado_pessoa =  mysqli_query($conn, $resut_pessoa);



    ?>

</body>

</html>