<?php
//requrimento do arquivo config.php
require_once("config.php");

//Instaciando a classe Sql
//$sql = new Sql();

//Fazendo o Select from dentro do bancode dados
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");

//Mostrando os dados com Json_encode

//echo json_encode($usuarios);

/*
//Carregam um usuario(se quiser testar tire da tag de comentários)

$root = new Usuario();

$root->loadbyId(5);
*/
//echo $root;

//Usando a instancia da função static e chamando a função getList
//$lista = Usuario::getList();

//Transformando os dados em json na execução! 
//echo json_encode($lista)

//carrega uma lista de usuarios buscando pelo login!
//Instanciando a classe com a busca!
//$search = Usuario::search("jo");
//Acima vc busca o usuario que começa com "jo" ou outro nome que esteja registrado no banco de dados escolhido!
//echo json_encode($search);


$usuario= new Usuario();
$usuario->login("jose" , "1234567890");
echo $usuario;
?>