<?php
/*
* styles_enqueue
* version: 1.0
*/

/*
*Add css files frontend
*
*v1.0
*
*/
add_action( 'wp_enqueue_scripts', 'add_styles' );
function add_styles() {
	if(wp_get_theme()!="Impreza" && wp_get_theme()!="Impreza Child"){	
		wp_enqueue_style( 'stylesheet', COMPILER_URL.'css/stylesheet.min.css');
	}else{
		wp_enqueue_style( 'stylesheet', COMPILER_URL.'css/style.min.css');
	}	
	wp_enqueue_style( 'font-awesome', COMPILER_URL.'css/font-awesome.css');
}

/**************************************************************************************/
/*
*Add css files Backend
*
*v1.0
*
*/
function compiler_form_admin() {
	    wp_enqueue_style('compiler_form_admin', COMPILER_URL.'css/org/compiler_form_admin.css');
	    wp_enqueue_style('waiting_admin', COMPILER_URL.'css/org/waiting.css');
	    wp_enqueue_style( 'font-awesome', COMPILER_URL.'css/font-awesome.css');
	}
add_action('admin_enqueue_scripts', 'compiler_form_admin');
add_action('login_enqueue_scripts', 'compiler_form_admin');
?>