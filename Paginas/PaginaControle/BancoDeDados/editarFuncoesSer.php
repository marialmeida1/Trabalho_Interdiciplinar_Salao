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

    // Tabela Pessoa
    $resut_ser = "SELECT * FROM tiposervico WHERE id='$idPagina'";
    $resultado_ser =  mysqli_query($conn, $resut_ser);
    $row_ser = mysqli_fetch_assoc($resultado_ser);


    //Variaveis Cadastro
    $nome = filter_input(INPUT_POST, 'nome');
    $desc = filter_input(INPUT_POST, 'desc');
    $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT);
    $id = filter_input(INPUT_POST, 'id');


    $tbSer = "UPDATE  trabalhosalao.tiposervico SET nome='$nome', descricao='$desc', valorUnitario='$valor' WHERE id='$id' ";

    $tbSer_resultado =  mysqli_query($conn, $tbSer);

    /*if (mysqli_affected_rows($conn)) {
        echo "<script language='javascript'type='text/javascript'>window.location.href='../Paginas/CriarFunc.php'</script>";
    } else {
        echo "<script language='javascript'type='text/javascript'>alert('Você não alterou nenhuma informação');
  window.location.href='../Paginas/CriarFunc.php'</script>";
    }*/


    $conn->close();
    ?>
</body>

</html>