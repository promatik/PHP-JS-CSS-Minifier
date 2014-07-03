<?php
	include_once('minifier.php');
	$error_min = '';

	// JS Files
	if (isset($_POST['uploadJS']))
	{
		$error_min = uploadFiles('JSfiles');
	}

	// CSS Files
	else if(isset($_POST['uploadCSS']))
	{
		$error_min = uploadFiles('CSSfiles');
	}

	// Minify Files
	function uploadFiles($type)
	{		
		$error = '';
		$files = array();
		$file_name = $_FILES[$type]['name'];
		$tmp_file_name = $_FILES[$type]['tmp_name'];
		$file_error = $_FILES[$type]['error'];
		// $file_size = $_FILES[$type]['size'];
		// $file_type = $_FILES[$type]['type'];
		
		if($type == 'JSfiles')
		{
			$path = 'upload/js/';
			$path_min = 'upload/js/min/';
			$extentions = array('.js');
			$extension_min = '.min.js';
		}
		else if($type == 'CSSfiles')
		{
			$path = 'upload/css/';
			$path_min = 'upload/css/min/';
			$extentions = array('.css');
			$extension_min = '.min.css';
		}

		for ($i=0; $i < count($file_name); $i++)
		{
			$error = nofile($tmp_file_name[$i]);  // no file test
			if(!$error) $error .= fileError($file_error[$i]); // error on upload test
			if(!$error) $error .= goodExtension($file_name[$i], $extentions); // error on extension test
			// if(!$error) $error .= fileSize($file_size));
			// if(!$error) $error .= fileType($file_type));

			// if there are no errors
			if($error === '')
			{
				$explode = explode('.', $file_name[$i]);
				// get the name without extension
				$name_no_ext = '';
				for ($j=0; $j < count($explode)-1; $j++) { 
					if($j == (count($explode)-2)) $name_no_ext .= $explode[$j];
					else $name_no_ext .= $explode[$j].'.';
				}

				moveFile($tmp_file_name[$i], $path.$file_name[$i]);
				// add the file to the array files
				$files[$file_name[$i]] = $path_min.$name_no_ext.$extension_min;
			}
		}
		 // if no error, minify the files (see minifier.php)
		if($error === '')
		{
			if($type == 'JSfiles') $confirm = minifyJS($files);
			else if($type == 'CSSfiles') $confirm = minifyCSS($files);
			return $confirm;
		}
		else return $error;
	}

	// Test if there is a file
	function nofile($value){
		if($value === '') return 'No file selected<br />';
		else return false;	
	}

	// Test if there is an error
	function fileError($value){
		if($value > 0) return 'Error during upload<br />';
		else return false;
	}

	// Test extension file
	function goodExtension($file, $extentions){
		$extension = strrchr($file,'.');
		if(!in_array($extension, $extentions)) return 'Bad file extension<br />';
		else return false;
	}

	// Test file size
	/*function fileSize($size){
		if($size > 20000) return 'File is too big<br />';
		else return false;
	}

	// Test file type
	function fileType($type){
		if($type != '') return 'The type of your file is incorrect<br />';
		else return false;
	}*/

	// Move file
	function moveFile($tmp_path, $filename)
	{
		move_uploaded_file($tmp_path, $filename);
		chmod($filename, 0755);
	}

?>
<!doctype html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Upload</title>
		<link rel='stylesheet' href='css/design.min.css' />
		<link href='css/bootstrap.min.css' rel='stylesheet' media='screen'>
	</head>
	<body>
		<div id='upload'>
			<div id='form' class='panel panel-primary'>
				<div class='panel-heading'>
					<h1 class='panel-title'>Minify your files</h1>
				</div>											
				<div class='panel-body' id='suivi_cave'>
					<div id='notifications' class='tabbable'>
						<ul class='nav nav-pills'>
							<li class='active'><a href='#JSFiles' data-toggle='tab'>JavaScript Files</a></li>
							<li ><a href='#CSSFiles' data-toggle='tab'>CSS Files</a></li>
						</ul>
						<div class='tab-content'>
							<div class='tab-pane active' id='JSFiles'>
								<form method='post' action='index.php' enctype='multipart/form-data'>
									<label for='JSfiles'>Choose Javascript files</label>
									<input type='file' name='JSfiles[]' id='JSfiles' multiple/>
									<input type='submit' name='uploadJS' id='uploadJS' value='Minify !' />
								</form>
							</div>
							<div class='tab-pane' id='CSSFiles'>
								<form method='post' action='index.php' enctype='multipart/form-data'>
									<label for='CSSfiles'>Choose CSS files</label>
									<input type='file' name='CSSfiles[]' id='CSSfiles' multiple/>
									<input type='submit' name='uploadCSS' id='uploadCSS' value='Minify !' />
								</form>
							</div>
						</div>
						<?php 
							if($error_min !== '')
							{
								if(stripos($error_min, 'done!')) $class = 'success';
								else $class = 'error';
								echo '<div id="validation" class="'.$class.'">'.$error_min.'</div>';
							}
						?>
						<div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src='js/jquery.min.js'></script>
	<script src='js/bootstrap.min.js'></script>
</html>