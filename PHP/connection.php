<?php 
function connectionFactory(){
	$connection =  mysqli_connect("127.0.0.1", "root", "", "estoque");
	if (!$connection) {
	    echo "Falha na conexão." . mysqli_connect_error();
	    exit;
	} else{
		return $connection;
	}
}
?>