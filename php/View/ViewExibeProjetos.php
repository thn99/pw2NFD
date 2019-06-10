<?php
if ($_SESSION['logado'] == true) {
	$titulo = "Exibir Projetos";
	include $_SESSION["root"] . 'includes/header.php';
	?>

	<body>
		<div class="container">
			<!-- add no menu -->
			<?php include $_SESSION["root"] . 'includes/menu.php'; ?>
			<!-- fim menu -->
			<div id="principal">
				<h1 class="text-center">Projetos</h1>
				<table class="table table-striped">
					<?php
					//$funcionarios foi criado no controller que chamou essa classe;
					echo "<tr>";
					echo "<th scope='col'>Nome</th>";
					echo "<th scope='col'>Departamento</th>";
					echo "<th scope='col'>Responsável</th>";
					echo "</tr>";
					foreach ($projetos as $projeto) {
                        foreach($departamentos as $depto){
                            foreach($funcionarios as $func){
                                if($depto->getId() == $projeto->getDepto() && $func->getId() == $projeto->getResponsavel()){
                                        echo "
                                    <tr>
                                    <td>" . $projeto->getNome() . "</td>
                                    <td>" . $depto->getNome() . "</td>
                                    <td>" . $func->getNome() . "</td>
                                    </tr>";
                                }
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
		$('.visualizarProjeto').addClass('active');
	});
</script>