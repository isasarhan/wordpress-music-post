<?php
function music_theme_features()
{
    register_nav_menu('headerMenu', 'Header Menu Location');
    register_nav_menu('footerMenu', 'Footer Menu Location');
}
add_action('after_setup_theme', 'music_theme_features');
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );
?>