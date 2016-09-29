<?php 
	require "vendor/autoload.php";

	$app = \Bot\App::getInstance(include("config/config.php"));
	$app -> run();