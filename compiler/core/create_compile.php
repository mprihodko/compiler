<?php 
/*
* Compile WP 1.0
* Create Compile File
* version: 1.0
*/

/*
*Create Archive 
*
*v1.0
*
*/
function createArchive($entered_data, $ftpLoad=null, $ftpFolder=null){
	$connect_data	=	$entered_data['first_tab_data'];
	$site_data		=	$entered_data['two_tab_data'];
	$social_data	=	$entered_data['three_tab_data'];
	$contact_data	=	$entered_data['four_tab_data'];
	// unset($_SESSION['compile_data']);	
	$main_path=COMPILER_FOLDER.$connect_data['type'];
	$configTemplate=file_get_contents($main_path.'/wp/wp-config.php');
	$configTemplate=str_replace("define('DB_NAME', 'db_name');", "define('DB_NAME', '".$connect_data['mysql_database']."');", $configTemplate);
	$configTemplate=str_replace("define('DB_USER', 'root');", "define('DB_USER', '".$connect_data['mysql_username']."');", $configTemplate);
	$configTemplate=str_replace("define('DB_PASSWORD', '123456');", "define('DB_PASSWORD', '".$connect_data['mysql_password']."');", $configTemplate);
	$configTemplate=str_replace("define('DB_HOST', 'localhost');", "define('DB_HOST', '".$connect_data['mysql_host']."');", $configTemplate);
	/*
	**WRITING WP-CONFIG.PHP
	*/
	@mkdir($main_path."/".session_id(), 0770);
	$configFile = @fopen($main_path."/".session_id().'/wp-config.php', 'w');
	@fwrite($configFile, $configTemplate);
	@fclose($configFile);
	/*
	**WRITING SQL
	*/	
	$sql=@file_get_contents(COMPILER_FOLDER.$connect_data['type'].'/'.$connect_data['type'].'.sql');
	$sql=str_replace("(1, 'siteurl', 'http://www.mingo.loc', 'yes'),", "(1, 'siteurl', '".$connect_data['site_url']."', 'yes'),", $sql);
	$sql=str_replace("(2, 'home', 'http://www.mingo.loc', 'yes'),", "(2, 'home', '".$connect_data['site_url']."', 'yes'),", $sql);
	$sql=str_replace("(3, 'blogname', 'Site Title', 'yes'),", "(3, 'blogname', '".$site_data['site_name']."', 'yes'),", $sql);
	$sql=str_replace("(4, 'blogdescription', 'Just another WordPress site', 'yes'),", "(4, 'blogdescription', '".$site_data['site_tagline']."', 'yes'),", $sql);
	$sql=str_replace("(6, 'admin_email', 'email@example.com', 'yes'),", "(6, 'admin_email', '".$site_data['site_email']."', 'yes'),", $sql);
	$sql=str_replace("(1, 'Username', 'password', 'username', 'email@example.com', '', '2015-11-19 10:46:54', '', 0, 'Username');", "(1, '".$site_data['admin_name']."', '".wp_hash_password($site_data['admin_password'])."', '".$site_data['admin_nickname']."', '".$site_data['site_email']."', '', '".date("Y-m-d H:i:s")."', '', 0, '".$site_data['admin_name']."');", $sql);
	$sql=str_replace("(1, 1, 'nickname', 'Username'),", "(1, 1, 'nickname', '".$site_data['admin_nickname']."'),", $sql);
	$newSQL=@fopen($main_path."/".session_id().'/'.$connect_data['type'].'.sql', 'w');
	@fwrite($newSQL, $sql);
	@fclose($newSQL);
	/*
	**WRITING DB EXPORTER
	*/
	$exportFile=@file_get_contents($main_path.'/wp/db_upload.php');
	$exportFile=str_replace("load_db_dump();", "load_db_dump('".$connect_data['type'].".sql','".$connect_data['mysql_host']."','".$connect_data['mysql_username']."','".$connect_data['mysql_password']."','".$connect_data['mysql_database']."');", $exportFile);
	$newExportFile=@fopen($main_path."/".session_id().'/db_upload.php', 'w');
	@fwrite($newExportFile, $exportFile);
	@fclose($newExportFile);
	/*
	**WRITING SOCIAL MEDIA XML
	*/
	$social_media=@fopen($main_path."/".session_id().'/social_media.xml', 'w');
	$social_media_content="<facebook>".(($social_data['facebook']!="empty")? $social_data['facebook'] : 'none')."</facebook>";
	$social_media_content.="<twitter>".(($social_data['twitter']!="empty")? $social_data['twitter'] : 'none')."</twitter>";
	$social_media_content.="<linkedin>".(($social_data['linkedin']!="empty")? $social_data['linkedin'] : 'none')."</linkedin>";
	$social_media_content.="<google>".(($social_data['google']!="empty")? $social_data['google'] : 'none')."</google>";
	$social_media_content.="<youtube>".(($social_data['youtube']!="empty")? $social_data['youtube'] : 'none')."</youtube>";
	@fwrite($social_media, $social_media_content);
	@fclose($social_media);
	/*
	**WRITING CONTACT DATA XML
	*/
	$contact_info=@fopen($main_path."/".session_id().'/contact_info.xml', 'w');
	$contact_info_content='<company>'.(($contact_data['company_name']!="empty")? $contact_data['company_name'] : "none").'</company>';
	$contact_info_content.='<address>'.(($contact_data['street']!="empty")? $contact_data['street'] : "none").'</address>';
	$contact_info_content.='<city>'.(($contact_data['city']!="empty")? $contact_data['city'] : "none").'</city>';
	$contact_info_content.='<state>'.(($contact_data['state']!="empty")? $contact_data['state'] : "none").'</state>';
	$contact_info_content.='<zip>'.(($contact_data['zip']!="empty")? $contact_data['zip'] : "none").'</zip>';
	$contact_info_content.='<phone>'.(($contact_data['phone']!="empty")? $contact_data['phone'] : "none").'</phone>';
	@fwrite($contact_info, $contact_info_content);
	@fclose($contact_info);
	/*
	**STANDART Package ZIP CREATION
	*/
	if($connect_data['type']=="standart"){
		dircpy(
					COMPILER_STANDART."/".$connect_data['type'].".zip",
					COMPILER_STANDART."/".$connect_data['type']."-".session_id().".zip");
		zipArchivation(
					COMPILER_STANDART."/".$connect_data['type']."-".session_id().".zip",
					COMPILER_STANDART.'/'.session_id().'/wp-config.php',
					COMPILER_STANDART.'/'.session_id().'/'.$connect_data['type'].'.sql',
					COMPILER_STANDART.'/'.session_id().'/db_upload.php',
					COMPILER_STANDART.'/'.session_id().'/social_media.xml',
					COMPILER_STANDART.'/'.session_id().'/contact_info.xml',
					$connect_data['type'],
					$ftpLoad,
					$ftpFolder,
					$connect_data,
					COMPILER_STANDART.'/wp/index.php');
	/*
	**E-COMMERSE Package ZIP CREATION
	*/
	}elseif($connect_data['type']=="e-commerse"){
		dircpy(
					COMPILER_COMMERSE."/".$connect_data['type'].".zip",
					COMPILER_COMMERSE."/".$connect_data['type']."-".session_id().".zip");
		zipArchivation(
					COMPILER_COMMERSE."/".$connect_data['type']."-".session_id().".zip",
				 	COMPILER_COMMERSE.'/'.session_id().'/wp-config.php',
				 	COMPILER_COMMERSE.'/'.session_id().'/'.$connect_data['type'].'.sql',
				 	COMPILER_COMMERSE.'/'.session_id().'/db_upload.php',
				 	COMPILER_COMMERSE.'/'.session_id().'/social_media.xml',
				 	COMPILER_COMMERSE.'/'.session_id().'/contact_info.xml',
		 			$connect_data['type'],
		 			$ftpLoad,
		 			$ftpFolder,
		 			$connect_data,
					COMPILER_COMMERSE.'/wp/index.php');
	/*
	**MEMBERSHIP Package ZIP CREATION
	*/
	}elseif($connect_data['type']=="membership"){
		dircpy(
					COMPILER_MEMBERSHIP."/".$connect_data['type'].".zip",
					COMPILER_MEMBERSHIP."/".$connect_data['type']."-".session_id().".zip");
		zipArchivation(
					COMPILER_MEMBERSHIP."/".$connect_data['type']."-".session_id().".zip",
					COMPILER_MEMBERSHIP.'/'.session_id().'/wp-config.php',
					COMPILER_MEMBERSHIP.'/'.session_id().'/'.$connect_data['type'].'.sql',
					COMPILER_MEMBERSHIP.'/'.session_id().'/db_upload.php',
					COMPILER_MEMBERSHIP.'/'.session_id().'/social_media.xml',
					COMPILER_MEMBERSHIP.'/'.session_id().'/contact_info.xml',
					$connect_data['type'],
					$ftpLoad,
					$ftpFolder,
					$connect_data,
					COMPILER_MEMBERSHIP.'/wp/index.php');
	}
	/*remooving template directory*/
	RemoveDir($main_path.'/'.session_id());
	
}


