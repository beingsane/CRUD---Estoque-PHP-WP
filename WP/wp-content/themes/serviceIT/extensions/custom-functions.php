<?php
// Remove default post type
add_action('admin_menu','remove_default_post_type');
function remove_default_post_type() {
	remove_menu_page('edit.php');
	remove_menu_page('edit.php?post_type=page');
	remove_menu_page('edit-comments.php');
	remove_menu_page('upload.php');
	remove_menu_page('themes.php');
	remove_menu_page('tools.php');
	remove_menu_page('plugins.php');
}

add_action('init', 'remove_roles');
function remove_roles(){
	remove_role('subscriber');
	remove_role('editor');
	remove_role('contributor');
	remove_role('author');
}
?>