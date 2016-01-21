<?php require_once('header.php'); ?>
<div class="container theme-showcase" role="main">
    <div class="jumbotron">
        <h1>Cadastro de novos produtos</h1>
        <p>Preencha o formulário para adicionar um novo produto.</p>
    </div>
    <?php if($_POST){
    	if($_POST['action'] == 'update'){
    		if(update_produto($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $connection) == 'true'){
	    		echo '<div class="row"><div class="alert alert-success" role="alert"><strong>Sucesso! </strong>Seu produto foi atualizado.</div></div>';
	    	} else{
	    		echo get_error();
	    	}
    	} else{
    		if(add_produto($_POST['name'], $_POST['description'], $_POST['price'], $connection) == 'true'){
	    		echo '<div class="row"><div class="alert alert-success" role="alert"><strong>Sucesso! </strong>Seu produto foi adicionado.</div></div>';
	    	} else{
	    		echo get_error();
	    	}
    	}
    } ?>
    <div class="row">
	    <div class="col-md-8">
	    	<?php if($_GET && is_numeric($_GET['id'])){ 
	    		$object = get_data('produto', $_GET['id'], $connection);?>
	    		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
	    			<input type="hidden" value="update" name="action" />
	    			<input type="hidden" value="<?php echo $_GET['id']; ?>" name="id" />
		    		<div class="form-group">
					    <label for="name">Nome:</label>
					    <input type="text" class="form-control" id="name" value="<?php echo $object['nome']; ?>" name="name" maxlength="45" required>
				  	</div>
				  	<div class="form-group">
					    <label for="description">Descrição:</label>
					    <textarea class="form-control" id="description" name="description" maxlength="50" rows="5" required><?php echo $object['descricao']; ?></textarea>
				  	</div>
				  	<div class="form-group">
					    <label for="price">Preço: R$</label>
					    <input type="number" class="form-control" id="price" value="<?php echo $object['preco']; ?>" name="price" required>
				  	</div>
				  	<input type="reset" class="btn btn-lg btn-default" />
				  	<input type="submit" class="btn btn-lg btn-success" />
		    	</form>
	    	<?php } else{ ?>
	    	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
	    		<input type="hidden" value="insert" name="action" />
	    		<div class="form-group">
				    <label for="name">Nome:</label>
				    <input type="text" class="form-control" id="name" name="name" maxlength="45" required>
			  	</div>
			  	<div class="form-group">
				    <label for="description">Descrição:</label>
				    <textarea class="form-control" id="description" name="description" maxlength="50" rows="5" required></textarea>
			  	</div>
			  	<div class="form-group">
				    <label for="price">Preço: R$</label>
				    <input type="number" class="form-control" id="price" name="price" required>
			  	</div>
			  	<input type="reset" class="btn btn-lg btn-default" />
			  	<input type="submit" class="btn btn-lg btn-success" />
	    	</form>
	    	<?php } ?>
	    </div>
	    <div class="col-md-4">
	    	<?php $lasts = get_list('produto',' ',  $connection); 
	    	if(!empty($lasts)){
	    		echo '<h3>Produtos</h3>';
	    		echo '<div class="list-group">';
	    		foreach($lasts as $last){
	    			echo '<a class="list-group-item"><h4 class="list-group-item-heading">'.$last['nome'].'</h4><p class="list-group-item-text">R$ '.$last['preco'].'</p><p class="list-group-item-text">'.$last['descricao'].'</p><a href="?id='.$last['id'].'" class="btn btn-xs btn-link">Editar</a><a href="delete.php?id='.$last['id'].'&type=produto" class="btn btn-xs btn-link">Excluir</a></a>';
		    	}
				echo '</div>';
	    	} ?>
	    </div>
	</div>
<?php require_once('footer.php'); ?>