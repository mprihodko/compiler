<?php
/*
* Compile WP 1.0
* ajax_handler
* version: 1.0
*/

/*
*Validate form data
*
*v1.0
*
*/
add_action('wp_ajax_validate_servers', 'validate_servers');
add_action('wp_ajax_nopriv_validate_servers', 'validate_servers');
function validate_servers(){
	/****************************************************************************************************************/
	if(isset($_POST["server_data"]["step"]) && $_POST["server_data"]["step"]==1 || isset($_POST['testing_connect'])){
	/****************************************************************************************************************/		
		$ftp_hostname 	=strip_tags(trim($_POST["server_data"]["ftp_hostname"]));
		$ftp_username	=strip_tags(trim($_POST["server_data"]["ftp_username"]));
		$ftp_password	=strip_tags(trim($_POST["server_data"]["ftp_password"]));
		$mysql_host		=strip_tags(trim($_POST["server_data"]["mysql_host"]));
		$mysql_database =strip_tags(trim($_POST["server_data"]["mysql_database"]));
		$mysql_username =strip_tags(trim($_POST["server_data"]["mysql_username"]));
		$mysql_password =strip_tags(trim($_POST["server_data"]["mysql_password"]));
		
		/*
		* Try FTP && DB connect
		*/		
		$ftp_connect = @ftp_connect($ftp_hostname);
		if($mysql_host=="localhost" || $mysql_host=="localhost:3306" || $mysql_host=="127.0.0.1" || $mysql_host=="127.0.0.1:3306"){
			$response["db"]=false;	
		    $response["db_message"]="WARNING : You have entered local settings for database server";
		}else{

			$db_connect = @mysql_connect($mysql_host,  $mysql_username, $mysql_password);					
			if(!$db_connect){
				$response["db"]="wrong";	
		    	$response["db_message"]="Incorrect database connection";
			}else{
				$response["db"]=true;	
		    	$response["db_message"]="Database connection established";
		    	mysql_close($db_connect);
			}
		}
		/* END */

		/*
		* Try FTP Login
		*/
	  	if($ftp_connect==false){		  		
	    	$response["ftp"]=false;	
	    	$response["ftp_message"]="Incorrect FTP address server";
	  	}else{
	  		$ftp_login = @ftp_login($ftp_connect, $ftp_username, $ftp_password);		  		
	  		if($ftp_login==false){
	  			$response["ftp"]=false;	
	  			$response["ftp_login"]=false;	
	  			$response["ftp_message"]="Incorrect FTP username or password";	   			
	  		}else{
	  			$response["ftp_login"]=true;
	    		$response["ftp"]=true;	
	    		$response["ftp_message"]="FTP connection established";	    		
	    		ftp_close($ftp_connect);
	    	}
	  	}
	  	/* END */
	  	
	  	if(isset($_POST['testing_connect']) && $_POST['testing_connect']=="test"){
		  	/*
		  	* Testing response
		  	*/		  	
	  		echo json_encode($response);
	  		wp_die();
	  		/* END */	
		}else{
			$url=trim(strip_tags($_POST["server_data"]["site_url"]));
			/*
			*check_url
			*/
			if(checkurl($url)!=-1 && checkurl($url)!=1)
				$first_tab_data['site_url']=strtolower(checkurl($url));
			else
				$first_tab_data['site_url']=false;
			/*
			*check_type
			*/
			if(trim(strip_tags($_POST["server_data"]["type"])))
				$first_tab_data['type']=trim(strip_tags($_POST["server_data"]["type"]));	
			else
				$first_tab_data['type']=false;
			/* END */

			/*
			*check_ftp
			*/
			if($response["ftp"]==true){
				$first_tab_data["ftp_hostname"]=$ftp_hostname;
				$first_tab_data["ftp"]="ok";
			}else{
				$first_tab_data["ftp_hostname"]=true;
				$first_tab_data["ftp"]="WARNING : We could not establish a connection with your FTP server";
			}
			$first_tab_data['ftp_host']=$ftp_hostname;
			/* END */

			/*
			*check_ftp_login
			*/
			if($response["ftp_login"]==true){
				$first_tab_data['ftp_username']=$ftp_username;
				$first_tab_data['ftp_password']=$ftp_password;
				$first_tab_data["ftp"]="ok";
			}else{
				if(!$ftp_username){
					$first_tab_data['ftp_username']=false;
				}else{
					$first_tab_data["ftp"]="WARNING : We could not establish a connection with your FTP server! Please check your login or password";
					$first_tab_data['ftp_username']=$ftp_username;					
				}
				if(!$ftp_password){
					$first_tab_data['ftp_password']=false;
				}else{
					$first_tab_data['ftp_username']=$ftp_password;
					$first_tab_data["ftp"]="WARNING : We could not establish a connection with your FTP server! Please check your login or password";
				}
			}
			/* END */

			/*
			*check_db
			*/
			
			if($response["db"]!="wrong" && $response["db"]!=false || $response["db"]==1){
				$first_tab_data['mysql_host']=$mysql_host;
				$first_tab_data['mysql_database']=$mysql_database;
				$first_tab_data['mysql_username']=$mysql_username;
				$first_tab_data['mysql_password']=$mysql_password;
				$first_tab_data['db_connect']="ok";
			}else{
				if(!$mysql_host)
					$first_tab_data['mysql_host']=false;
				else
					$first_tab_data['mysql_host']=$mysql_host;
				if(!$mysql_database)
					$first_tab_data['mysql_database']=false;
				else
					$first_tab_data['mysql_database']=$mysql_database;
				
				if(!$mysql_username)
					$first_tab_data['mysql_username']=false;
				else
					$first_tab_data['mysql_username']=$mysql_username;
				if(!$mysql_password)
					$first_tab_data['mysql_password']=false;
				else
					$first_tab_data['mysql_password']=$mysql_password;
				if($response["db"]==false){
					$first_tab_data["db_connect"]="WARNING : You have entered local settings for database server";
				}
				if($response["db"]=="wrong"){
					$first_tab_data["db_connect"]="WARNING:Incorrect database connection! Please check your entered data or check access from your host";
				}
			}	
			/* END */
			$_SESSION['first_tab_data']=$first_tab_data;
			echo json_encode($_SESSION['first_tab_data']);
		}
	/**********************************************************************************/
	}elseif(isset($_POST["server_data"]["step"]) && $_POST["server_data"]["step"]==2){
	/**********************************************************************************/
		/*
		*Check site_name
		*/
		if(strip_tags(trim($_POST["server_data"]["site_name"])))
			$two_tab_data['site_name']			=strip_tags(trim($_POST["server_data"]["site_name"]));
		else
			$two_tab_data['site_name']			=false;
		/* END */

		/*
		*Check site_tagline
		*/
		if(strip_tags(trim($_POST["server_data"]["site_tagline"])))
			$two_tab_data['site_tagline']		=strip_tags(trim($_POST["server_data"]["site_tagline"]));
		else
			$two_tab_data['site_tagline']		=true;

		$email=strip_tags(trim($_POST["server_data"]["site_tagline"]));
		/* END */

		/*
		*Check site_email
		*/
		if(check_email($email))
			$two_tab_data['site_email']			=strip_tags(trim($_POST["server_data"]["site_email"]));
		else
			$two_tab_data['site_email']			=false;
		/* END */

		/*
		*Check site_meta_desc
		*/
		if(strip_tags(trim($_POST["server_data"]["site_meta_desc"])))	
			$two_tab_data['site_meta_desc']		=strip_tags(trim($_POST["server_data"]["site_meta_desc"]));
		else
			$two_tab_data['site_meta_desc']		=true;
		/* END */

		/*
		*Check admin_name
		*/
		if(strip_tags(trim($_POST["server_data"]["admin_name"])))
			$two_tab_data['admin_name']			=strip_tags(trim($_POST["server_data"]["admin_name"]));
		else
			$two_tab_data['admin_name']			=false;
		/* END */

		/*
		*Check admin_password
		*/
		if(strip_tags(trim($_POST["server_data"]["admin_password"])))
			$two_tab_data['admin_password']		=strip_tags(trim($_POST["server_data"]["admin_password"]));
		else
			$two_tab_data['admin_password']		=false;
		/* END */

		/*
		*Check admin_nickname
		*/
		if(strip_tags(trim($_POST["server_data"]["admin_nickname"])))
			$two_tab_data['admin_nickname']		=strip_tags(trim($_POST["server_data"]["admin_nickname"]));
		else
			$two_tab_data['admin_nickname']		=false;
		/* END */
		$_SESSION['two_tab_data']=$two_tab_data;
		echo json_encode($two_tab_data);
	/**********************************************************************************/
	}elseif(isset($_POST["server_data"]["step"]) && $_POST["server_data"]["step"]==3){
	/**********************************************************************************/
		/*
		*Check Facebook
		*/
		if(strip_tags(trim($_POST["server_data"]["facebook"]))){
			$url=strip_tags(trim($_POST["server_data"]["facebook"]));
			if(checkurl($url)!=-1 && checkurl($url)!=1)
				$three_tab_data['facebook']=$_POST["server_data"]["facebook"];
			else
				$three_tab_data['facebook']=false;
		}else{
			$three_tab_data['facebook']="empty";
		}
		/* END */

		/*
		*Check Twitter
		*/
		if(strip_tags(trim($_POST["server_data"]["twitter"]))){
			$url=strip_tags(trim($_POST["server_data"]["twitter"]));
			if(checkurl($url)!=-1 && checkurl($url)!=1)
				$three_tab_data['twitter']=$_POST["server_data"]["twitter"];
			else
				$three_tab_data['twitter']=false;
		}else{
			$three_tab_data['twitter']="empty";
		}
		/* END */

		/*
		*Check Linkedin
		*/	
		if(strip_tags(trim($_POST["server_data"]["linkedin"]))){
			$url=strip_tags(trim($_POST["server_data"]["linkedin"]));
			if(checkurl($url)!=-1 && checkurl($url)!=1)
				$three_tab_data['linkedin']=$_POST["server_data"]["linkedin"];
			else
				$three_tab_data['linkedin']=false;
		}else{
			$three_tab_data['linkedin']="empty";
		}
		/* END */

		/*
		*Check Google
		*/	
		if(strip_tags(trim($_POST["server_data"]["google"]))){
			$url= strip_tags(trim($_POST["server_data"]["google"]));
			if(checkurl($url)!=-1 && checkurl($url)!=1)
				$three_tab_data['google']=$_POST["server_data"]["google"];
			else
				$three_tab_data['google']=false;
		}else{
			$three_tab_data['google']="empty";
		}
		/* END */

		/*
		*Check Youtube
		*/	
		if(strip_tags(trim($_POST["server_data"]["youtube"]))){
			$url=strip_tags(trim($_POST["server_data"]["youtube"]));
			if(checkurl($url)!=-1 && checkurl($url)!=1)
				$three_tab_data['youtube']=$_POST["server_data"]["youtube"];
			else
				$three_tab_data['youtube']=false;
		}else{
			$three_tab_data['youtube']="empty";
		}
		/* END */
		$_SESSION['three_tab_data']=$three_tab_data;
		echo json_encode($three_tab_data);
	/**********************************************************************************/
	}elseif(isset($_POST["server_data"]["step"]) && $_POST["server_data"]["step"]==4){
	/**********************************************************************************/
		/*
		*Check phone
		*/
		if(strip_tags(trim($_POST["server_data"]["company_name"])))	
			$four_tab_data['company_name']	=	strip_tags(trim($_POST["server_data"]["company_name"]));
		else
			$four_tab_data['company_name']	=	"empty";
		/* END */

		/*
		*Check phone
		*/
		if(strip_tags(trim($_POST["server_data"]["street"])))		
			$four_tab_data['street']		=	strip_tags(trim($_POST["server_data"]["street"]));
		else
			$four_tab_data['street']		=	"empty";
		/* END */

		/*
		*Check phone
		*/
		if(strip_tags(trim($_POST["server_data"]["city"])))			
			$four_tab_data['city']			=	strip_tags(trim($_POST["server_data"]["city"]));
		else
			$four_tab_data['city']			=	"empty";
   		/* END */

   		/*
		*Check phone
		*/	
		if(strip_tags(trim($_POST["server_data"]["state"])))		
			$four_tab_data['state']			=	strip_tags(trim($_POST["server_data"]["state"]));
		else
			$four_tab_data['state']			=	"empty";
		/* END */

		/*
		*Check phone
		*/	
		if(strip_tags(trim($_POST["server_data"]["zip"])))		
			$four_tab_data['zip']			=	strip_tags(trim($_POST["server_data"]["zip"]));
		else
			$four_tab_data['zip']			=	"empty";
		/* END */

		/*
		*Check phone
		*/	
		if(strip_tags(trim($_POST["server_data"]["phone"]))) {
			if(preg_match("/^[0-9]+$/", strip_tags(trim($_POST["server_data"]["phone"]))))
  				$four_tab_data['phone']		=strip_tags(trim($_POST["server_data"]["phone"]));
  			else
  				$four_tab_data['phone']		=false;	
		}else{
			$four_tab_data['phone']			="empty";
		}
		/* END */
		$_SESSION['compile_data']['four_tab_data']=$four_tab_data;
		$_SESSION['compile_data']['three_tab_data']=$_SESSION['three_tab_data'];
		$_SESSION['compile_data']['two_tab_data']=$_SESSION['two_tab_data'];
		$_SESSION['compile_data']['first_tab_data']=$_SESSION['first_tab_data'];
		// unset($_SESSION['three_tab_data'], $_SESSION['two_tab_data'], $_SESSION['first_tab_data']);
		echo json_encode($_SESSION);		
	}
		
	
	wp_die();
}
/***********************************************************************/

