<?php

class ModelDept{
	private $id;
	private $sigla;
	private $nome;

	public function setDepartamentoFromDataBase($linha){
        $this->setId($linha["id"])
               ->setNome($linha["nome"])
               ->setSigla($linha["sigla"]);
	}
	
	public function setDepartamentoFromPOST(){
		$this->setId(null)
			->setSigla($_POST['sigla'])
			->setNome($_POST['nome']);

	}

	public function constructorDept($sigla, $nome){
		$this->setId(null);
		$this->setNome($nome);
		$this->setSigla($sigla);
	}

	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
		return $this;
	}	

	public function getNome(){
		return $this->nome;
	}
	public function setNome($nome){
		$this->nome = $nome;
		return $this;
	}	
	public function getSigla(){
		return $this->sigla;
	}
	public function setSigla($sigla){
		$this->sigla = $sigla;
		return $this;
	}
}


?>