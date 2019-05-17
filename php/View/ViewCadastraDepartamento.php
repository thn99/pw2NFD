<?php
if ($_SESSION['logado'] == true && $_SESSION['permissao'] == 'admin') {

	$titulo = "Cadastrar Funcionario";
	include $_SESSION["root"] . 'includes/header.php';
	?>

	<body>
		<div class="container">
			<!-- add no menu -->
			<?php include $_SESSION["root"] . 'includes/menu.php'; ?>
			<!-- fim menu -->
			<div id="principal">
				<h1 class="text-center">Cadastro de Departamentos</h1>
				<form action="postCadastraDepartamento" method="POST">
					<div class="row">
						<?php if (isset($_SESSION["flash"]["msg"])) {
							if ($_SESSION["flash"]["sucesso"] == false)
								echo "<div class='bg-danger text-center msg'>" . $_SESSION["flash"]["msg"] . "</div>";
							else {
								echo "<div class='bg-success text-center msg'>" . $_SESSION["flash"]["msg"] . "</div>";
							}
						} ?>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sigla">Sigla:<span class="requerido">*</span></label>
								<input type="sigla" name="sigla" class="form-control" id="sigla" value="<?php if (isset($_SESSION["flash"]["login"])) echo $_SESSION["flash"]["login"]; ?>">
							</div>
							<div class="form-group">
								<label for="nome">Nome:<span class="requerido">*</span></label>
								<input type="nome" name="nome" class="form-control" id="nome" value="">
							</div>

						</div>
					</div>
			</div>
			<button type="submit" class="btn btn-default center-block">Submit</button>
			</form>
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
	header('Location: exibeFuncionarios');
}
?>
<!-- fim footer -->
<script>
	$(document).ready(function() {
		$('.cadastrarFuncionario').addClass('active');
	});
</script>