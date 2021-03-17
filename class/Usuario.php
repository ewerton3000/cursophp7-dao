<?php
//Criando a classe Usuario
class Usuario{
	//criando os objetos privados
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;
	//Criando gets e sets dos objetos com funções

	public function getIdusuario(){
		return $this->idusuario;

	}
	public function setIdusuario($value){
		$this->idusuario = $value;
		
	}
	public function getDeslogin(){
		return $this->deslogin;
		
	}
	public function setDeslogin($value){

		$this->deslogin = $value;
	}
	public function getDessenha(){
		return $this->dessenha;
		
	}
	public function setDessenha($value){
    $this->dessenha = $value;
		
	}
	public function getDtcadastro(){
		return $this->dtcadastro;
		
	}
	public function setDtcadastro($value){
		$this->dtcadastro =$value;
		}
		//criando uma função para puxar um usuario com a id
		public function loadBYId($id){
			//Instanciando a classe Sql do arquivo Sql.php
			$sql = new Sql();
			//selecionando os dados da tabela onde o id do usuario dentro do banco de dados!
			//Transformando o resultado em array!
			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario =:ID",array(
				":ID"=>$id
			));
            
            //criando uma condição se a id for maior que 0 ela sera mostrada senão não exibirá
			if(count($results)> 0){
				$row = $results[0];
               
              //Selecionando os dados que serão puxados da tabela tb_usuarios 
				//usando a varivavel $row para mostrar o resultado em array(talvez de pra usar qualquer um!
				$this->setIdusuario($row['idusuario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDessenha($row['dessenha']);
				//Usando e instanciando o DateTime para mostrar em formato de data("d/m/Y")!
				$this->setDtcadastro(new DateTime($row['dtcadastro']));
				
			}
		}
		//Usando uma função para LISTAR os dados das id do banco de dados!
		//static function:Uma função que ao ser instanciada pode ser chamada pelos dois pontos :: 
		//exemplo $lista = Usuario::getlist;

//Função para fazer uma busca! 
public static function search($login){
	$sql = new Sql();
	return $sql->select("SELECT *FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
		":SEARCH"=>"%".$login."%"
	));
}

//Criando uma função para autenticar o login e senha!
public function login($login,$password){
	$sql = new Sql();
	$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha =:PASSWORD",array(
				":LOGIN"=>$login,
				":PASSWORD"=>$password
			));
            
           
			if(count($results)> 0){
				$row = $results[0];
               
              
				$this->setIdusuario($row['idusuario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDessenha($row['dessenha']);
				$this->setDtcadastro(new DateTime($row['dtcadastro']));
				
			}
			else{
				throw new Exception("Login e/ou senha incorretos!");
			}
		}
		//Usando uma função para LISTAR os dados das id do banco de dados!
		//static function:Uma função que ao ser instanciada pode ser chamada pelos dois pontos :: 
		//exemplo $lista = Usuario::getlist;
public static function getList(){
	$sql = new Sql();
	return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
}
//Criando uma função toString para retornar os dados em formato json e pega-los com os get feitos anteriormente!
public function __toString(){

	return json_encode(array(
		//Usando as funções get para puxa-las novamente!
		"idusuario"=>$this->getIdusuario(),
		"deslogin"=>$this->getDeslogin(),
		"dessenha"=>$this->getDessenha(),
		//O format é usado para sair na forma de data!
		"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
	));
}
}
?>