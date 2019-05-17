<?php
if ($_SESSION['logado'] == true) {
	$titulo = "Exibir Departamentos";
	include $_SESSION["root"] . 'includes/header.php';
	?>

	<body>
		<div class="container">
			<!-- add no menu -->
			<?php include $_SESSION["root"] . 'includes/menu.php'; ?>
			<!-- fim menu -->
			<div id="principal">
				<h1 class="text-center">Departamentos</h1>
				<table class="table table-striped">
					<?php
					//$funcionarios foi criado no controller que chamou essa classe;
					echo "<tr>";
					echo "<th scope='col'>Sigla</th>";
					echo "<th scope='col'>Nome</th>";
					echo "</tr>";
					foreach ($departamentos as $dept) {
						echo "
                    <tr>
					<td>" . $dept->getSigla() . "</td>
					<td>" . $dept->getNome() . "</td>
                    </tr>";
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
</script>