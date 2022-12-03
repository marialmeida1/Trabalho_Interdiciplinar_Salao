<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Paginas/cssPagina.css">
</head>

<body>

    <?php

    include("../../BancoDeDados/conexaoBD.php");



    // Recebe a página
    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual) ? $pagina_atual : 1);

    // Seta a quantidade de itens por página
    $qtn_por_pagina = 10;

    // Calcula a pagina
    $inicio = ($qtn_por_pagina * $pagina) - $qtn_por_pagina;



    // Consulta tabelas
    $resultPessoa = "SELECT * FROM pessoa LIMIT $inicio, $qtn_por_pagina";
    $resultEnde = "SELECT * FROM endereco LIMIT $inicio, $qtn_por_pagina";
    $resultTelefone = "SELECT * FROM telefone LIMIT $inicio, $qtn_por_pagina";

    $resultadoP = mysqli_query($conn, $resultPessoa);
    $resultadoE = mysqli_query($conn, $resultEnde);
    $resultadoT = mysqli_query($conn, $resultTelefone);



    // Mostra resultado tabelas



    while ($row_func = mysqli_fetch_assoc($resultadoP)) {

        // Verifica se são funcionarios
        $pessoa_id = $row_func['pesId'];
        $consulta = mysqli_query($conn, "SELECT * FROM funcionario WHERE funPes_id = '$pessoa_id' limit 1");


        if (mysqli_num_rows($consulta) > 0) { // entra
            echo "<div id='box1'>";
            echo "<h4>" . $row_func['pesNome'] . "</h4><hr>";

            // Imprime o nome do funcionário na tabela pessoa
            echo "Email: " . $row_func['pesEmail'] . "  |  CPF: " . $row_func['pesCpf'] . "  |  RG: " . $row_func['pesRg'] . "<br>";
            $variavel2 = $row_func['pesId'];

            // Verifica se o nome da pessoa é igual a endereço

            $newId = $row_func['pesId'];
            $consulta2 = mysqli_query($conn, "SELECT * FROM endereco WHERE endPes_id = '$newId' limit 1");


            // Irá imprimir endereço
            while ($row_func2 = mysqli_fetch_assoc($resultadoE)) {

                if ($row_func2['endPes_id'] == $newId) {


                    echo "Rua: " . $row_func2['endRua'] . "  |  Bairro: " . $row_func2['endBairro'] . "  |  Cidade: " . $row_func2['endCidade']   . "  |  Número: " . $row_func2['endNro'] . "<br>";
                    "<br>";


                    while ($row_func3 = mysqli_fetch_assoc($resultadoT)) {

                        if ($row_func3['telPes_id'] == $newId) {
                            echo "Telefone: " . $row_func3['telNumero'] . "<br>";
                            echo "<a href='../BancoDeDados/formDoDeletar.php?id= " . $row_func['pesId'] . "' id='link'>Deletar</a><br><hr>";

                            break;
                        } else {
                        }
                    }
                    break;
                } else {
                }
            }
            echo "</div>";
        } else {
        }
    }





    //Paginação 
    $result_pg = "SELECT count(pesId) AS num_result FROM pessoa";
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

        echo "<a href='CriarFunc.php?pagina= $pagina' id='link'> $pagina </a>";

        for ($pag_dps = $pagina + 1; $pag_dps <= $pagina + $max_links; $pag_dps++) {
            if ($pag_dps <= $quantidade_pg) {
                echo  " <a href='CriarFunc.php?pagina= $pag_dps' id='link'> $pag_dps </a>";
            }
        }


        //Deletar Dados

        //$id = 1;
        //$result_usuario = "DELETE * FROM pessoas WHERE id=$id";
        //$resultadoUsuario = mysqli_query($conn, $result_usuario);

        ?>
    </span>
    </div>
    </article>





    <?php

    $conn->close();
    ?>
</body>

</html>