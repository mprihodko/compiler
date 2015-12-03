<?php
	if(isset($_POST['upload_standart'])){
		if(validateCompile($_FILES['archive_standart'], $_FILES['archive_standart']['type'], COMPILER_STANDART, 'application/zip')==true){
			uploadCompile($_FILES['archive_standart'], COMPILER_STANDART, 'standart.zip');
				$response['message']='Standart compile has been uploaded to';
				$response['class']='success';
				$response['dir']=COMPILER_STANDART;	
		}else{
			$response['message']='Error check your plugin settings';	
			$response['class']='fail';		
		}
	}
	if(isset($_POST['upload_standart_sql'])){
		if(validateCompile($_FILES['sql_standart'], $_FILES['sql_standart']['type'], COMPILER_STANDART, 'application/sql')==true){
			uploadSQL($_FILES['sql_standart'], COMPILER_STANDART, 'standart.sql');
			correctSQL(COMPILER_STANDART.'/standart.sql');
			$response['message']='Standart compile has been uploaded to';
			$response['class']='success';
			$response['dir']=COMPILER_STANDART;	
		}else{
			$response['message']='Error check your plugin settings';	
			$response['class']='fail';		
		}
	}
	if(isset($_POST['upload_e-commerse'])){
		if(validateCompile($_FILES['archive_e-commerse'], $_FILES['archive_e-commerse']['type'], COMPILER_COMMERSE, 'application/zip')==true){
			uploadCompile($_FILES['archive_e-commerse'], COMPILER_COMMERSE, 'e-commerse.zip');
				$response['message']='E-commerse compile has been uploaded to';
				$response['class']='success';
				$response['dir']=COMPILER_COMMERSE;	
		}else{
			$response['message']='Error check your plugin settings';	
			$response['class']='fail';		
		}
	}
	if(isset($_POST['upload_e-commerse_sql'])){
		if(validateCompile($_FILES['sql_e-commerse'], $_FILES['sql_e-commerse']['type'], COMPILER_COMMERSE, 'application/sql')==true){
			uploadSQL($_FILES['sql_e-commerse'], COMPILER_COMMERSE, 'e-commerse.sql');
			correctSQL(COMPILER_COMMERSE.'/e-commerse.sql');
			$response['message']='E-commerse compile has been uploaded to';
			$response['class']='success';
			$response['dir']=COMPILER_COMMERSE;	
		}else{
			$response['message']='Error check your plugin settings';	
			$response['class']='fail';		
		}
	}
	if(isset($_POST['upload_membership'])){
		if(validateCompile($_FILES['archive_membership'], $_FILES['archive_membership']['type'], COMPILER_MEMBERSHIP, 'application/zip')==true){
			uploadCompile($_FILES['archive_membership'], COMPILER_MEMBERSHIP, 'membership.zip');
				$response['message']='Membership compile has been uploaded to';
				$response['class']='success';
				$response['dir']=COMPILER_MEMBERSHIP;	
		}else{
			$response['message']='Error check your plugin settings';	
			$response['class']='fail';		
		}
	}
	if(isset($_POST['upload_membership_sql'])){
		if(validateCompile($_FILES['sql_membership'], $_FILES['sql_membership']['type'], COMPILER_MEMBERSHIP, 'application/sql')==true){
			uploadSQL($_FILES['sql_membership'], COMPILER_MEMBERSHIP, 'membership.sql');
			correctSQL(COMPILER_MEMBERSHIP.'/membership.sql');
			$response['message']='Membership compile has been uploaded to';
			$response['class']='success';
			$response['dir']=COMPILER_MEMBERSHIP;	
		}else{
			$response['message']='Error check your plugin settings';	
			$response['class']='fail';		
		}
	}
	
	if(isset($_POST['post_max_size']) && isset($_POST['upload_max_filesize'])){
		$settings['post_max_size']=trim(strip_tags($_POST['post_max_size']));
		$settings['upload_max_filesize']=trim(strip_tags($_POST['upload_max_filesize']));		
		$data = serialize($settings);
		if ( get_option( '_compiler_max_size' ) != $data ) {
			update_option( '_compiler_max_size', $data);
		} else {
			add_option( '_compiler_max_size', $data, '', 'yes');
		}
		$response['message']='Saved';
		$response['class']='success';
		$set_ini='upload_max_filesize = "'.$settings['upload_max_filesize'].'M"
					post_max_size = "'.$settings['post_max_size'].'M"';
		$ini_file=@fopen($_SERVER['DOCUMENT_ROOT'].'/wp-admin/php.ini', 'w');
		@fwrite($ini_file, $set_ini);
		@fclose($ini_file);
		
	}
	if(isset($_POST['delete'])){		
		$path=trim(strip_tags($_POST['delete']));				
		if(substr($path, strlen($path)-4)=='.zip'){
			if(file_exists($path))			
				unlink($path);
		}
		if(substr($path, strlen($path)-4)=='.sql'){
			if(file_exists($path))			
				unlink($path);
		}
	}
		

?>