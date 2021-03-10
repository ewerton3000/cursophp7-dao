<?php
//Essa classe extendida abaixo é como se vc pegasse toda a biblioteca do PDO para usala dentro desta classe extendida!
class Sql extends PDO{
	private $conn;
	public function__construct(){
		$this->conn = new PDO("mysqli:host=localhost;dbname=dbphp7","root","root");
		//conexão com o sqlserver!
		//$conn = new PDO("sqlsrv:Database=dbphp7;server=LAPTOP-9H600M4N\SQL;ConnectionPooling=0;", "sa" ,"root");

	}
	private function setParams($statment,$parameters=array()){
		foreach($parameters as $key => $value){
			$this->setParam($key,$value);
		}
	}
	private function setParam($statment,$key,$value){

		$statment->bindParam($key,$value);

	}
	public function query($rawQuery,$params = array()){
		//$rawQuery=Significa uma query bruta que trata de um comando sql
		//Depois temos o $params que serão os parametros que sairão em um formato array como acima!
		$stmt =$this->conn->prepare($RawQuery);
		$this->setParams($stmt,$params);
		return $stmt->execute();
		return $stmt;
	}
	public function select($rawQuery,$params =array()):array
	{
		$this->query($rawQuery,$params);
		return $stmt->fetchAll(PDO::FECHT_ASSOC);

	}
}
?>