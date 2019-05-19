<?php

include_once $_SESSION["root"].'php/DAO/FuncionarioDAO.php';
include_once $_SESSION["root"].'php/Model/ModelUser.php';
include_once $_SESSION['root'].'php/Dao/DepartamentoDAO.php';

class ControllerFuncionario {
	function getAllFuncionarios(){
		if(!isset($_GET['order'])){
			$funcDAO = new FuncionarioDAO();
			$funcionarios=$funcDAO->getAllFuncionarios();
			$deptDAO = new DepartamentoDAO();
			$departamentos=$deptDAO->getAllDepartamentos();
			include_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
		}
		else if($_GET['order'] == 'name'){
			$funcDAO = new FuncionarioDAO();
			$funcionarios=$funcDAO->getAllFuncionariosByName();
			$deptDAO = new DepartamentoDAO();
			$departamentos=$deptDAO->getAllDepartamentos();
			include_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
		}
		else if($_GET['order'] == 'dept'){
			$funcDAO = new FuncionarioDAO();
			$funcionarios=$funcDAO->getAllFuncionariosByDept();
			$deptDAO = new DepartamentoDAO();
			$departamentos=$deptDAO->getAllDepartamentos();
			include_once $_SESSION["root"].'php/View/ViewExibeFuncionarios.php';
		}
	}
	function setFuncionario(){
		$funcDAO = new FuncionarioDAO();
		$funcionario = new ModelUser();
		$deptDAO = new DepartamentoDAO();
		$departamentos=$deptDAO->getAllDepartamentos();
		$funcionario->setFuncionarioFromPOST();
		$resultadoInsercao = $funcDAO->setFuncionario($funcionario);
			
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Funcionário Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;			
		}
		else{
			$_SESSION["flash"]["msg"]="O Login já existe no banco";
			$_SESSION["flash"]["sucesso"]=false;
			//Var temp de feedback	
			$_SESSION["flash"]["nome"]=$funcionario->getNome();
			$_SESSION["flash"]["login"]=$funcionario->getLogin();
			$_SESSION["flash"]["salario"]=$funcionario->getSalario();
		}
		include_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	}

	function getUserId(){
		$id = $_GET['id'];
		$funcDAO = new FuncionarioDAO();
		$funcionario = new ModelUser();
		$depto = new DepartamentoDAO();
		$departamentos = $depto->getAllDepartamentos();

		$funcionario = $funcDAO->getFuncionarioById($id);
		
		$_SESSION['edit']['id'] = $funcionario[0]->getId();
		$_SESSION['edit']['nome'] = $funcionario[0]->getNome();
		$_SESSION['edit']['salario'] = $funcionario[0]->getSalario();
		$_SESSION['edit']['login'] = $funcionario[0]->getLogin();
		$_SESSION['edit']['permissao'] = $funcionario[0]->getPermissao();
		$_SESSION['edit']['dept'] = $funcionario[0]->getDepartamento();
		
		include_once $_SESSION["root"].'\php\View\ViewEditaFuncionario.php';
	}

	function edit(){
		$funcDAO = new FuncionarioDAO();
		$funcionario = new ModelUser();
		$deptDAO = new DepartamentoDAO();
		$departamentos=$deptDAO->getAllDepartamentos();
		$funcionario->setFuncionarioFromPOST();
		$resultadoInsercao = $funcDAO->editFuncionario($funcionario);
		return $resultadoInsercao;
		include_once $_SESSION["root"].'\php\View\ViewExibeFuncionarios.php';
		
	}

	function delete(){
		$id = $_GET['id'];
		$funcDAO = new FuncionarioDAO();
		$funcionario = new ModelUser();
		$funcionario = $funcDAO->getFuncionarioById($id);
		print_r($funcionario);
		$_SESSION['delete']['id'] = $funcionario[0]->getId();
		$resultadoInsercao = $funcDAO->deletaFuncionario($funcionario);
		return $resultadoInsercao;
		include_once $_SESSION["root"].'\php\View\ViewExibeFuncionarios.php';

	}

}