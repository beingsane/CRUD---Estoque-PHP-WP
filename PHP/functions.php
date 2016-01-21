<?php 
// Get data to update
function get_data($type, $id, $connection){
	$sql = 'SELECT * FROM '.$type.' WHERE id='.$id;
	$rs = mysqli_query($connection, $sql);
	if($rs->num_rows > 0){
		while($row = $rs->fetch_assoc()) {
			return $row;
		}
	}
}
// Delete
function delete_item($id, $type, $connection){
	$sql = 'delete from '.$type.' where id='.$id;
	if (mysqli_query($connection, $sql)) {return 'true';}
}
// Inser new order
function add_order($product, $client, $connection){
	$sql = 'insert into pedido(produto_id, cliente_id)VALUES("'.$product.'", "'.$client.'")';
	if (mysqli_query($connection, $sql)) {return 'true';}
}
// Inser new client
function add_client($name, $email, $tel, $connection){
	$sql = 'insert into cliente(nome, email, telefone)VALUES("'.$name.'", "'.$email.'", "'.$tel.'")';
	if (mysqli_query($connection, $sql)) {return 'true';}
}
// Update client
function update_client($id, $name, $email, $tel, $connection){
	$sql = 'update cliente set nome="'.$name.'", email="'.$email.'", telefone="'.$tel.'" where id='.$id;
	if (mysqli_query($connection, $sql)) {return 'true';}
}
// Inser new product
function add_produto($name, $description, $price, $connection){
	$sql = 'insert into produto(nome, descricao, preco)VALUES("'.$name.'", "'.$description.'", "'.$price.'")';
	if (mysqli_query($connection, $sql)) {return 'true';}
}
// Update product
function update_produto($id, $name, $description, $price, $connection){
	$sql = 'update produto SET nome="'.$name.'", descricao="'.$description.'", preco="'.$price.'" WHERE id='.$id;
	if (mysqli_query($connection, $sql)) {return 'true';}
}

function get_name_by_id($type, $id, $connection){
	$sql = 'SELECT * FROM '.$type.' WHERE id='.$id;
	$rs = mysqli_query($connection, $sql);
	if($rs->num_rows > 0){
		while($row = $rs->fetch_assoc()) {
			return $row['nome'];
		}
	} else{
		return $type .' '.$id . ' excluído';
	}
}
// Make a list of inserts by type
function get_list($type, $limit, $connection){
	if(is_numeric($limit)){
		$sql = 'SELECT * FROM '.$type.' LIMIT '.$limit;
	} else{
		$sql = 'SELECT * FROM '.$type;
	}
	$rs = mysqli_query($connection, $sql);
	if($rs->num_rows > 0){
		while($row = $rs->fetch_assoc()) {
			$result[] = $row;
		}
		return $result;
	}
}

// Default error message
function get_error(){
	return '<div class="alert alert-danger" role="alert"><strong>Ops... </strong> Houve um erro, tente novamente.</div>';
}
// Get nav menu
function getNav($request){
	switch ($request) {
		case '/ServiceIT-estoque/PHP/produtos.php':
			$menu = '
				<li><a href="/ServiceIT-estoque/PHP/index.php">Home</a></li>
				<li class="active"><a href="/ServiceIT-estoque/PHP/produtos.php">Produtos</a></li>
				<li><a href="/ServiceIT-estoque/PHP/clientes.php">Clientes</a></li>
				<li><a href="/ServiceIT-estoque/PHP/pedidos.php">Pedidos</a></li>';
			break;
		case '/ServiceIT-estoque/PHP/clientes.php':
			$menu = '
				<li><a href="index.php">Home</a></li>
				<li><a href="/ServiceIT-estoque/PHP/produtos.php">Produtos</a></li>
				<li class="active"><a href="/ServiceIT-estoque/PHP/clientes.php">Clientes</a></li>
				<li><a href="/ServiceIT-estoque/PHP/pedidos.php">Pedidos</a></li>';
			break;
		case '/ServiceIT-estoque/PHP/pedidos.php':
			$menu = '
				<li><a href="/ServiceIT-estoque/PHP/index.php">Home</a></li>
				<li><a href="/ServiceIT-estoque/PHP/produtos.php">Produtos</a></li>
				<li><a href="/ServiceIT-estoque/PHP/clientes.php">Clientes</a></li>
				<li class="active"><a href="/ServiceIT-estoque/PHP/pedidos.php">Pedidos</a></li>';
			break;	
		default:
			$menu = '
				<li class="active"><a href="/ServiceIT-estoque/PHP/index.php">Home</a></li>
				<li><a href="/ServiceIT-estoque/PHP/produtos.php">Produtos</a></li>
				<li><a href="/ServiceIT-estoque/PHP/clientes.php">Clientes</a></li>
				<li><a href="/ServiceIT-estoque/PHP/pedidos.php">Pedidos</a></li>';
			break;
	}
	return $menu;
}
?>