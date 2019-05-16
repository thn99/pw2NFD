<?php
//Add a classe responsavel por fazer a conexao com banco de dados
include_once $_SESSION["root"].'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"].'php/Model/ModelUser.php';
class FuncionarioDAO {
	/*Como o PHP tem inferência de tipo, esse método, assim como outros, poderia ser mais "simples", porém estou fazendo de uma maneira que acho mais didático*/
	function getAllFuncionarios(){	

		//pego uma ref da conexão
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		//Faço o select usando prepared statement
		$statement = $conn->prepare("SELECT * FROM usuario");		
		$statement->execute();

		//linhas recebe todas as tuplas retornadas do banco		
		$linhas = $statement->fetchAll();
		
		//Verifico se houve algum retorno, senão retorno null
		if(count($linhas)==0)
				return null;

		//Var que irá armazenar um array de obj do tipo funcionário
		$funcionarios;		
		
		foreach ($linhas as $value) {
			$funcionario = new ModelUser();
			$funcionario->setFuncionarioFromDataBase($value);			
			$funcionarios[]=$funcionario;
		}	
		return $funcionarios;		
	}
	//Retorna 1 se conseguiu inserir;
	function setFuncionario($func){			

		try {
			//monto a query
            $sql = "INSERT INTO funcionario (		
                id,
                nome,
                salario,
                login,
                senha,
                permissao,
                departamento) 
                VALUES (
                :id,
                :nome,
                :salario,
                :login,
                :senha,
                :permissao,
                :departamento)"
        	;

            //pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);

            $statement->bindValue(":id", $func->getIdFuncionario());
            $statement->bindValue(":nome", $func->getNome());
            $statement->bindValue(":salario", $func->getSalario());
            $statement->bindValue(":login", $func->getLogin());
            $statement->bindValue(":senha", md5($func->getSenha()));
            $statement->bindValue(":permissao", $func->getIdPermissao());
            $statement->bindValue(":departamento", $func->getIdDepartamento());
            return $statement->execute();

        } catch (PDOException $e) {
            echo "Erro ao inserir na base de dados.".$e->getMessage();
        }		
	}
}