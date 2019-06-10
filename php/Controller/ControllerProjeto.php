<?php

include_once $_SESSION["root"].'php/DAO/FuncionarioDAO.php';
include_once $_SESSION["root"].'php/Model/ModelUser.php';
include_once $_SESSION['root'].'php/Dao/DepartamentoDAO.php';
include_once $_SESSION['root'].'php/Dao/ProjetoDAO.php';

class ControllerProjeto {
	function getAllProjetos(){
		if(!isset($_GET['order'])){
			$projectDAO = new ProjetoDAO();
			$projetos=$projectDAO->getAllProjetos();
			$deptDAO = new DepartamentoDAO();
            $departamentos=$deptDAO->getAllDepartamentos();
            $funcDAO = new FuncionarioDAO();
			$funcionarios=$funcDAO->getAllFuncionarios();
			include_once $_SESSION["root"].'php/View/ViewExibeProjetos.php';
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
    
    function setProjetos(){
        $deptDAO = new DepartamentoDAO();
        $funcDAO = new FuncionarioDAO();
        $departamentos=$deptDAO->getAllDepartamentos();
        $funcionarios=$funcDAO->getAllFuncionarios();
        include_once $_SESSION["root"].'php/View/ViewCadastraProjeto.php';
    }

	function setProjetosDAO(){
		$projetoDAO = new ProjetoDAO();
		$projeto = new ModelProject();
        $deptDAO = new DepartamentoDAO();
        $funcDAO = new FuncionarioDAO();
        $departamentos=$deptDAO->getAllDepartamentos();
        $funcionarios=$funcDAO->getAllFuncionarios();
		$projeto->setProjectFromPOST();
		$resultadoInsercao = $projetoDAO->setProjeto($projeto);
			
		if($resultadoInsercao){
			$_SESSION["flash"]["msg"]="Projeto Cadastrado com Sucesso";
			$_SESSION["flash"]["sucesso"]=true;			
		}
		else{
			$_SESSION["flash"]["msg"]="O Projeto já existe no banco";
			$_SESSION["flash"]["sucesso"]=false;
			//Var temp de feedback	
			$_SESSION["flash"]["nome"]=$projeto->getNome();
			$_SESSION["flash"]["depto"]=$projeto->getDepto();
			$_SESSION["flash"]["resp"]=$projeto->getResponsavel();
		}
		include_once $_SESSION["root"].'php/View/ViewCadastraProjeto.php';
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