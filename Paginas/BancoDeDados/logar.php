<?php

include("conexaoBD.php");
if (!isset($_SESSION)) {
    session_start();
}



//Variaveis Login
$email = filter_input(INPUT_POST, 'emailLogado');
$senha = filter_input(INPUT_POST, 'senhaLogado');
$verEmail = mysqli_query($conn, "SELECT * FROM pessoa WHERE pessoa.pesEmail = '$email' limit 1");
$verSenhaPatrao = mysqli_query($conn, "SELECT * FROM gerente WHERE gerente.gerSenha = '$senha' limit 1");

// Valida Gerente
if ((mysqli_num_rows($verEmail) > 0) && (mysqli_num_rows($verSenhaPatrao) > 0)) {
    echo "<script language='javascript'type='text/javascript'>window.location.href='../PaginaControle/index.php'</script>";
} else {
    $verSenhaFuncionario = mysqli_query($conn, "SELECT * FROM funcionario WHERE funcionario.funSenha = MD5('$senha') limit 1");

    // Valida Funcionario
    if ((mysqli_num_rows($verEmail) > 0) && (mysqli_num_rows($verSenhaFuncionario) > 0)) {
        echo "<script language='javascript'type='text/javascript'>window.location.href='../PaginaFuncionario/index.php'</script>";
    } else {
        $verSenha = mysqli_query($conn, "SELECT * FROM cliente WHERE cliente.cliSenha = MD5('$senha') limit 1");

        //Valida Cliente
        if ((mysqli_num_rows($verEmail) > 0) && (mysqli_num_rows($verSenha) > 0)) {

            $resultPessoa = "SELECT * FROM pessoa WHERE pesEmail = '$email'";
            $resultadoP = mysqli_query($conn, $resultPessoa);

            while ($row = mysqli_fetch_assoc($resultadoP)) {
                echo "<script language='javascript'type='text/javascript'>window.location.href='../Calendario/index.php'</script>";
            }
        } else {
            echo "<script language='javascript'type='text/javascript'>alert('Esse usuário não existe faça o cadastro!');window.location.href='../Cadastro/index.html'</script>";
        }
    }
}







$conn->close();
