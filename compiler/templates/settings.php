<?php
require_once(COMPILER_PATH.'core/uploader.php');
$option = get_option( '_compiler_max_size' );
$data=unserialize($option);

?>
<div class="form-control-compile">
	<div class="compiler-page-title">WP COMPILER FILE SETTING</div>
	<hr>
	<div class="compiles-field">
		<div class="compiles-field-section">
			<form id="ftp_config" action="" method="POST">
				<h1>FILE SETTINGS</h1><hr>
				<div class="archive">
					<label for="post_max_size">
						<strong>Enter Post Max Size: <b style="color: red;">*</b></strong><br>
						<small style="font-style:italic;">Enter just numbers without "M"</small>
					</label>	
					<span><input type="text" name="post_max_size" id="post_max_size" value="<?php echo (($data['post_max_size'])? $data['post_max_size'] : '') ?>" required></span>
					<label for="upload_max_filesize">
						<strong>Enter Upload Max Filesize: <b style="color: red;">*</b></strong><br>
						<small style="font-style:italic;">Enter just numbers without "M"</small>
					</label>	
					<span><input type="text" name="upload_max_filesize" id="upload_max_filesize" value="<?php echo (($data['upload_max_filesize'])? $data['upload_max_filesize'] : '') ?>" required></span>
					<button class="button" name="save" type="submit">Save</button>
				</div>				
			</form>			
			<hr>
			<?php 		
		global $response;
		if(is_array($response)){
			echo '<div class="result_upload '.$response['class'].'">'.$response['message'].'<br><small>'.$response['dir'].'</small></div>';
		} ?>			
		</div>

	</div>
</div>