<?php 
/*DB CHECKER*/
load_db_dump();
delete_files_install();
function load_db_dump($file,$sqlserver,$user,$pass,$dest_db){
	$sql=mysql_connect($sqlserver,$user,$pass);	
	$result = mysql_list_tables($dest_db);
	while($table = mysql_fetch_array($result)) {
		$query = "DROP TABLE `".$table[0]."`";		
		mysql_query($query);
	}
	$a=file($file);
	foreach ($a as $n => $l) if (substr($l,0,2)=='--') unset($a[$n]);
	$a=explode(";\n",implode("\n",$a));
	unset($a[count($a)-1]);
	foreach ($a as $q) if ($q)
	if (!mysql_query($q)) {echo "Fail on '$q'"; mysql_close($sql); return false;}
	mysql_close($sql);
	unlink($file);
	return true;
}
function delete_files_install(){
	$index=file_get_contents('index.php');
	$index=str_replace("require(dirname( __FILE__ ) . '/db_upload.php');", "", $index);
	$newindex=@fopen('index.php', 'w');
	@fwrite($newindex, $index);
	@fclose($newindex);
	unlink("db_upload.php");
	unlink("archive.zip");
	unlink("unziper.php");
}
