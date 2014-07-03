<?php
	/*
	 * JS and CSS Minifier 
	 * version: 1.0 (2013-08-26)
	 *
	 * This document is licensed as free software under the terms of the
	 * MIT License: http://www.opensource.org/licenses/mit-license.php
	 *
	 * Toni Almeida wrote this plugin, which proclaims:
	 * "NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK."
	 * 
	 * This plugin uses online webservices from javascript-minifier.com and cssminifier.com
	 * This services are property of Andy Chilton, http://chilts.org/
	 *
	 * Copyrighted 2013 by Toni Almeida, promatik.
	 */
	
	function minifyJS($arr){
		return minify($arr, 'http://javascript-minifier.com/raw', 'upload/js/');
	}
	
	function minifyCSS($arr){
		return minify($arr, 'http://cssminifier.com/raw', 'upload/css/');
	}
	
	function minify($arr, $url, $path){
		$treatment = '';
		foreach ($arr as $key => $value) {
			$uploaded_file = $path.$key;
			$handler = fopen($value, 'w') or die("File <a href='" . $value . "'>" . $value . "</a> error!<br />");
			fwrite($handler, getMinified($url, file_get_contents($uploaded_file)));
			fclose($handler);
			unlink($uploaded_file);    // delete uploaded files
			$treatment .= "File <a href='" . $value . "'>" . $value . "</a> done!<br />";
		}
		return $treatment;
	}
	
	function getMinified($url, $content) {
		$postdata = array('http' => array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
	        'content' => http_build_query( array('input' => $content) ) ) );
		return file_get_contents($url, false, stream_context_create($postdata));
	}
	
?>
