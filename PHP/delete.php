<?php require_once('connection.php'); $connection = connectionFactory(); require_once('functions.php');
	if(delete_item($_GET['id'], $_GET['type'], $connection) == 'true'){
		$index = $_SERVER['HTTP_HOST'].'/estoque/';
		header("Location: http://$index");
	}
?>