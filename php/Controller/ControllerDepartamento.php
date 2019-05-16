<?php

include_once $_SESSION["root"].'php/DAO/FuncionarioDAO.php';
include_once $_SESSION["root"].'php/Model/ModelUser.php';
include_once $_SESSION['root'].'php/Dao/DepartamentoDAO.php';

class ControllerDepartamento {
	function getAllDepartamentos(){
		$deptDAO = new DepartamentoDAO();
		$departamentos=$deptDAO->getAllDepartamentos();
		include_once $_SESSION["root"].'php/View/ViewCadastraFuncionarios.php';
	}
	
	function getAllDepartamentosCadastro(){
		$deptDAO = new DepartamentoDAO();
		$departamentos=$deptDAO->getAllDepartamentos();
		include_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	}

	function getDeptos(){
		$deptDAO = new DepartamentoDAO();
		$departamentos=$deptDAO->getAllDepartamentos();
		include_once $_SESSION["root"].'php/View/viewExibeDepartamento.php';
	}

	function setDeptos(){
		$deptDAO = new DepartamentoDAO();
		$departamentos=$deptDAO->getAllDepartamentos();
		include_once $_SESSION["root"].'php/View/ViewCadastraDepartamento.php';
	}

	function setDepartamento(){
		$DeptDAO = new DepartamentoDAO();
		$departamento = new ModelDept();
		$departamento->setDepartamentoFromPOST();
		$resultadoInsercao = $DeptDAO->setDepartamento($departamento);
			
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Departamento Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;			
		}
		else{
			$_SESSION["flash"]["msg"]="O Departamento já existe no banco";
			$_SESSION["flash"]["sucesso"]=false;
			//Var temp de feedback	
			$_SESSION["flash"]["nome"]=$departamento->getNome();
			$_SESSION["flash"]["login"]=$departamento->getLogin();
			$_SESSION["flash"]["salario"]=$departamento->getSalario();
		}
		include_once $_SESSION["root"].'php/View/ViewCadastraFuncionario.php';
	}
}