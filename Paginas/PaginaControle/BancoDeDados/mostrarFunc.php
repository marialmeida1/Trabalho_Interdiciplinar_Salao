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

    include("/xampp/htdocs/TrabalhoSalao/Paginas/BancoDeDados/conexaoBD.php");


    // Recebe a página
    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual) ? $pagina_atual : 1);

    // Seta a quantidade de itens por página
    $qtn_por_pagina = 3;

    // Calcula a pagina
    $inicio = ($qtn_por_pagina * $pagina) - $qtn_por_pagina;



    // Consulta tabelas
    $resultPessoa = "SELECT * FROM pessoa LIMIT $inicio, $qtn_por_pagina";
    $resultEnde = "SELECT * FROM endereco LIMIT $inicio, $qtn_por_pagina";
    $resultTelefone = "SELECT * FROM telefone LIMIT $inicio, $qtn_por_pagina";
    $resultFuncionario = "SELECT * FROM funcionario LIMIT $inicio, $qtn_por_pagina";

    $resultadoP = mysqli_query($conn, $resultPessoa);
    $resultadoE = mysqli_query($conn, $resultEnde);
    $resultadoT = mysqli_query($conn, $resultTelefone);
    $resultadoF = mysqli_query($conn, $resultFuncionario);




    // Mostra resultado tabelas



    while ($row_func = mysqli_fetch_assoc($resultadoP)) {

        // Verifica se são funcionarios
        $pessoa_id = $row_func['id'];
        $consulta = mysqli_query($conn, "SELECT * FROM funcionario WHERE pessoa_id = '$pessoa_id' limit 1");


        if (mysqli_num_rows($consulta) > 0) { // entra

            // html
    ?>
            <article class="stat-cards-item " id="caixaFunc">
                <div class="stat-cards-info" id="tamanho">
                    <?php
                    echo "<h4>" . $row_func['nome'] . "</h4>";
                    ?>
                </div>
            </article>

            <article class="stat-cards-item " id="tamanho">
                <div class="stat-cards-info" id="tamanho">
            <?php

            // Imprime o nome do funcionário na tabela pessoa
            echo "Email: " . $row_func['email'] . "  |  CPF: " . $row_func['cpf'] . "  |  RG: " . $row_func['rg'] . "<br>";
            $variavel2 = $row_func['id'];

            // Verifica se o nome da pessoa é igual a endereço

            $newId = $row_func['id'];
            $consulta2 = mysqli_query($conn, "SELECT * FROM endereco WHERE pessoa_id = '$newId' limit 1");


            // Irá imprimir endereço
            while ($row_func2 = mysqli_fetch_assoc($resultadoE)) {

                if ($row_func2['pessoa_id'] == $newId) {


                    echo "Rua: " . $row_func2['rua'] . "  |  Bairro: " . $row_func2['bairro'] . "  |  Cidade: " . $row_func2['cidade']  . "  |  Número: " . $row_func2['nro'] . "<br>";


                    while ($row_func3 = mysqli_fetch_assoc($resultadoT)) {

                        if ($row_func3['pessoa_id'] == $newId) {
                            echo "Telefone: " . $row_func3['numero'] . "<br>";
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



            //Paginação 
            $result_pg = "SELECT count(id) AS num_result FROM pessoa";
            $resultado_pg = mysqli_query($conn, $result_pg);
            $row_pg = mysqli_fetch_assoc($resultado_pg);

            //Quantidade de páginas que terá
            $quantidade_pg = ceil($row_pg['num_result'] / $qtn_por_pagina);


            //Limitar os links
            $max_links = 2;
            ?>
            <span>
                <?php
                echo "<br><p>Paginação: </p>";
                for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                    if ($pag_ant >= 1) {
                        echo  "<a href='CriarFunc.php?pagina= $pag_ant' id='link'> $pag_ant </a>";
                    }
                }

                echo "<a href='CriarFunc.php?pagina= $pagina' id='link1'> $pagina </a>";

                for ($pag_dps = $pagina + 1; $pag_dps <= $pagina + $max_links; $pag_dps++) {
                    if ($pag_dps <= $quantidade_pg) {
                        echo  " <a href='CriarFunc.php?pagina= $pag_dps' id='link'> $pag_dps </a>";
                    }
                }

                ?>
            </span>
            </div>
            </article>





            <?php

            $conn->close();
            ?>
</body>

</html>