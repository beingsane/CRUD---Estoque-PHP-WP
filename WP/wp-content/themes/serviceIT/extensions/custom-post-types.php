<?php

// Products register
	add_action('init', 'products_register');
	function products_register(){
		$singular_label = 'produto';
		$labels = array(
			'name'					=> __('Produtos'),
			'singular_name'			=> __('Produto'),
			'add_new'				=> __('Adicionar novo'),
			'add_new_item'			=> __('Adicionar novo').' '.$singular_label,
			'edit_item'				=> __('Editar').' '.$singular_label,
			'new_item'				=> __('Novo').' '.$singular_label,
			'view_item'				=> __('Ver').' '.$singular_label,
			'search_items'			=> __('Procurar').' '.$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'capability_type'		=> 'post',
			'hierarchical'			=> false,
			'menu_icon' 			=> 'dashicons-products',
			'menu_position'			=> 7,
			'has_archive'			=> false,
			'exclude_from_search'	=> true,
			'supports'				=> array('title', 'excerpt'),
			'taxonomies'			=> array('category')
		);
		register_post_type('produto', $args);
	}

// Products register
	add_action('init', 'order_register');
	function order_register(){
		$singular_label = 'pedido';
		$labels = array(
			'name'					=> __('Pedidos'),
			'singular_name'			=> __('Pedido'),
			'add_new'				=> __('Adicionar novo'),
			'add_new_item'			=> __('Adicionar novo').' '.$singular_label,
			'edit_item'				=> __('Editar').' '.$singular_label,
			'new_item'				=> __('Novo').' '.$singular_label,
			'view_item'				=> __('Ver').' '.$singular_label,
			'search_items'			=> __('Procurar').' '.$singular_label,
			'not_found'				=> __('Nada encontrado'),
			'not_found_in_trash'	=> __('Nada encontrado no lixo'),
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'capability_type'		=> 'post',
			'hierarchical'			=> false,
			'menu_icon' 			=> 'dashicons-cart',
			'menu_position'			=> 7,
			'has_archive'			=> false,
			'exclude_from_search'	=> true,
			'supports'				=> array('title')
		);
		register_post_type('pedido', $args);
	}
?>