<?php 
    /*
    Plugin Name: Compiler WP
    Plugin URI: http://www.clickunite.com/
    Description: Plugin for compile Wordpress version with installed plugins. Use shortcode [compiler_form] for display steps form
    Author: E. Dokuzov
    Version: 1.0
    Author URI: http://www.clickunite.com/
    */


    /*INI SETTINGS*/
    
    set_time_limit(3);
    ini_set('mysql.connect_timeout', '3');
    ini_set('max_execution_time', '15');

    /*DEFINES*/
    define("COMPILER_PATH", plugin_dir_path(__FILE__));
    define("COMPILER_URL", plugin_dir_url(__FILE__));
    define("COMPILER_FOLDER", WP_CONTENT_DIR."/uploads/compiles/");
    define("COMPILER_STANDART", WP_CONTENT_DIR."/uploads/compiles/standart");
    define("COMPILER_COMMERSE", WP_CONTENT_DIR."/uploads/compiles/e-commerse");
    define("COMPILER_MEMBERSHIP", WP_CONTENT_DIR."/uploads/compiles/membership");
    define("COMPILER_ADMIN_PAGE", get_admin_url(null, 'admin.php?page=compiler_options'));
    
    /*REQUIRES*/
    require_once(COMPILER_PATH."core/system.php");
    require_once(COMPILER_PATH."core/js_enqueue.php");
    require_once(COMPILER_PATH."core/create_compile.php");
    require_once(COMPILER_PATH."core/ajax_handler.php");    
    


    /*INCLUDES*/
    include_once(COMPILER_PATH."core/style_enqueue.php");

    if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
	    session_start();
	}


    add_shortcode("compiler_form", "add_compiler_form");
    function add_compiler_form(){
        if(displayForm())        
            require_once(COMPILER_PATH."templates/steps.php");   
    }
    
    require_once(COMPILER_PATH."core/uploader.php");
     
?>
