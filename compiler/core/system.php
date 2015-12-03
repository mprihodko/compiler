<?php 
/*
* Compile WP 1.0
* System Folders and Files 
* CallBack Content Backend
* version: 1.0
*/

/*
*Create Folders
*
*v1.0
*
*/

function createFolders($filename=COMPILER_FOLDER){
	if (file_exists($filename)) {
	    return false;
	} else {
		@mkdir($filename);
		if($filename==COMPILER_FOLDER){	
			createFolders(COMPILER_STANDART);
			createFolders(COMPILER_COMMERSE);
			createFolders(COMPILER_MEMBERSHIP);	
			createFolders(COMPILER_STANDART.'/wp/');
			createFolders(COMPILER_COMMERSE.'/wp/');
			createFolders(COMPILER_MEMBERSHIP.'/wp/');		
			copy(COMPILER_PATH.'unpacking/db_upload.php', COMPILER_STANDART.'/wp/db_upload.php');	
			copy(COMPILER_PATH.'unpacking/db_upload.php', COMPILER_COMMERSE.'/wp/db_upload.php');		
			copy(COMPILER_PATH.'unpacking/db_upload.php', COMPILER_MEMBERSHIP.'/wp/db_upload.php');
			copy(COMPILER_PATH.'unpacking/unzip.php', COMPILER_FOLDER.'/unzip.php');
		}
	    return true;
	}
}
createFolders();

/*******************************************************************/
/*
*Add Admin Menu
*
*v1.0
*
*/
add_action( 'admin_menu', 'add_admin_dashboard' );
function add_admin_dashboard(){
	add_menu_page( 'WP Compiles', 'WP Compiles', 'manage_options', 'compiler_options', 'callback_compiller', '', 72);
}
add_action('admin_menu', 'register_setting_submenu_page');

function register_setting_submenu_page() {
	add_submenu_page( 'compiler_options', 'Settings', 'Settings', 'manage_options', 'Settings', 'settings_callback' ); 
}


/*******************************************************************/
/*
*Callback Admin Page
*
*v1.0
*
*/
function callback_compiller(){
	$upload_dir = wp_upload_dir();
	if(!createFolders(COMPILER_STANDART)){
		if(file_exists($upload_dir['basedir'].'/compiles/standart/standart.zip')){
			$standart=$upload_dir['baseurl'].'/compiles/standart/standart.zip';
			$standart_dir=$upload_dir['basedir'].'/compiles/standart/standart.zip';
		}
		if(file_exists($upload_dir['basedir'].'/compiles/standart/standart.sql')){
			$standart_mysql=$upload_dir['baseurl'].'/compiles/standart/standart.sql';
			$standart_mysql_dir=$upload_dir['basedir'].'/compiles/standart/standart.sql';
		}
	}
	if(!createFolders(COMPILER_COMMERSE)){
		if(file_exists($upload_dir['basedir'].'/compiles/e-commerse/e-commerse.zip')){
			$ecommerse=$upload_dir['baseurl'].'/compiles/e-commerse/e-commerse.zip';
			$ecommerse_dir=$upload_dir['basedir'].'/compiles/e-commerse/e-commerse.zip';
		}
		if(file_exists($upload_dir['basedir'].'/compiles/e-commerse/e-commerse.sql')){
			$ecommerse_mysql=$upload_dir['baseurl'].'/compiles/e-commerse/e-commerse.sql';
			$ecommerse_mysql_dir=$upload_dir['basedir'].'/compiles/e-commerse/e-commerse.sql';
		}
	}
	if(!createFolders(COMPILER_MEMBERSHIP)){
		if(file_exists($upload_dir['basedir'].'/compiles/membership/membership.zip')){
			$membership=$upload_dir['baseurl'].'/compiles/membership/membership.zip';
			$membership_dir=$upload_dir['basedir'].'/compiles/membership/membership.zip';
		}
		if(file_exists($upload_dir['basedir'].'/compiles/membership/membership.sql')){
			$membership_mysql=$upload_dir['baseurl'].'/compiles/membership/membership.sql';
			$membership_mysql_dir=$upload_dir['basedir'].'/compiles/membership/membership.sql';
		}
	}
	require_once(COMPILER_PATH."templates/upload-compiles.php");
}

/*******************************************************************/
/*
*Callback Admin Page settings ftp
*
*v1.0
*
*/
function settings_callback(){
	require_once(COMPILER_PATH."templates/settings.php");
}

/*******************************************************************/
/*
*Validate Compile
*
*v1.0
*
*/
function validateCompile($file, $type, $folder, $require_type){
	if($type=='application/sql' && $require_type==$type){
		if(!is_array($file) || !$folder){
			return false;
		}	
	}elseif($type=='application/zip' && $require_type==$type){
		if(!is_array($file) || !$folder){
			return false;
		}	
	}else{
		return false;
	}	
	return true;
}


/*******************************************************************/
/*
*Upload Compile
*
*v1.0
*
*/
function uploadCompile($file, $dir, $filename){
	createFolders($dir);
	createFolders($dir.'/wp');	
	cleanDir($dir.'/wp');	
	move_uploaded_file($file['tmp_name'], $dir.'/'.$filename);	
	$zip = new ZipArchive;
    if($zip->open($dir.'/'.$filename)==TRUE){
	    $zip->extractTo($dir.'/wp');	    
	    $zip->close();
	}
	if(prepareFolder($dir.'/wp', $dir, $filename)){
		copy(COMPILER_PATH.'unpacking/index.php', $dir.'/wp/index.php');
		copy(COMPILER_PATH.'unpacking/wp-config.php', $dir.'/wp/wp-config.php');		
	}
	return true;
	
	
}

