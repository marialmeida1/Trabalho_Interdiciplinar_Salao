
<?php

include("/xampp/htdocs/TrabalhoSalao/Paginas/BancoDeDados/conexaoBD.php");

// Consulta tabelas
$resultPessoa = "SELECT * FROM pessoa";
$resultFun = "SELECT * FROM funcionario ";
$resultTipSer = "SELECT * FROM tiposervico ";
$resultEvento = "SELECT * FROM evento ";


$resultadoP = mysqli_query($conn, $resultPessoa);
$resultadoF = mysqli_query($conn, $resultFun);
$resultadoS = mysqli_query($conn, $resultTipSer);
$resultadoE = mysqli_query($conn, $resultEvento);


// Pega valores unitários ta tabela pessoa
while ($row_func = mysqli_fetch_assoc($resultadoP)) {

    // Pega o id da pessoa 
    $pessoa_id = $row_func['pesId'];

    // Verifica se na tabela funcionário existe esse id
    $consulta = mysqli_query($conn, "SELECT * FROM funcionario WHERE funPes_id = '$pessoa_id' limit 1");

    // Se ele existir vai imprimir o nome
    if (mysqli_num_rows($consulta) > 0) {

        // Imprime o nome
        echo "<div id='box1'>";
        echo "<h4>" . $row_func['pesNome'] . "</h4><hr>";

        // Pega novamente o id da pessoa
        $newId = $row_func['pesId'];

        // Pega valores unitarios ta tabela tipo de funcionários
        while ($row_func2 = mysqli_fetch_assoc($resultadoF)) {

            // Pega o id de funcionario
            $idFuncionario = $row_func2["funId"];

            while ($row_func3 = mysqli_fetch_assoc($resultadoE)) {
                $soma = 0;
                if ($row_func3["eveFun_id"] == $idFuncionario) {
                    $soma = $soma + 1;
                    echo "Serviço " . $soma . "<br>";

                    echo "Início: " . $row_func3["eveInicioNormal"];
                    echo " | Término: " . $row_func3["eveFimNormal"] . "<br>";

                    // Pega id serviço
                    $idServico = $row_func3["eveTip_id"];
                    while ($row_func4 = mysqli_fetch_assoc($resultadoS)) {
                        if ($row_func4["tipId"] == $idServico) {
                            echo "Serviço: " . $row_func4["tipNome"] . "<br>";
                            break;
                        }
                    }
                }
            }
        }
        echo "</div>";
    } else {
    }
}

?>