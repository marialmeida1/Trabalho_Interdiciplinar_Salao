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
    $email = filter_input(INPUT_POST, 'email');
    $tel = filter_input(INPUT_POST, 'tel');
    $senha = filter_input(INPUT_POST, 'senha');
    $city = filter_input(INPUT_POST, 'city');
    $rua = filter_input(INPUT_POST, 'rua');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $numCasa = filter_input(INPUT_POST, 'numCasa', FILTER_SANITIZE_NUMBER_INT);
    $cpf = filter_input(INPUT_POST, 'cpf');
    $rg = filter_input(INPUT_POST, 'rg');



    //Verifica 
    $verifica = mysqli_query($conn, "SELECT * FROM pessoa WHERE pessoa.pesEmail = '$email' limit 1");


    if (mysqli_num_rows($verifica) > 0) {

        echo "<script language='javascript'type='text/javascript'>alert('Esse usuário já existe!');window.location.href='../Paginas/CriarFunc.php'</script>";
    } else {

        if (empty($nome) || empty($email) || empty($tel) || empty($senha) || empty($city) || empty($rua) || empty($bairro)  || empty($cpf) || empty($rg) || empty($numCasa)) {
            echo "<script language='javascript'type='text/javascript'>alert('Há dados vazios!');window.location.href='../Paginas/CriarFunc.php'</script>";
        } else {
            $tbPessoa = "INSERT INTO trabalhosalao.pessoa(pesNome, pesEmail, pesCpf, pesRg) VALUES ('$nome', '$email', '$cpf', '$rg')";

            if ($conn->query($tbPessoa) === TRUE) {
                $last_id = $conn->insert_id;
                $tbEndereco = "INSERT INTO trabalhosalao.endereco(endRua, endNro, endBairro, endCidade, endPes_id) VALUES ('$rua', $numCasa, '$bairro', '$city', '$last_id')";

                if ($conn->query($tbEndereco) === TRUE) {
                    $tbTelefone = "INSERT INTO trabalhosalao.telefone(telNumero, telPes_id) VALUES ('$tel', '$last_id')";

                    if ($conn->query($tbTelefone) === TRUE) {
                        $tbFuncionario = "INSERT INTO trabalhosalao.funcionario(funSenha, funPes_id) VALUES (MD5('$senha'), '$last_id')";

                        if ($conn->query($tbFuncionario) === TRUE) {
                            echo "<script language='javascript'type='text/javascript'>window.location.href='../Paginas/CriarFunc.php'</script>";
                        } else {
                            echo "<script language='javascript'type='text/javascript'>alert('Você deve preencher todos os valores!');window.location.href='../Cadastro/index.html'</script>";
                        }
                    }
                } else {
                    echo "Error: " . $tbPessoa . "<br>" . $conn->error;
                }
            }
        }







        echo  "<br>" .  "<br>" . "Não existe";
    }


    $conn->close();
    ?>
</body>

</html>