/*
*Copy Origin Archive 
*
*v1.0
*
*/
function dircpy($file, $newfile){
	if (!copy($file, $newfile)) {
	   return false;
	}
}


/*
*Insert Generate files to Archive 
*
*v1.0
*
*/
function zipArchivation($archive, $configFile, $sqlDump, $db_upoader, $social, $contact, $name, $ftpLoad, $ftpFolder, $connect_data, $index){
	$zip = new ZipArchive;
	if ($zip->open($archive) === TRUE) {
	    $zip->addFile($configFile, "wp-config.php");
	    $zip->addFile($sqlDump, $name.".sql");
	    $zip->addFile($db_upoader, "db_upload.php");
	    $zip->addFile($social, "social_media.xml");
	    $zip->addFile($contact, "contact_info.xml");
	    $zip->addFile($index, "index.php");
	    $zip->close($archive);
	    $upload_dir = wp_upload_dir();
	    $current_file_dir=$upload_dir['basedir']."/compiles/".$name."/".$name."-".session_id().".zip";
	    $current_file_uri=$upload_dir['baseurl']."/compiles/".$name."/".$name."-".session_id().".zip";
	    if($ftpLoad!="load")
	    	echo $current_file_uri;
	    else{
	    	if(!ftp_uploading_compile($ftpFolder, $connect_data, $current_file_uri,  $current_file_dir))
	    		echo "We couldn't establish connect with your server";  
	    	
	    }
	} else {
	    return false; 
	}
}


