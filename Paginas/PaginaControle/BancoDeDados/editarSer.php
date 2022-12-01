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
    $resultSer = "SELECT * FROM trabalhosalao.tiposervico LIMIT $inicio, $qtn_por_pagina";
    $resultado = mysqli_query($conn, $resultSer);



    // Mostra resultado tabelas


    while ($row_func = mysqli_fetch_assoc($resultado)) {
        echo "<div id='box1'>";
        echo "<h4>" . $row_func['nome'] . "</h4><hr>";
        echo "Descrição: " . $row_func['descricao'] . "  |  Valor: " . $row_func['valorUnitario'] . "<br>";
        echo "<a href='../BancoDeDados/formDoEditarSer.php?id= " . $row_func['id'] . "' id='link'>Editar</a><br><hr>";
        echo "</div>";
    }



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
                echo  "<a href='CriarServ.php?pagina= $pag_ant' id='link'> $pag_ant </a>";
            }
        }

        echo "<a href='CriarServ.php?pagina= $pagina' id='link'> $pagina </a>";

        for ($pag_dps = $pagina + 1; $pag_dps <= $pagina + $max_links; $pag_dps++) {
            if ($pag_dps <= $quantidade_pg) {
                echo  " <a href='CriarServ.php?pagina= $pag_dps' id='link'> $pag_dps </a>";
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