/*******************************************************************/
/*
*Prepare WP Folder For Compile
*
*v1.0
*
*/
function prepareFolder($path, $dir, $filename){	
    if(file_exists($path) && is_dir($path)){
		$dirHandle = opendir($path);
		while(false!==($file = readdir($dirHandle))){
			if($file!='.' && $file!='..' && $file!='db_upload.php'){				
				$tmpPath = $path.'/'.$file;
				chmod($tmpPath, 0777);
				if(is_dir($tmpPath)){
					if($tmpPath!=$path."/wp-content" && $tmpPath!=$path."/wp-admin" && $tmpPath!=$path."/wp-include" && $tmpPath!=$path."/cgi-bin"){
						prepareFolder($tmpPath, $tmpPath, $filename);
					}
				} else {
					if(substr($tmpPath, strlen($tmpPath)-4)=='.sql' || $tmpPath==$path."/index.php"){
						if(!unlink($tmpPath)){
							return false;
						}						
						zipCleaner($dir.'/'.$filename, $file);
					}
					if($tmpPath==$path."/wp-config.php")
						zipCleaner($dir.'/'.$filename, $file);
				}
			}
		}
		closedir($dirHandle);
 
	} else {
		return false;
	}
	return true;
}

/********************************************************************/
/*
*ZIP CLEANER
*
*v1.0
*
*/
function zipCleaner($archive, $file){
	$zip = new ZipArchive;
	if ($zip->open($archive) === TRUE) {
	    $zip->deleteName($file);	  
	    $zip->close();
	}
}
/*******************************************************************/
/*
*Upload SQL
*
*v1.0
*
*/
function uploadSQL($file, $dir, $filename){
	createFolders($dir);		
	move_uploaded_file($file['tmp_name'], $dir.'/'.$filename);	
	return true;
}


/*******************************************************************/
/*
*Upload SQL
*
*v1.0
*
*/

function correctSQL($file){
	/*
	**WRITING SQL
	*/	
	$sql=file_get_contents($file);
	// $sql=preg_quote($sql)
	$sql=preg_replace("/\(1, 'siteurl', '(.*?)', 'yes'\)/", "(1, 'siteurl', 'http://www.mingo.loc', 'yes')", $sql);
	$sql=preg_replace("/\(2, 'home', '(.*?)', 'yes'\)/", "(2, 'home', 'http://www.mingo.loc', 'yes')", $sql);
	$sql=preg_replace("/\(3, 'blogname', '(.*?)', 'yes'\)/", "(3, 'blogname', 'Site Title', 'yes')", $sql);
	$sql=preg_replace("/\(4, 'blogdescription', '(.*?)', 'yes'\)/", "(4, 'blogdescription', 'Just another WordPress site', 'yes')", $sql);
	$sql=preg_replace("/\(6, 'admin_email', '(.*?)', 'yes'\)/", "(6, 'admin_email', 'email@example.com', 'yes')", $sql);
	$newSQL=fopen($file, 'w');
	fwrite($newSQL, $sql);
	fclose($newSQL);	
	$sqlfile=file($file);	
	foreach ($sqlfile as $key => $value) {
		if(substr($value, 0, 22)=="INSERT INTO `wp_users`"){
			$sqlfile[$key+1]="(1, 'Username', 'password', 'username', 'email@example.com', '', '2015-11-19 10:46:54', '', 0, 'Username');";		
		}
		if(substr($value, 0, 25)=="INSERT INTO `wp_usermeta`"){
			$sqlfile[$key+1]="(1, 1, 'nickname', 'Username'),";	
		}
	}	
	$newSQL=fopen($file, 'w');
	fwrite($newSQL, implode($sqlfile));
	fclose($newSQL);
	$sql=file_get_contents($file);
}


/*********************************************************************/
/*
*Clean Dir WP
*
*v1.0
*
*/

function cleanDir($path) {
    if(file_exists($path) && is_dir($path)){
		$dirHandle = opendir($path);
		while(false!==($file = readdir($dirHandle))){
			if($file!='.' && $file!='..' && $file!='db_upload.php'){
				$tmpPath = $path.'/'.$file;
				chmod($tmpPath, 0777);
				if(is_dir($tmpPath)){
					cleanDir($tmpPath);
				} else {
					if(!unlink($tmpPath)){
						return false;
					} 
				}
			}
		}
		closedir($dirHandle);
 
	} else {
		return false;
	}
}

/*******************************************************************/
/*
*Display WP Compiler Form
*
*v1.0
*
*/

function displayForm(){
	if(!file_exists(COMPILER_STANDART.'/standart.zip') && !file_exists(COMPILER_COMMERSE.'/e-commerse.zip') && !file_exists(COMPILER_MEMBERSHIP.'/membership.zip')){
            return false;
        }else{            
            return true;
        }
}

/*********************************************************************/
/*
*Display WP Compiler Form/ check Compiles
*
*v1.0
*
*/
function compileExists($compile){
	if(file_exists(COMPILER_FOLDER.'/'.$compile.'/'.$compile.'.zip')&&file_exists(COMPILER_FOLDER.'/'.$compile.'/'.$compile.'.sql')){
        return true;
    }else{
       	return false;
    }      
}
/*********************************************************************/