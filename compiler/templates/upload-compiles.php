<?php
require_once(COMPILER_PATH.'core/uploader.php');
?>
<div class="form-control-compile" id="compiler-set-up">
	<div class="compiler-page-title">WP COMPILER SETTING</div>
	<hr>
	<div class="compiles-field">
		<div class="compiles-field-section">
			<form id="standart_config" action="" method="POST" enctype="multipart/form-data">
				<h1>STANDART</h1><hr>
				<div class="archive">
					<label for="standart"><strong>Upload archive .ZIP for Standart compile :</strong></label>	
					<span><input type="file" name="archive_standart" id="standart"></span>
					<button class="button" name="upload_standart" value="upload" type="submit">Upload</button>			
				</div>				
				<div class="dump-sql">
					<label for="standart_sql"><strong>Upload .SQL file for Standart compile :</strong></label>
					<span><input type="file" name="sql_standart" id="standart_sql"></span>
					<button class="button" name="upload_standart_sql" type="submit">Upload</button>
				</div>				
			</form>			
			<hr>
			<?php if($standart){ ?>
				<form action="" method="POST">
					<div class="delete-compile"><h4>Delete Standart Compile  -  </h4><button class="button" value="<?=$standart_dir?>" name="delete" type="submit">Delete</button></div>
				</form>
				<div class="current-compile"><h4>Current version Compile -  </h4><a href="<?=$standart?>">Download Archive</a></div>
			<?php } ?>	
			<?php if($standart_mysql){ ?>
				<form action="" method="POST">
					<div class="delete-compile"><h4>Delete Standart SQL file  -  </h4><button class="button" value="<?=$standart_mysql_dir?>" name="delete" type="submit">Delete</button></div>
				</form>
				<div class="current-compile"><h4>Current version SQL -  </h4><a href="<?=$standart_mysql?>">Download SQL</a></div>
			<?php } ?>	
		</div>
		<div class="compiles-field-section">
			<form id="ecommerse_config" action="" method="POST" enctype="multipart/form-data">
				<h1>E-Commerse</h1><hr>
				<div class="archive">
					<label for="e-commerse"><strong>Upload archive .ZIP for E-Commerse compile :</strong></label>	
					<span><input type="file" name="archive_e-commerse" id="e-commerse"></span>
					<button class="button" name="upload_e-commerse" type="submit">Upload</button>
				</div>
					
				<div class="dump-sql">
					<label for="e-commerse_sql"><strong>Upload .SQL file for E-Commerse compile :</strong></label>
					<span><input type="file" name="sql_e-commerse" id="e-commerse_sql"></span>
					<button class="button" name="upload_e-commerse_sql" type="submit">Upload</button>
				</div>				
			</form>
			<hr>
			<?php if($ecommerse){ ?>
				<form action="" method="POST">
					<div class="delete-compile"><h4>Delete E-Commerse Compile  -  </h4><button class="button" value="<?=$ecommerse_dir?>" name="delete" type="submit">Delete</button></div>
				</form>	
				<div class="current-compile"><h4>Current version Compile -  </h4><a href="<?=$ecommerse?>">Download Archive</a></div>
			<?php } ?>
			<?php if($ecommerse_mysql){ ?>
				<form action="" method="POST">
					<div class="delete-compile"><h4>Delete E-Commerse SQL file  -  </h4><button class="button" value="<?=$ecommerse_mysql_dir?>" name="delete" type="submit">Delete</button></div>
				</form>	
				<div class="current-compile"><h4>Current version SQL -  </h4><a href="<?=$ecommerse_mysql?>">Download SQL</a></div>
			<?php } ?>
		</div>
		<div class="compiles-field-section">
			<form id="membership_config" action="" method="POST" enctype="multipart/form-data">
				<h1>Membership</h1><hr>
				<div class="archive">
					<label for="membership"><strong>Upload archive .ZIP for Membership compile :</strong></label>	
					<span><input type="file" name="archive_membership" id="membership"></span>
					<button class="button" name="upload_membership" type="submit">Upload</button>
				</div>				
				<div class="dump-sql">
					<label for="membership_sql"><strong>Upload .SQL file for Membership compile :</strong></label>
					<span><input type="file" name="sql_membership" id="membership_sql"></span>
					<button class="button" name="upload_membership_sql" type="submit">Upload</button>
				</div>				
			</form>
			<hr>
			<?php if($membership){ ?>
				<form action="" method="POST">					
					<div class="delete-compile"><h4>Delete Membership Compile  -  </h4><button class="button" value="<?=$membership_dir?>" name="delete" type="submit">Delete</button></div>
				</form>
				<div class="current-compile"><h4>Current version Compile -  </h4><a href="<?=$membership?>">Download Archive</a></div>
			<?php } ?>
			<?php if($membership_mysql){ ?>
				<form action="" method="POST">					
					<div class="delete-compile"><h4>Delete Membership SQL file  -  </h4><button class="button" value="<?=$membership_mysql_dir?>" name="delete" type="submit">Delete</button></div>
				</form>
				<div class="current-compile"><h4>Current version SQL -  </h4><a href="<?=$membership_mysql?>">Download SQL</a></div>
			<?php } ?>
		</div>
		<?php 		
		global $response;
		if(is_array($response)){
			echo '<div class="result_upload '.$response['class'].'">'.$response['message'].'<br><small>'.$response['dir'].'</small></div>';
		} ?>
			
	</div>
</div>
