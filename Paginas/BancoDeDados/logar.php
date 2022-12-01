<?php

include("conexaoBD.php");


//Variaveis Login
$email = filter_input(INPUT_POST, 'emailLogado');
$senha = filter_input(INPUT_POST, 'senhaLogado');
$verEmail = mysqli_query($conn, "SELECT * FROM pessoa WHERE pessoa.email = '$email' limit 1");
$verSenha = mysqli_query($conn, "SELECT * FROM cliente WHERE cliente.senha = '$senha' limit 1");
$verSenhaFuncionario = mysqli_query($conn, "SELECT * FROM funcionario WHERE funcionario.senha = '$senha' limit 1");
$verSenhaPatrao = mysqli_query($conn, "SELECT * FROM gerente WHERE gerente.senha = '$senha' limit 1");


if ((mysqli_num_rows($verEmail) > 0) && (mysqli_num_rows($verSenhaPatrao) > 0)) {
    echo "<script language='javascript'type='text/javascript'>window.location.href='../Pagina Admin/index.html'</script>";
} else {
    if ((mysqli_num_rows($verEmail) > 0) && (mysqli_num_rows($verSenhaFuncionario) > 0)) {
        echo "To no funcionario";
    } else {

        //Valida Cliente
        if ((mysqli_num_rows($verEmail) > 0) && (mysqli_num_rows($verSenha) > 0) && (mysqli_num_rows($verSenhaFuncionario) < 0)) {
            echo "TEM SIM!";
        } else {
            echo "<script language='javascript'type='text/javascript'>alert('Esse usuário não existe faça o cadastro!');window.location.href='../Cadastro/index.html'</script>";
        }
    }
}




//Valida Funcionario




//Valida Patrao







$conn->close();
