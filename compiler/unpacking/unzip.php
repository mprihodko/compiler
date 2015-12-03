<?php 
	$zip = new ZipArchive;
    if($zip->open('archive.zip')==TRUE){
	    $zip->extractTo('./');
	    $zip->close();
	    echo "ok";	    
	}
    
?>