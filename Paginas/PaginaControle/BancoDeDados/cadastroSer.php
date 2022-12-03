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


    //Variaveis Cadastro
    $nome = filter_input(INPUT_POST, 'nome');
    $desc = filter_input(INPUT_POST, 'desc');
    $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT);



    //Verifica 
    $verifica = mysqli_query($conn, "SELECT * FROM tiposervico WHERE tiposervico.tipNome = '$nome' limit 1");


    if (mysqli_num_rows($verifica) > 0) {

        echo "<script language='javascript'type='text/javascript'>alert('Esse usuário já existe!');window.location.href='../Paginas/CriarServ.php'</script>";
    } else {

        if (empty($nome) || empty($desc) || empty($valor)) {
            echo "<script language='javascript'type='text/javascript'>alert('Há dados vazios!');window.location.href='../Paginas/CriarServ.php'</script>";
        } else {
            $tbSer = "INSERT INTO trabalhosalao.tiposervico(tipNome, tipDescricao, tipValorunitario) VALUES ('$nome', '$desc', '$valor')";

            if ($conn->query($tbSer) === TRUE) {
                echo "<script language='javascript'type='text/javascript'>window.location.href='../Paginas/CriarServ.php'</script>";
            } else {
                echo "Erro!";
            }
        }

        echo  "<br>" .  "<br>" . "Não existe";
    }


    $conn->close();
    ?>
</body>

</html>