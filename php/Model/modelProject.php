<?php 

class modelProject{
    private $id;
    private $nome;
    private $depto;
    private $resp;

    public function setProjectFromDatabase($linha){
        $this->setId($linha["id"])
            ->setNome($linha["nome"])
            ->setDepto($linha["depto_id"])
            ->setResponsavel($linha["user_resp"]);
    }

    public function setProjectFromPost(){
        $this->setId(null)
        ->setNome($_POST["nome"])
        ->setDepto($_POST["depto_id"])
        ->setResponsavel($_POST["user_resp"]);
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
	public function getDepto(){
		return $this->depto;
	}
	public function setDepto($depto){
		$this->depto = $depto;
		return $this;
    }
    public function getResponsavel(){
		return $this->resp;
	}
	public function setResponsavel($resp){
		$this->resp = $resp;
		return $this;
	}
}

?>