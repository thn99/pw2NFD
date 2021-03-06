<?php
//READ ME
//pra ajustar quem pode deletar/editar as coisas, só trocar a comparação da session 'permissao'
//tá setado pra admin
if ($_SESSION['logado'] == true) {
	$titulo = "Exibir Funcionários";
	include $_SESSION["root"] . 'includes/header.php';
	?>

	<body>
		<div class="container">
			<!-- add no menu -->
			<?php include $_SESSION["root"] . 'includes/menu.php'; ?>
			<!-- fim menu -->
			<div id="principal">
				<h1 class="text-center">Funcionários</h1>
				<table class="table table-striped">
					<?php
					//$funcionarios foi criado no controller que chamou essa classe;
					echo "<tr>
					 <th scope='col' onClick={orderByName()}>Nome</th>
					 <th scope='col'>Salário</th>
					 <th scope='col'>Permissão</th>
					 <th scope='col' onClick={orderByDept()}>Departamento</th>";
					if ($_SESSION['permissao'] == 1) {
						echo "<th>Projeto</th><th scope='col'>Ação</th>
					 	</tr>";
					} else {
						echo "<th>Projeto</th></tr>";
					}

					foreach ($funcionarios as $value) {
						foreach ($departamentos as $dept) {
							if ($dept->getId() == $value->getDepartamento()) {
								$departamento = $dept->getNome();
							}
						}
						foreach($projetos as $proj){
							if($proj->getId() == $value->getProjeto()){
								$projeto = $proj->getNome();
							}
						}

						if($value->getPermissao() >= 0){
							echo "<tr>
							<td>" . $value->getNome() . "</td>
							<td>" . $value->getSalario() . "</td>
							<td>" . $value->getPermissao() . "</td>
							<td>" . $departamento . "</td>
							<td>". $projeto ."</td>";
							

							if ($_SESSION['permissao'] == 1) {
								echo "<td>
									<button type='button' class='btn btn-primary' onClick={editarFuncionario('" . $value->getId() . "');}>Editar</button>
									<button type='button' onClick={excluirFuncionario('" . $value->getId() . "');} class='btn btn-danger'>Delete</button>
								</td>
								</tr>";
							} else {
								echo "</tr>";
							}
						}
					}
					?>
				</table>
			</div>
		</div>
	</body>
	<!-- add no footer -->
	<?php
	include $_SESSION["root"] . 'includes/footer.php';
	if (isset($_SESSION["flash"])) {
		foreach ($_SESSION["flash"] as $key => $value) {
			unset($_SESSION["flash"][$key]);
		}
	}
} else {
	header("Location: login");
}
?>
<!-- fim footer -->
<script>
	$(document).ready(function() {
		$('.visualizarFuncionario').addClass('active');
	});

	function editarFuncionario(id) {		
		window.location = 'ViewEditaFuncionario?id=' + id

	}

	function excluirFuncionario(id) {
		window.location = 'deletaFuncionario?id=' + id
	}

	function orderByName(){
		window.location = 'exibeFuncionarios?order=name'
	}

	function orderByDept(){
		window.location = 'exibeFuncionarios?order=dept'
	}

</script>