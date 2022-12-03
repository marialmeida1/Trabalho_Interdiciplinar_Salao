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
    $resut_pessoa = "SELECT * FROM pessoa WHERE pesId='$idPagina'";
    $resultado_pessoa =  mysqli_query($conn, $resut_pessoa);
    $row_pessoa = mysqli_fetch_assoc($resultado_pessoa);

    // Tabela Endereco
    $resut_ende = "SELECT * FROM endereco WHERE endPes_id='$idPagina'";
    $resultado_ende =  mysqli_query($conn, $resut_ende);
    $row_ende = mysqli_fetch_assoc($resultado_ende);

    // Tabela Telefone
    $resut_tel = "SELECT * FROM telefone WHERE telPes_id='$idPagina'";
    $resultado_tel =  mysqli_query($conn, $resut_tel);
    $row_tel = mysqli_fetch_assoc($resultado_tel);

    // Tabela Funcionario
    $resut_func = "SELECT * FROM funcionario WHERE funPes_id='$idPagina'";
    $resultado_func =  mysqli_query($conn, $resut_func);
    $row_func = mysqli_fetch_assoc($resultado_func);



    //Variaveis Cadastro
    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email');
    $tel = filter_input(INPUT_POST, 'tel');
    $senha = filter_input(INPUT_POST, 'senha');
    $city = filter_input(INPUT_POST, 'city');
    $rua = filter_input(INPUT_POST, 'rua');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $numCasa = filter_input(INPUT_POST, 'numCasa');
    $cpf = filter_input(INPUT_POST, 'cpf');
    $rg = filter_input(INPUT_POST, 'rg');

    $id = filter_input(INPUT_POST, 'id');



    //Verifica 

    $tbPessoa = "UPDATE  trabalhosalao.pessoa SET pesNome='$nome', pesEmail='$email', pesCpf='$cpf', pesRg='$rg' WHERE pesId='$id' ";
    $tbEndereco = "UPDATE  trabalhosalao.endereco SET endRua='$rua', endBairro='$bairro', endCidade='$city' WHERE endPes_id='$id' ";
    $tbTelefone = "UPDATE  trabalhosalao.telefone SET telNumero='$tel' WHERE telPes_id='$id' ";
    $tbFuncionario = "UPDATE  trabalhosalao.funcionario SET funSenha='$senha' WHERE funPes_id='$id' ";

    $tbPessoa_resultado =  mysqli_query($conn, $tbPessoa);
    $tbEndereco_resultado =  mysqli_query($conn, $tbEndereco);
    $tbTelefone_resultado =  mysqli_query($conn, $tbTelefone);
    $tbFuncionario_resultado =  mysqli_query($conn, $tbFuncionario);

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