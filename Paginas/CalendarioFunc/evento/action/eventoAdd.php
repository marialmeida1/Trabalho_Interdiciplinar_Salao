<?php
if (!isset($_SESSION)) {
	session_start();
}

require_once('conexao.php');
$database = new Database();
$db = $database->conectar();

if (isset($_POST['titulo'])  && isset($_POST['cor']) && isset($_POST['inicio']) && isset($_POST['termino'])) {

	$titulo = $_POST['titulo'];
	$cor = $_POST['cor'];
	$inicio = $_POST['inicio'];
	$termino = $_POST['termino'];

	$inicio = date('Y/m/d H:i:s', strtotime($inicio));
	$termino = date('Y/m/d H:i:s', strtotime($termino));


	$sql = "INSERT INTO agenda_funcionario(titulo, inicio, termino, cor) values ('$titulo', '$cor', '$inicio', '$termino')";

	echo $sql;

	$query = $db->prepare($sql);
	if ($query == false) {
		print_r($db->errorInfo());
		die('Erro ao carregar');
	}

	//Seleciona ultimo evento e incrementa a tabela 'convites' se necessario
	$ultimoEvento = "SELECT * FROM agenda_funcionario ORDER BY id DESC LIMIT 1";
	$req = $db->prepare($ultimoEvento);
	$req->execute();
	$linhas = $req->rowCount();
	if ($linhas == 1) {
		while ($dados = $req->fetch(PDO::FETCH_ASSOC)) {
			$id_evento = $dados['id'];
		}
	}
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
