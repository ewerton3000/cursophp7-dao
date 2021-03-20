<?php
//Essa classe extendida abaixo é como se vc pegasse toda a biblioteca do PDO para usala dentro desta classe extendida!
class Sql extends PDO{
	//Variavel privada de conexão:$conn
	private $conn;

	//Criando um metodo construtor para criar a conexão com o banco de dados!
	public function __construct(){
		//Instanciando a classe de extensão PDO para fazer a conexão com o banco de dados!
		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root" ,"");
		//conexão com o sqlserver!
		//$this->conn = new PDO("sqlsrv:Database=dbphp7;server=LAPTOP-9H600M4N\SQL;ConnectionPooling=0;", "sa" ,"root");

	}

	private function setParams($statement,$parameters=array()){
		foreach($parameters as $key => $value){
			
			//Chamando as funções do setParam!

			$this->setParam($statement,$key,$value);
		}
	}
	private function setParam($statement,$key,$value){

		$statement->bindParam($key,$value);

	}

	//Criando uma função chamada query com parametros chamados= $rawQuery,$params, que irão 
	public function query($rawQuery,$params = array()){
		//$rawQuery=Significa uma query bruta que trata de um comando sql
		//Depois temos o $params que serão os parametros que sairão em um formato array como acima!

		$stmt = $this->conn->prepare($rawQuery);

		//Chamando a Função setParams!
		$this->setParams($stmt,$params);

		//Fazendo a execução no Banco de dados com o execute()!
	    $stmt->execute();

	    //Retornando o objeto=$stmt!
		return $stmt;
	}

	//Criando uma função publica chamada select!
	public function select($rawQuery,$params =array()){
		//Aqui use a variavel $stmt para armazenar os dados do $this
		//O $this puxa as informações da função query
		//Para mostrar as informações das variaveis $rawQuery e $params e mostra-las em array na tela!


		//Recebendo o $stmt de novo para puxar para ele os parametros da função query!
		$stmt = $this->query($rawQuery , $params);
        
        //Agora o $stmt retorna e mostra todos os dados em array!
		return $stmt->FetchAll(PDO::FETCH_ASSOC);

	}
}
?>