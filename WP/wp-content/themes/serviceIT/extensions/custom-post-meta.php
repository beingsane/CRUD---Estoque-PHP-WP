<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Theme prefix
	global $themePrefix;

	$meta_boxes['products_metabox'] = array(
		'id'         => 'products_metabox',
		'title'      => 'Opções do produto',
		'pages'      => array('produto'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
			    'name' 	=> 'Preço',
			    'desc' 	=> 'Valor em R$',
			    'id' 	=> $themePrefix . 'price',
			    'type' 	=> 'text_money',
			    'before' => 'R$',
			),
		)
	);

	$meta_boxes['users_metabox'] = array(
		'id'         => 'users_metabox',
		'title'      => 'Informações adicionais',
		'pages'      => array('user'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
			    'name' 	=> 'Telefone',
			    'desc' 	=> '+00 (00)0000-00000',
			    'id' 	=> $themePrefix . 'telephone',
			    'type' 	=> 'text'
			),
		)
	);

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'custom-metaboxes/init.php';

}


function productList() {
    global $post, $themePrefix;
    $custom = get_post_custom($post->ID);
    $meta_product = get_post_meta($post->ID, $themePrefix.'orderProduct', true);
    echo '<p><input type="hidden" name="productList-nonce" value="'.wp_create_nonce( 'productList-nonce' ).'" />';
        $products = get_posts(array('post_type'=>'produto', 'posts_per_page'=>-1));
        if(!empty($products)){
        	echo '<select name="productList" style="width:98%;">';
        	foreach($products as $product){
        		if($product->ID == $meta_product){
        			echo '<option value="'.$meta_product.'" selected>'.get_the_title($meta_product).'</option>';	
        		} else{
        			echo '<option value="'.$product->ID.'">'.$product->post_title.'</option>';
        		}
        	}
        	echo '</select>';
        }
      echo '</p>';     
}
add_action( 'admin_init', 'custom_create_meta_product' );
function custom_create_meta_product() {
	global $themePrefix;
    add_meta_box($themePrefix.'orderProduct', 'Produto', 'productList', 'pedido');
}
add_action ('save_post', 'save_custom_meta_product');
function save_custom_meta_product(){
    global $post, $themePrefix;
    if ( !wp_verify_nonce( $_POST['productList-nonce'], 'productList-nonce' )) {return $post->ID;}
    if ( !current_user_can( 'edit_post', $post->ID ))return $post->ID;
    update_post_meta($post->ID, $themePrefix.'orderProduct', $_POST['productList'] );
}

function clientList() {
    global $post, $themePrefix;
    $custom = get_post_custom($post->ID);
    $meta_client = get_post_meta($post->ID, $themePrefix.'orderClient', true);
    echo '<p><input type="hidden" name="clientList-nonce" value="'.wp_create_nonce( 'clientList-nonce' ).'" />';
        $clients = get_users();
        if(!empty($clients)){
        	echo '<select name="clientList" style="width:98%;">';
        	foreach($clients as $client){
        		if($client->ID == $meta_client){
        			echo '<option value="'.$meta_client.'" selected>'.$client->user_nicename.'</option>';	
        		} else{
        			echo '<option value="'.$client->ID.'">'.$client->user_nicename.'</option>';
        		}
        	}
        	echo '</select>';
        }
      echo '</p>';     
}
add_action( 'admin_init', 'custom_create_meta_client' );
function custom_create_meta_client() {
	global $themePrefix;
    add_meta_box($themePrefix.'orderClient', 'Cliente', 'clientList', 'pedido');
}
add_action ('save_post', 'save_custom_meta_client');
function save_custom_meta_client(){
    global $post, $themePrefix;
    if ( !wp_verify_nonce( $_POST['clientList-nonce'], 'clientList-nonce' )) {return $post->ID;}
    if ( !current_user_can( 'edit_post', $post->ID ))return $post->ID;
    update_post_meta($post->ID, $themePrefix.'orderClient', $_POST['clientList'] );
}