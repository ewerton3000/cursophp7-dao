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




/*Método Listar:
carrega uma lista de usuarios buscando pelo login!
//Instanciando a classe com a busca!
//$search = Usuario::search("jo");
//Acima vc busca o usuario que começa com "jo" ou outro nome que esteja registrado no banco de dados escolhido!
echo json_encode($search);
*/





//$usuario= new Usuario();
//$usuario->login("jose" , "1234567890");


//usando o insert para inserir as informações abaixo no banco de dados


/* trecho do update
$usuario=new Usuario();

//Abaixo dentro dos parenteses vc vai escolher a id que vai ser alterada!
$usuario->loadbyId(6);

//inserido os dados para substituir os que estão na id acima!
$usuario->update("éden","796");

//mostrando na tela com echo!
echo $usuario;
*/









//instanciando a classe Usuario
//trecho do insert
//$aluno = new Usuario("aluno","@lun0");

//Puxando os sets correspondentes das linhas usuario e senha"
//$aluno->setDeslogin("aluno");
//$aluno->setDessenha("123");

//Puxando a função da classe para a variavel!
//$aluno->insert();


//echo $aluno;




$usuario=new Usuario();
$usuario->loadbyId(6);
$usuario->delete();
echo $usuario;


?>