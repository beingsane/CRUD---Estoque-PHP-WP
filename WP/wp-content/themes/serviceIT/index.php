<?php get_header(); global $themePrefix; ?>
	<div class="container theme-showcase" role="main">
        <div class="jumbotron">
            <h1><?php echo get_bloginfo('name')?></h1>
            <p><?php echo get_bloginfo('description')?></p>
        </div>
        <div class="row">
            <div class="col-md-4">
              <div class="page-header"><h1>Produtos</h1></div>
              <?php $products = get_posts(array('post_type'=>'produto'));
              if(!empty($products)){
                echo '<table class="table"><thead><tr><th>#</th><th>Nome</th><th>Descricao</th><th>Preço</th></tr></thead><tbody>';
                foreach($products as $product){
                  echo '<tr><td>'.$product->ID.'</td><td>'.$product->post_title.'</td><td>'.apply_filters('the_content', $product->post_content).'</td><td>R$ '.get_post_meta($product->ID, $themePrefix.'price', true).'</td></tr>';
                }
                echo '</tbody></table>';
              } ?>
            </div>

            <div class="col-md-4">
              <div class="page-header"><h1>Clientes</h1></div>
              <?php $clients = get_users();              
              if(!empty($clients)){
                echo '<table class="table"><thead><tr><th>#</th><th>Nome</th><th>Email</th><th>Telefone</th></tr></thead><tbody>';
                foreach($clients as $client){
                  echo '<tr><td>'.$client->ID.'</td><td>'.$client->user_nicename.'</td><td>'.$client->user_email.'</td><td>'.get_user_meta($client->ID, $themePrefix.'telephone', true).'</td></tr>';
                }
                echo '</tbody></table>';
              } ?>
            </div>

            <div class="col-md-4">
              <div class="page-header"><h1>Pedidos</h1></div>
              <?php $orders = get_posts(array('post_type'=>'pedido'));
              if(!empty($orders)){
                echo '<table class="table"><thead><tr><th>Produto</th><th>Cliente</th></tr></thead><tbody>';
                foreach($orders as $order){
                  $user = get_userdata($order->post_author);
                  echo '<tr><td>'.get_the_title(get_post_meta($order->ID, $themePrefix.'orderProduct', true)).'</td><td>'.$user->user_nicename.'</td></tr>';
                }
                echo '</tbody></table>';
              } ?>
            </div>
        </div>
<?php get_footer(); ?>