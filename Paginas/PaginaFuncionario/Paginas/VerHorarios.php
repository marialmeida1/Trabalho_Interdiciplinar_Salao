<?php

include("/xampp/htdocs/TrabalhoSalao/Paginas/BancoDeDados/conexaoBD.php");

// Consulta tabelas
$resultPessoa = "SELECT * FROM pessoa ";
$resultEnde = "SELECT * FROM endereco ";
$resultTelefone = "SELECT * FROM telefone ";
$resultFuncionario = "SELECT * FROM funcionario";

$resultadoP = mysqli_query($conn, $resultPessoa);
$resultadoE = mysqli_query($conn, $resultEnde);
$resultadoT = mysqli_query($conn, $resultTelefone);
$resultadoF = mysqli_query($conn, $resultFuncionario);


// Mostra resultado tabelas



while ($row_func = mysqli_fetch_assoc($resultadoP)) {

    // Verifica se são funcionarios
    $pessoa_id = $row_func['pesId'];
    $consulta = mysqli_query($conn, "SELECT * FROM funcionario WHERE funPes_id = '$pessoa_id' limit 1");


    if (mysqli_num_rows($consulta) > 0) { // entra

        // html
?>
        <article class="stat-cards-item " id="caixaFunc">
            <div class="stat-cards-info" id="tamanho">
                <?php
                echo "<h4>" . $row_func['pesNome'] . "</h4>";
                ?>
            </div>
        </article>

        <article class="stat-cards-item " id="tamanho">
            <div class="stat-cards-info" id="tamanho">
        <?php


        $pegarIdFun = "SELECT * FROM funcionario";



        // Irá imprimir endereço
        while ($row_func2 = mysqli_fetch_assoc($resultadoE)) {

            if ($row_func2['endPes_id'] == $newId) {


                echo "Rua: " . $row_func2['endRua'] . "  |  Bairro: " . $row_func2['endBairro'] . "  |  Cidade: " . $row_func2['endCidade']  . "  |  Número: " . $row_func2['endNro'] . "<br>";


                while ($row_func3 = mysqli_fetch_assoc($resultadoT)) {

                    if ($row_func3['telPes_id'] == $newId) {
                        echo "Telefone: " . $row_func3['telNumero'] . "<br>";
                        break;
                    } else {
                    }
                }
                break;
            } else {
            }
        }
        echo "<hr>";
    } else {
    }
}


        ?>
            </div>
        </article>
        <?php

        ?>