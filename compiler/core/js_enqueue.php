<?php 
/*
* js_enqueue
* version: 1.0
*/

/*
*Add javascript files
*
*v1.0
*
*/
function add_scripts_method() {    
    wp_register_script( 'script', COMPILER_URL.'js/production.min.js', array("jquery", "waiting"), '', true);
    wp_enqueue_script( 'script' );
    wp_register_script( 'waiting', COMPILER_URL.'js/jquery.waiting.min.js', array("jquery"), '', true);
    wp_enqueue_script( 'waiting' );
    wp_register_script( 'us-widgets', COMPILER_URL.'js/us.widgets.js', array("jquery"), '', true);
    wp_enqueue_script( 'us-widgets' );    
}    
 
add_action( 'wp_enqueue_scripts', 'add_scripts_method' );



add_action( 'admin_enqueue_scripts', 'admin_scripts_method' );
add_action( 'login_enqueue_scripts', 'admin_scripts_method' );
function admin_scripts_method(){
	wp_enqueue_script( 'waiting_adm', COMPILER_URL.'js/jquery.waiting.min.js', array("jquery"), '', true);
	wp_enqueue_script( 'admin_compiler_script', COMPILER_URL.'js/admin.js', array("jquery", "waiting_adm"), '', true);
}	
?>