<?php require_once('header.php'); ?>
<div class="container theme-showcase" role="main">
    <div class="jumbotron">
        <h1>Cadastro de novos pedidos</h1>
        <p>Preencha o formulário para adicionar um novo pedido.</p>
    </div>
    <?php if($_POST){
    	if(add_order($_POST['product'], $_POST['client'], $connection) == 'true'){
    		echo '<div class="row"><div class="alert alert-success" role="alert"><strong>Sucesso! </strong>Seu pedido foi adicionado.</div></div>';
    	} else{
    		echo '<div class="alert alert-danger" role="alert"><strong>Ops... </strong> Houve um erro, tente novamente.</div>';
    	}
    } ?>
    <div class="row">
	    <div class="col-md-8">
	    	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
	    		<div class="form-group">
				    <label for="product">Produto:</label>
				    <select class="form-control" id="product" name="product" required>
				    	<?php $products = get_list('produto', ' ', $connection);
				    	foreach($products as $product){
				    		echo '<option value="'.$product['id'].'">'.$product['nome'].'</option>';
				    	} ?>
				    </select>
			  	</div>
			  	<div class="form-group">
				    <label for="client">Cliente:</label>
				    <select class="form-control" id="client" name="client" required>
				    <?php $clients = get_list('cliente', ' ', $connection);
				    	foreach($clients as $client){
				    		echo '<option value="'.$client['id'].'">'.$client['nome'].'</option>';
				    	} ?>
				    </select>
			  	</div>
			  	<input type="submit" class="btn btn-lg btn-success" />
	    	</form>
	    </div>
	    <div class="col-md-4">
	    	<?php $lasts = get_list('pedido',' ', $connection); 
	    	if(!empty($lasts)){
	    		echo '<h3>Pedidos</h3><h6>Pedidos não podem ser alterados para preservar o histórico.</h6';
	    		echo '<ul class="list-group">';
	    		foreach($lasts as $last){
	    			echo '<li class="list-group-item"><h4 class="list-group-item-heading">'.get_name_by_id('produto', $last['produto_id'], $connection).'</h4><p class="list-group-item-text">'.get_name_by_id('cliente', $last['cliente_id'], $connection).'</p></li>';
		    	}
				echo '</ul>';
	    	} ?>
	    </div>
	</div>
<?php require_once('footer.php'); ?>