/*
*Validate URL
*
*v1.0
*
*/
function checkurl($url) {  
   if (strlen($url)==0) return 1;
   if (!preg_match("~^(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".  
   "(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|".  
   "org|mil|edu|arpa|gov|biz|info|aero|loc|inc|name|[a-z]{2})|(?!0)(?:(?".  
   "!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&".  
   "?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i",$url,$ok)) return -1;
   if (!strstr($url,"://")) $url="http://".$url;
   $url=preg_replace("~^[a-z]+~ie","strtolower('\\0')",$url);  
   return $url;  
}
/***********************************************************************/

/*
*Validate email
*
*v1.0
*
*/
function check_email($email) {
	if (!eregi("^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$", $email)) return $email;
    else return false;	
}
/***********************************************************************/

/*
*getMyCompile
*
*v1.0
*
*/
add_action('wp_ajax_getMyCompile', 'getMyCompile');
add_action('wp_ajax_nopriv_getMyCompile', 'getMyCompile');
function getMyCompile(){	
	if(isset($_POST['confirm']) && $_POST['confirm']==true && $_SESSION['compile_data']){		
		createArchive($_SESSION['compile_data'], $_POST['ftpLoad'], $_POST['ftpFolder']);	
			
	}
	die;
}


add_action('wp_ajax_unzipFTP', 'unzipFTP');
add_action('wp_ajax_nopriv_unzipFTP', 'unzipFTP');
function unzipFTP(){
	if(isset($_POST['dump'])&& isset($_POST['unzip'])){
		$ch = curl_init($_POST['unzip']);
		$resp=curl_exec($ch); 
		curl_close($ch);
		if($resp=='ok'){
			$ch = curl_init($_POST['dump']);
			$resp=curl_exec($ch); 
			curl_close($ch);
		}
	}
	die();
}

add_action('wp_ajax_confirmFTP', 'confirmFTP');
add_action('wp_ajax_nopriv_confirmFTP', 'confirmFTP');
function confirmFTP(){
	if(isset($_POST['confirmFTP'])){
		$ftp_hostname=$_SESSION['first_tab_data']["ftp_host"];
		$ftp_username=$_SESSION['first_tab_data']['ftp_username'];
		$ftp_password=$_SESSION['first_tab_data']['ftp_password'];
		$ftp_connect = @ftp_connect($ftp_hostname);
		$ftp_login = @ftp_login($ftp_connect, $ftp_username, $ftp_password);		  		
	  		if($ftp_login==false){
	  			$response["ftp"]="fail";	  				  				   			
	  		}else{	  			
	    		$response["ftp"]="ok";		    			    		
	    		ftp_close($ftp_connect);
	    	}	    	
	    echo json_encode($response["ftp"]);	    
	}
	wp_die();
}
?>