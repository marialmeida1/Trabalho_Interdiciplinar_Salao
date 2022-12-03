<?php
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('America/Sao_Paulo');

require_once('../evento/action/conexao.php');
$database = new Database();
$db = $database->conectar();


// Valida de as informações do modal estao preenchidas
if (isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['inicio']) && isset($_POST['termino']) && isset($_POST['cor'])) {


	// Pega as variaveis como em um forms
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$inicio = $_POST['inicio'];
	$termino = $_POST['termino'];
	$cor = $_POST['cor'];
	$id_usuario2 = $_POST['id_usuario2'];
	$id_usuario = $_SESSION['idUsuario'];
	$status = 1;
	$id_convite = $_POST['id_convite'];


	// Nao sei, deve ser um complemento de "inicio" e "termino"
	$inicio = date('Y/d/m H:i:s', strtotime($inicio));
	$termino = date('Y/m/d H:i:s', strtotime($termino));

	// Insere no banco da pessoa que foi convidada
	$sql = "INSERT INTO eventos(fk_id_usuario, titulo, descricao, inicio, termino, cor) values ('$id_usuario', '$titulo', '$descricao', '$inicio', '$termino', '$cor')";

	echo $sql;

	$query = $db->prepare($sql);
	if ($query == false) {
		print_r($db->errorInfo());
		die('Erro ao carregar');
	}

	$sth = $query->execute();
	if ($sth == false) {
		print_r($query->errorInfo());
		die('Erro ao executar');
	}

	//Seleciona ultimo evento
	$ultimoEvento = "SELECT * FROM eventos ORDER BY id_evento DESC LIMIT 1";
	$req = $db->prepare($ultimoEvento);
	$req->execute();
	$linhas = $req->rowCount();
	if ($linhas == 1) {
		while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
			$id_evento = $dados['id_evento'];
		}
	}

	// Insere na tabela convite se for necessário
	$sql2 = "INSERT INTO convites(fk_id_destinatario, fk_id_remetente, fk_id_evento, status) values ('$id_usuario', '$id_usuario2', '$id_evento', '$status')";
	$query2 = $db->prepare($sql2);
	$query2->execute();

	$sql3 = "UPDATE convites SET status = '$status' WHERE id_convite=$id_convite";
	$query3 = $db->prepare($sql3);
	$query3->execute();
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
