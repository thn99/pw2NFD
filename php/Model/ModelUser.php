<?php
class ModelUser {

	public $id;
	public $nome; 
	public $salario;
	public $login;
	public $senha; 
	public $permissao;
	public $departamento;

    /**
     * Popula um obj funcionario com os dados vindos da tabela funcionario. Funciona como um construtor
     *
     * @param um array com dados da tupla proveniente do DB, em que o nome do atributo na entidade é o mesmo do atributo no objeto
     *
     * @return não há retorno.
     */
    public function setFuncionarioFromDataBase($linha){
        $this->setid($linha["id"])
               ->setNome($linha["nome"])
               ->setSalario($linha["salario"])
               ->setLogin($linha['login'])
               ->setSenha($linha['senha'])
               ->setpermissao($linha['permissao'])
               ->setdepartamento($linha['departamento']);
    }
    public function setFuncionarioFromPOST(){
        $this->setid(null)
               ->setNome($_POST["nome"])
               ->setSalario($_POST["salario"])
               ->setLogin($_POST['login'])
               ->setSenha($_POST['senha'])
               ->setpermissao(1)
               ->setdepartamento(1);
    }

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getid()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id funcionario
     *
     * @return self
     */
    public function setid($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of salario.
     *
     * @return mixed
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * Sets the value of salario.
     *
     * @param mixed $salario the salario
     *
     * @return self
     */
    public function setSalario($salario)
    {
        $this->salario = $salario ;

        return $this;
    }

    /**
     * Gets the value of login.
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Sets the value of login.
     *
     * @param mixed $login the login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Gets the value of senha.
     *
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Sets the value of senha.
     *
     * @param mixed $senha the senha
     *
     * @return self
     */
    public function setSenha($senha)
    {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);

        return $this;
    }

    /**
     * Gets the value of permissao.
     *
     * @return mixed
     */
    public function getpermissao()
    {
        return $this->permissao;
    }

    /**
     * Sets the value of permissao.
     *
     * @param mixed $permissao the id permissao
     *
     * @return self
     */
    public function setpermissao($permissao)
    {
        $this->permissao = $permissao;
        return $this;
    }

    /**
     * Gets the value of departamento.
     *
     * @return mixed
     */
    public function getdepartamento()
    {
        return $this->departamento;
    }

    /**
     * Sets the value of departamento.
     *
     * @param mixed $departamento the id departamento
     *
     * @return self
     */
    public function setdepartamento($departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }
}