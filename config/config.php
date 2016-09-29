<?php 

$dir_root = __DIR__ . "/..";
$dir_tmp = $dir_root . "/tmp";

return array(
	"path_root" => $dir_root,
	"path_tmp" 	=> $dir_tmp,
	"path_template" => $dir_root . "/templates",
	"bot_key" 	=> "",
	"url_api"	=> "https://api.telegram.org/bot",
	"file_count" => $dir_tmp . "/count.txt",
	"time_update" => 1,
	"use_main_loop" => false,
	"debug" => true
);