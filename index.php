<?php
//requrimento do arquivo config.php
require_once("config.php");

//Instaciando a classe Sql
$sql = new Sql();

//Fazendo o Select from dentro do bancode dados
$usuarios = $sql->select("SELECT * FROM tb_usuarios");

//Mostrando os dados com Json_encode

echo json_encode($usuarios);


?>