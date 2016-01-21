<?php
// Theme prefix
	global $themePrefix;
	$themePrefix = "vhs_";

// Define templateurl
	define('TEMPLATEURL', get_template_directory_uri());

// Make theme available for translation
	load_theme_textdomain('lang', TEMPLATEPATH . '/languages');

// Location defaults
	date_default_timezone_set('Brazil/East');
	setlocale(LC_ALL, 'pt_BR');
	define("CHARSET", "utf-8");
	
// Enqueue scripts
	add_action('wp_enqueue_scripts', 'vhs_enqueue_scripts_and_styles');
	function vhs_enqueue_scripts_and_styles(){
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '', true);
		wp_enqueue_script('bootstrapDocs', get_template_directory_uri() . '/assets/js/docs.min.js', array('jquery'), '', true);
	}

// Admin extensions
	$extensions_path = TEMPLATEPATH . '/extensions/';

	if(file_exists($extensions_path . 'custom-post-types.php')) require_once($extensions_path . 'custom-post-types.php');
	if(file_exists($extensions_path . 'custom-functions.php')) require_once($extensions_path . 'custom-functions.php');

// Custom theme options
	if(!class_exists('ReduxFramework') && file_exists($extensions_path . 'redux/framework.php')) require_once($extensions_path . 'redux/framework.php');
	if(file_exists($extensions_path . 'custom-theme-options.php')) require_once($extensions_path . 'custom-theme-options.php');

// Custom metaboxes
	add_action('init', 'vhs_admin_init');
	function vhs_admin_init(){
		if(file_exists($extensions_path . 'custom-metaboxes/init.php')) require_once($extensions_path . 'custom-metaboxes/init.php');
	}
	if(file_exists($extensions_path . 'custom-post-meta.php')) require_once($extensions_path . 'custom-post-meta.php');
?>