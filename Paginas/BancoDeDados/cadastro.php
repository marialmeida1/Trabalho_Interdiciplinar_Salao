<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastra</title>
</head>

<body>
    <?php

    include("conexaoBD.php");

    //Variaveis Cadastro
    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email');
    $tel = filter_input(INPUT_POST, 'tel');
    $senha = filter_input(INPUT_POST, 'senha');
    $city = filter_input(INPUT_POST, 'city');
    $rua = filter_input(INPUT_POST, 'rua');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $numCasa = filter_input(INPUT_POST, 'numCasa');




    //Verifica 
    $verifica = mysqli_query($conn, "SELECT * FROM pessoa WHERE pessoa.email = '$email' limit 1");


    if (mysqli_num_rows($verifica) > 0) {

        echo "<script language='javascript'type='text/javascript'>alert('Esse usuário já existe!');window.location.href='../Cadastro/index.html'</script>";
    } else {


        if (empty($nome) || empty($email) || empty($tel) || empty($senha) || empty($city) || empty($rua) || empty($bairro) || empty($numCasa)) {

            echo "<script language='javascript'type='text/javascript'>alert('Todos os campos devem estar preenchidos!');window.location.href='../Cadastro/index.html'</script>";
        } else {
            $tbPessoa = "INSERT INTO trabalhosalao.pessoa(nome, email, cpf, rg) VALUES ('$nome', '$email', NULL, NULL)";

            if ($conn->query($tbPessoa) === TRUE) {
                $last_id = $conn->insert_id;
                $tbEndereco = "INSERT INTO trabalhosalao.endereco(rua, nro, bairro, cidade, pessoa_id) VALUES ('$rua', NULL, '$bairro', '$city', '$last_id')";

                if ($conn->query($tbEndereco) === TRUE) {
                    $tbTelefone = "INSERT INTO trabalhosalao.telefone(numero, pessoa_id) VALUES ('$tel', '$last_id')";

                    if ($conn->query($tbTelefone) == TRUE) {
                        $tbCliente = "INSERT INTO trabalhosalao.cliente(senha, pessoa_id) VALUES (MD5('$senha'), '$last_id')";

                        if ($conn->query($tbCliente) == TRUE) {
                            echo "window.location.href='../Cadastro/index.html'</script>";
                        }
                    }
                } else {
                    echo "<script language='javascript'type='text/javascript'>alert('Você deve preencher todos os valores!');window.location.href='../Cadastro/index.html'</script>";
                }
            } else {
                echo "Error: " . $tbPessoa . "<br>" . $conn->error;
            }
        }








        echo  "<br>" .  "<br>" . "Não existe";
    }

    $conn->close();
    ?>
</body>

</html>