<?php
	spl_autoload_register(function($fname){

		$url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$path='';
		$ext='.php';
		if(strrpos($url, 'includes')){
			$path='../classes/';
		}
		$path='classes/';

		$full_path=$path.$fname.$ext;
		if(file_exists($full_path)){
			include_once $full_path;
		}
		else{
			throw new Exception('Error:no file found');
		}

	});

?>