/*
*Remove Temp dir
*
*v1.0
*
*/
function RemoveDir($path){
	if(file_exists($path) && is_dir($path)){
		$dirHandle = opendir($path);
		while(false!==($file = readdir($dirHandle))){
			if($file!='.' && $file!='..'){
				$tmpPath = $path.'/'.$file;
				chmod($tmpPath, 0777);
				if(is_dir($tmpPath)){
					RemoveDir($tmpPath);
				} else {
					if(!unlink($tmpPath)){
						return false;
					} 
				}
			}
		}
		closedir($dirHandle);

		if(!rmdir($path)){
			return false;
		} 
 
	} else {
		return false;
	}
}


/*
*Upload to FTP 
*
*v1.0
*
*/
function ftp_uploading_compile($ftpFolder, $connect_data, $current_file_uri,  $current_file_dir){
	$ftp_connect = @ftp_connect($connect_data['ftp_hostname']);
	$ftp_login = @ftp_login($ftp_connect, $connect_data['ftp_username'], $connect_data['ftp_password']);
	if(!$ftp_login){
		return false;
	}else{
		if(substr($ftpFolder, strlen($ftpFolder)-1)!="/")
			$d = ftp_nb_put($ftp_connect, $ftpFolder.'/archive.zip', $current_file_dir, FTP_BINARY);
		else
			$d = ftp_nb_put($ftp_connect, $ftpFolder.'archive.zip', $current_file_dir, FTP_BINARY);
		while ($d == FTP_MOREDATA){
		 
		  $d = ftp_nb_continue($ftp_connect);
		}

		if ($d != FTP_FINISHED){		  
		  exit(1);
		}
		if(substr($ftpFolder, strlen($ftpFolder)-1)!="/")
			$d = ftp_nb_put($ftp_connect, $ftpFolder.'/unziper.php', COMPILER_FOLDER.'unzip.php', FTP_BINARY);
		else
			$d = ftp_nb_put($ftp_connect, $ftpFolder.'unziper.php', COMPILER_FOLDER.'unzip.php', FTP_BINARY);
		while ($d == FTP_MOREDATA){
		 
		  $d = ftp_nb_continue($ftp_connect);
		}

		if ($d != FTP_FINISHED){		  
		  exit(1);
		}
		if(substr($connect_data['site_url'], strlen($connect_data['site_url'])-1)!="/"){
			$host['unzip']  = $connect_data['site_url'].'/unziper.php'; 
			$host['dump'] 	= $connect_data['site_url'].'/db_upload.php';
		}else{
			$host['unzip']  = $connect_data['site_url'].'unziper.php'; 
			$host['dump'] 	= $connect_data['site_url'].'db_upload.php';
		}
		$host['link'] 	= $connect_data['site_url'];
	// close connection
	ftp_close($ftp_connect);
	echo json_encode($host);
		return true;
	}

}
?>