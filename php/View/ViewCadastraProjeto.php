<?php
if ($_SESSION['logado'] == true && $_SESSION['permissao'] == 1) {

	$titulo = "Cadastrar Projetos";
	include $_SESSION["root"] . 'includes/header.php';
	?>

	<body>
		<div class="container">
			<!-- add no menu -->
			<?php include $_SESSION["root"] . 'includes/menu.php'; ?>
			<!-- fim menu -->
			<div id="principal">
				<h1 class="text-center">Cadastro de Projetos</h1>
				<form action="postCadastraProjetos" method="POST">
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
								<label for="nome">Nome:<span class="requerido">*</span></label>
								<input type="nome" name="nome" class="form-control" id="nome" value="">
							</div>
							<div class="col">
								<label for="depto_id">Departamento</label>
								<select class="form-control" name="depto_id">
									<?php
									foreach ($departamentos as $dept) {
										echo "<option value='" . $dept->getId() . "'>" . $dept->getNome() . "</option>";
									}
									?>
								</select>
							</div>
                            <div class="col">
								<label for="user_resp">Responsável</label>
								<select class="form-control" name="user_resp">
									<?php
									foreach ($funcionarios as $func) {
										echo "<option value='" . $func->getId() . "'>" . $func->getNome() . "</option>";
									}
									?>
								</select>
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
	header('Location: exibeProjeto');
}
?>
<!-- fim footer -->
<script>
	$(document).ready(function() {
		$('.cadastrarProjetos').addClass('active');
	});
</script>