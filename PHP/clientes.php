<?php require_once('header.php'); ?>
<div class="container theme-showcase" role="main">
    <div class="jumbotron">
        <h1>Cadastro de novos clientes</h1>
        <p>Preencha o formulário para adicionar um novo cliente.</p>
    </div>
    <?php if($_POST){
    	if($_POST['action'] == 'update'){
    		if(update_client($_POST['id'], $_POST['name'], $_POST['email'], $_POST['tel'], $connection) == 'true'){
	    		echo '<div class="row"><div class="alert alert-success" role="alert"><strong>Sucesso! </strong>Seu cliente foi atualizado.</div></div>';
	    	} else{
	    		echo '<div class="alert alert-danger" role="alert"><strong>Ops... </strong> Houve um erro, tente novamente.</div>';
	    	}
    	} else{
    		if(add_client($_POST['name'], $_POST['email'], $_POST['tel'], $connection) == 'true'){
	    		echo '<div class="row"><div class="alert alert-success" role="alert"><strong>Sucesso! </strong>Seu cliente foi adicionado.</div></div>';
	    	} else{
	    		echo '<div class="alert alert-danger" role="alert"><strong>Ops... </strong> Houve um erro, tente novamente.</div>';
	    	}
    	}
    	
    } ?>
    <div class="row">
	    <div class="col-md-8">
	    	<?php if($_GET && is_numeric($_GET['id'])){ 
		    	$object = get_data('cliente', $_GET['id'], $connection); ?>
		    	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
		    		<input type="hidden" value="update" name="action" />
	    			<input type="hidden" value="<?php echo $_GET['id']; ?>" name="id" />
		    		<div class="form-group">
					    <label for="name">Nome:</label>
					    <input type="text" class="form-control" id="name" value="<?php echo $object['nome']; ?>" name="name" maxlength="45" required>
				  	</div>
				  	<div class="form-group">
					    <label for="email">Email:</label>
					    <input type="email" class="form-control" id="email" value="<?php echo $object['email']; ?>" name="email" maxlength="45" required>
				  	</div>
				  	<div class="form-group">
					    <label for="tel">Telefone</label>
					    <input type="number" class="form-control" id="tel" value="<?php echo $object['telefone']; ?>" name="tel" required>
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
					    <label for="email">Email:</label>
					    <input type="email" class="form-control" id="email" name="email" maxlength="45" required>
				  	</div>
				  	<div class="form-group">
					    <label for="tel">Telefone</label>
					    <input type="number" class="form-control" id="tel" name="tel" required>
				  	</div>
				  	<input type="reset" class="btn btn-lg btn-default" />
				  	<input type="submit" class="btn btn-lg btn-success" />
		    	</form>
		    <?php } ?>
	    </div>
	    <div class="col-md-4">
	    	<?php $lasts = get_list('cliente',' ', $connection); 
	    	if(!empty($lasts)){
	    		echo '<h3>Clientes</h3>';
	    		echo '<ul class="list-group">';
	    		foreach($lasts as $last){
	    			echo '<li class="list-group-item"><h4 class="list-group-item-heading">'.$last['nome'].'</h4><p class="list-group-item-text">'.$last['email'].'</p><p class="list-group-item-text">'.$last['telefone'].'</p><a href="?id='.$last['id'].'" class="btn btn-xs btn-link">Editar</a><a href="delete.php?id='.$last['id'].'&type=cliente" class="btn btn-xs btn-link">Excluir</a></li>';
		    	}
				echo '</ul>';
	    	} ?>
	    </div>
	</div>
<?php require_once('footer.php'); ?>