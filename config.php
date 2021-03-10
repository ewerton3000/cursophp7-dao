<?php
//Este arquivo é de configuração do sistema! 
spl_autoload_register(function($class_name){

//Esta variavel abaixo  facilita o uso dela no if!
 	$filename ="class".DIRECTORY_SEPARATOR. $class_name.".php";

if(file_exists(($filename))){
	require_once($filename);
}
});
?>