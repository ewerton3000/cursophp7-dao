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
		$this->dtcadastro = $value;
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
				
               $this->setData($results[0]);
              //Selecionando os dados que serão puxados da tabela tb_usuarios 
				//usando a varivavel $row para mostrar o resultado em array(talvez de pra usar qualquer um!
				//$this->setIdusuario($row['idusuario']);
				//$this->setDeslogin($row['deslogin']);
				//$this->setDessenha($row['dessenha']);
				//Usando e instanciando o DateTime para mostrar em formato de data("d/m/Y")!
				//$this->setDtcadastro(new DateTime($row['dtcadastro']));



                //Este $this abaixo está puxando os sets pela função setData pq fica mais facil de usar as informções e o codigo fica mais limpo e incluindo a linha com a varialvel $row= $row = $results[0];!

              
				
				
			}
		}
		//Usando uma função para LISTAR os dados das id do banco de dados!
		//static function:Uma função que ao ser instanciada pode ser chamada pelos dois pontos :: 
		//exemplo $lista = Usuario::getlist;

//Função para fazer uma busca! 
public static function search($login){
	$sql = new Sql();
	return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
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
               
              
				$this->setData($results[0]);
				
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


//
public function setData($data){

	//Neste caso muda a variavel $row pela $data pq ela é o parametro desta função!
                $this->setIdusuario($data['idusuario']);
				$this->setDeslogin($data['deslogin']);
				$this->setDessenha($data['dessenha']);
				$this->setDtcadastro(new DateTime($data['dtcadastro']));

}

// DAO Insert:Criando uma função vc pode inserir informações no banco de dados !
public function insert(){
	$sql = new Sql();
//Chamando as variaveis(LOGIN E PASSWORD) para receberem as informações!

//para o mysqli:$results = $sql->select("CALL sp_usuarios_insert(:LOGIN :PASSWORD)"
//para o sqlserver:$results = $sql->select("EXECUTE sp_usuarios_insert(:LOGIN :PASSWORD)"
	$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
		//puxando os get correspondentes!
		//O nome sp_usuarios_insert é o nome da procedures do banco de dados!
		':LOGIN'=>$this->getDeslogin(),
	    ':PASSWORD'=>$this->getDessenha()
	));
	if(count ($results) > 0) {
		$this->setData($results[0]);
	}
	
}

//UPDATE:O comando update atualiza os campos da tabela no banco de dados indicando as colunas corretas! exemplo abaixo com a função update!

//criando uma função update 
public function update($login , $password){
	//puxando os parametros para o $this!
	$this->setDeslogin($login);
	$this->setDessenha($password);

//instanciando a classe
	$sql = new Sql();

//Realizando a query para funcionar o update(essencial para a atualização dos dados!)! 
	//Esquema:$sql->query("UPDATE nome da tabela SET nome da coluna 1 = :COLUNA 1,nome da coluna 2 = :COLUNA 2", .......)
	$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario =:ID",array(
		//puxando os parametros para os seus nomes correspondentes!
		':LOGIN'=>$this->getDeslogin(),
	    ':PASSWORD'=>$this->getDessenha(),
	    ':ID'=>$this->getIdusuario()
	));
}


public function delete(){
	$sql = new Sql();

//usando a query para funcionar o delete
	//Esquema:$sql->query("DELETE FROM nome da tabela WHERE nome do campo(id) = :ID")
	$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID",array(
		':ID'=>$this->getIdusuario()


	));
	//Abaixo usamos o sets correspondentes da id escolhida!
		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
}
//Os parenteses são para vc não dar erro na hora de inserir os dados no insert lá do index.php se der erro não vaiser inserido nenhum dado e seder certo OK!
public function __construct($login = "" ,$password = ""){
	$this->setDeslogin($login);
	$this->setDessenha($password);
}


public function __toString(){

	return json_encode(array(
		//Usando as funções get para puxa-las novamente!
		"idusuario"=>$this->getIdusuario(),
		"deslogin"=>$this->getDeslogin(),
		"dessenha"=>$this->getDessenha(),
		//O format é usado para sair na forma de data!
		"dtcadastro"=>$this->getDtcadastro()->Format("d/m/Y H:i:s")
	));
}
}
?>