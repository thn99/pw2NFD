<?php
/*
Esse script funciona como um front controller, todas as requisições passam primeiro por aqui, também podemos enxergar como um gateway padrão. Isso só é possível graças ao htaccess que faz com que o todas as requisições feitas sejam redirecionadas para cá.
Da forma como esse arquivo de rotas funciona, nós não fazemos “links” para arquivos, nós associamos uma url a um controller.
****Descomentar os print_r abaixo para entender melhor****
*/

//Path é um array onde cada posição é um elemento da URL
$path = explode('/', $_SERVER['REQUEST_URI']);
//Action é a posição do array
$action = $path[sizeOf($path) - 1];
//Caso a ação tenha param GET esse param é ignorado, isso é particularmente útil para trabalhar com AJAX, já que o conteúdo do get será útil apenas para o controller e não para a rota
$action = explode('?', $action);
$action = $action[0];

//Descomentar esse bloco e acessar qualquer url do sistema.
/*echo "<pre>";
echo "A URL digitada<br>";
print_r($_SERVER['REQUEST_URI']);
echo "<br><br>A URL digitada explodida por / e tranformada em um array<br>";
print_r($path);
echo "<br><br>A ultima posição do array, que é a ação que o usuário/sistema quer realizar, é essa ação(string) que é mapeada(roteada) a um método de um controller<br>";
print_r($action);
echo "</pre>";*/

//Todo controller que tiver pelo menos uma rota associada a ele deve aparecer aqui.
include_once $_SESSION["root"].'php/Controller/ControllerLogin.php';
include_once $_SESSION["root"].'php/Controller/ControllerFuncionario.php';
include_once $_SESSION["root"].'php/Controller/ControllerDepartamento.php';
include_once $_SESSION["root"].'php/Controller/ControllerProjeto.php';

//Sequencia de condicionais que verificam se a ação informada está roteada
if ($action == '' || $action == 'index' || $action == 'index.php' || $action == 'login') {
	require_once $_SESSION["root"].'php/View/ViewLogin.php';
}
else if ($action == 'postLogin') {
	$cLogin = new ControllerLogin();
	$cLogin->verificaLogin();
}
else if ($action == 'exibeFuncionarios') {
	$cFunc = new ControllerFuncionario();
	$cFunc->getAllFuncionarios();
}
else if ($action == 'cadastraFuncionario') {
	$cFunc = new ControllerDepartamento();
	$cFunc->getAllDepartamentos();
}
else if ($action == 'postCadastraFuncionario') {
	$cFunc = new ControllerFuncionario();
	$cFunc->setFuncionario();
}
else if($action == 'postCadastraDepartamento'){
	$cDept = new ControllerDepartamento();
	$cDept->setDepartamento();
}

else if($action == 'exibeDepartamento'){
	$eDept = new ControllerDepartamento();
	$eDept->getDeptos();
}

else if($action == 'cadastrarDepartamento'){
	$cDept = new ControllerDepartamento();
	$cDept->setDeptos();
}
else if($action == 'exibeProjetos'){
	$cProjeto = new ControllerProjeto();
	$cProjeto->getAllProjetos();
}
else if($action == 'cadastrarProjetos'){
	$cProjeto = new ControllerProjeto();
	$cProjeto->setProjetos();
}
else if ($action == 'postCadastraProjetos') {
	$cProjeto = new ControllerProjeto();
	$cProjeto->setProjetosDAO();
}

else if($action == 'sair'){
	$_SESSION['logado'] = false;
	session_destroy();
	header("Location: login");
}

else if($action == 'ViewEditaFuncionario'){
	$cFunc = new ControllerFuncionario();
	$cFunc->getUserId();
}

else if($action == 'postEditFuncionario'){
	$eFunc = new ControllerFuncionario();
	$eFunc->edit();
	header("Location: exibeFuncionarios");
}

else if($action == 'deletaFuncionario'){
	$dFunc = new ControllerFuncionario();
	$dFunc->delete();
	header('Location: exibeFuncionarios');
}

else {
	echo "Página não encontrada!";
	//isso trata todo erro 404, podemos criar uma view mais elegante para exibir o aviso ao usuário.
}

?>