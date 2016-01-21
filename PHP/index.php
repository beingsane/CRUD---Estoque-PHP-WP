<?php require_once('header.php'); ?>
    <div class="container theme-showcase" role="main">
        <div class="jumbotron">
            <h1>Controle de estoque</h1>
            <p>Teste de conhecimento a Service IT por Vitor Henrique da Silva</p>
        </div>
        <div class="row">
            <div class="col-md-4">
              <div class="page-header"><h1>Produtos</h1></div>
              <?php $products = get_list('produto', 5, $connection);
              if(!empty($products)){
                echo '<table class="table"><thead><tr><th>#</th><th>Nome</th><th>Descricao</th><th>Preço</th></tr></thead><tbody>';
                foreach($products as $product){
                  echo '<tr><td>'.$product['id'].'</td><td>'.$product['nome'].'</td><td>'.$product['descricao'].'</td><td>R$ '.$product['preco'].'</td></tr>';
                }
                echo '</tbody></table>';
              } ?>
            </div>

            <div class="col-md-4">
              <div class="page-header"><h1>Clientes</h1></div>
              <?php $clients = get_list('cliente', 5, $connection);
              if(!empty($clients)){
                echo '<table class="table"><thead><tr><th>#</th><th>Nome</th><th>Email</th><th>Telefone</th></tr></thead><tbody>';
                foreach($clients as $client){
                  echo '<tr><td>'.$client['id'].'</td><td>'.$client['nome'].'</td><td>'.$client['email'].'</td><td>'.$client['telefone'].'</td></tr>';
                }
                echo '</tbody></table>';
              } ?>
            </div>

            <div class="col-md-4">
              <div class="page-header"><h1>Pedidos</h1></div>
              <?php $orders = get_list('pedido', 5, $connection);
              if(!empty($orders)){
                echo '<table class="table"><thead><tr><th>Produto</th><th>Cliente</th></tr></thead><tbody>';
                foreach($orders as $order){
                  echo '<tr><td>'.get_name_by_id('produto', $order['produto_id'], $connection).'</td><td>'.get_name_by_id('cliente', $order['cliente_id'], $connection).'</td></tr>';
                }
                echo '</tbody></table>';
              } ?>
            </div>
        </div>
<?php require_once('footer.php'); ?>