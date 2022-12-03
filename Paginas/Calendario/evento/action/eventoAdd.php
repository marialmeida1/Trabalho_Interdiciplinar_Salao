<?php

	// Inicia uma session
	if(!isset($_SESSION)){
		session_start();
	}

	require_once('conexao.php');
	$database = new Database();
	$db = $database->conectar();

	// Verifica de todos os dados estao sendo inseridos
	if (isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['inicio']) && isset($_POST['termino']) && isset($_POST['cor'])){
		

		// Pega os valores variável do modal criado em calendario 
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$inicio = $_POST['inicio'];
		$termino = $_POST['termino'];
		$cor = $_POST['cor'];
		$id_usuario = $_SESSION['idUsuario'];
		$convidado = $_POST['convidado'];

		$inicio= date('Y/m/d H:i:s', strtotime($inicio));
		$termino= date('Y/m/d H:i:s', strtotime($termino));

		// Insere tudo dentro da tabela evento no BD
		$sql = "INSERT INTO eventos(fk_id_usuario, titulo, descricao, inicio, termino, cor) values ('$id_usuario', '$titulo', '$descricao', '$inicio', '$termino', '$cor')";
		
		echo $sql;
		
		$query = $db->prepare( $sql );
		if ($query == false) {
			print_r($db->errorInfo());
			die ('Erro ao carregar');
		}
		
		$sth = $query->execute();
		if ($sth == false) {
			print_r($query->errorInfo());
			die ('Erro ao executar');
		}

		//Seleciona ultimo evento e incrementa a tabela 'convites' se necessario

		// O desc limit vai pegar o ultimo id inserido em evento
		$ultimoEvento = "SELECT * FROM eventos ORDER BY id_evento DESC LIMIT 1";	
		$req = $db->prepare($ultimoEvento);
		$req->execute();
		$linhas = $req->rowCount();
		if ($linhas == 1) {
			// Pega os dadosde evento
			while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
				$id_evento = $dados['id_evento'];
			}
		}

		// Insere dentro da tabela convite
		$sql2 = "INSERT INTO convites(fk_id_destinatario, fk_id_remetente, fk_id_evento, status) values ('$convidado', '$id_usuario', '$id_evento', null)";
		$query2 = $db->prepare( $sql2 );
		$query2->execute();



	}
	header('Location: '.$_SERVER['HTTP_REFERER']);
