<?php
//Add a classe responsavel por fazer a conexao com banco de dados
include_once $_SESSION["root"] . 'php/DAO/DatabaseConnection.php';
include_once $_SESSION["root"] . 'php/Model/ModelProject.php';
class ProjetoDAO
{
	/*Como o PHP tem inferência de tipo, esse método, assim como outros, poderia ser mais "simples", porém estou fazendo de uma maneira que acho mais didático*/
	function getAllProjetos()
	{

		//pego uma ref da conexão
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		//Faço o select usando prepared statement
		$statement = $conn->prepare("SELECT * FROM projetos");
		$statement->execute();

		//linhas recebe todas as tuplas retornadas do banco		
		$linhas = $statement->fetchAll();

		//Verifico se houve algum retorno, senão retorno null
		if (count($linhas) == 0)
			return null;

		//Var que irá armazenar um array de obj do tipo funcionário


		foreach ($linhas as $value) {
			$projeto = new ModelProject();
			$projeto->setProjectFromDataBase($value);
			$projetos[] = $projeto;
		}
		return $projetos;
	}

	function getAllProjetosByName()
	{

		//pego uma ref da conexão
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();

		//Faço o select usando prepared statement
		$statement = $conn->prepare("SELECT * FROM projeto ORDER BY nome");
		$statement->execute();

		//linhas recebe todas as tuplas retornadas do banco		
		$linhas = $statement->fetchAll();

		//Verifico se houve algum retorno, senão retorno null
		if (count($linhas) == 0)
			return null;

		//Var que irá armazenar um array de obj do tipo funcionário


		foreach ($linhas as $value) {
			$projeto = new ModelProject();
			$projeto->setProjectFromDataBase($value);
			$projetos[] = $projeto;
		}
		return $projetos;
	}

	function getProjetosByDept() {
		//Verifico se houve algum retorno, senão retorno null
		if (count($linhas) == 0)
			return null;

		//Var que irá armazenar um array de obj do tipo funcionário


		foreach ($linhas as $value) {
			$projeto = new ModelProject();
			$projeto->setProjectFromDataBase($value);
			$projetos[] = $projeto;
		}
		return $projetos;
    }

	//Retorna 1 se conseguiu inserir;
	function setProjeto($project)
	{

		try {
			//monto a query
			$sql = "INSERT INTO projetos (		
                id,
                nome,
                depto_id,
                user_resp) 
                VALUES (
                :id,
                :nome,
                :depto,
                :user_resp)";

			//pego uma ref da conexão
			$instance = DatabaseConnection::getInstance();
			$conn = $instance->getConnection();
			//Utilizando Prepared Statements
			$statement = $conn->prepare($sql);

			$statement->bindValue(":id", $project->getId());
			$statement->bindValue(":nome", $project->getNome());
			$statement->bindValue(":depto", $project->getDepto());
			$statement->bindValue(":user_resp", $project->getResponsavel());
			return $statement->execute();
		} catch (PDOException $e) {
			echo "Erro ao inserir na base de dados." . $e->getMessage();
		}
	}

	function getProjetoById($id)
	{
		$sql = "SELECT * FROM projetos WHERE id={$id}";
		//pego uma ref da conexão
		$instance = DatabaseConnection::getInstance();
		$conn = $instance->getConnection();
		//Utilizando Prepared Statements
		$statement = $conn->prepare($sql);
		$statement->execute();
		$query = $statement->fetchAll();
		//print_r($query);

		foreach ($query as $value) {
			$projeto = new ModelProject();
			$projeto->setProjectFromDataBase($value);
			$projetos[] = $projeto;
		}
		return $projetos;
	}
}
