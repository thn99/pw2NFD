<?php

class ModelDept{
	private $sigla;
	private $nome;

	public function constructorDept($sigla, $nome){
		$this->setNome($nome);
		$this->setSigla($sigla);
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