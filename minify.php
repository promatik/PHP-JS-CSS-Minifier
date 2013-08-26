<body style="font-family: monospace;">
<?php
	include_once("minifier.php");
	
	/* FILES ARRAYs
	 * Keys as input, Values as output */ 
	
	$js = array(
		"js/application.js" 	=> "js/application.min.js",
		"js/main.js" 			=> "js/main.min.js"
	);
	
	$css = array(
		"css/application.css"	=> "css/application.min.css",
		"css/main.css"			=> "css/main.min.css"
	);
	
	minifyJS($js);
	minifyCSS($css);
?>
</body>
