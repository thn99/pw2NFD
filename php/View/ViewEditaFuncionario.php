<?php
if ($_SESSION['logado'] == true && $_SESSION['permissao'] == 1) {
	$titulo = "Editar Funcionario";
	include $_SESSION["root"] . 'includes/header.php';
	?>

	<body>
		<div class="container">
			<!-- add no menu -->
			<?php include $_SESSION["root"] . 'includes/menu.php'; ?>
			<!-- fim menu -->
			<div id="principal">
				<h1 class="text-center">Edição de Funcionário</h1>
				<form action="postEditFuncionario" method="POST">
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
								<label for="email">Login:<span class="requerido">*</span></label>
								<input type="login" name="login" class="form-control" id="login" value="<?php echo $_SESSION["edit"]["login"]; ?>">
							</div>
							<div class="form-group">
								<label for="pwd">Senha:<span class="requerido">*</span></label>
								<input type="password" name="senha" class="form-control" id="pwd" value="">
							</div>
							<div class="form-group">
								<label for="permissao">Permissão: <span class="requerido">*</span></label>
								<select name="permissao" class="form-control" id="permissao">
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
							</div>

						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="nome">Nome:<span class="requerido">*</span></label>
								<input type="text" name="nome" class="form-control" id="nome" value="<?php echo $_SESSION["edit"]["nome"]; ?>">
							</div>
							<div class="form-group">
								<label for="salario">Salario:<span class="requerido">*</span></label>
								<input type="text" name="salario" class="form-control" id="salario" value="<?php echo $_SESSION["edit"]["salario"]; ?>">
							</div>
							<div class="form-group">
								<label for="departamento">Departamento</label>
								<select class="form-control" name="departamento" id="departamento">
									<?php
									foreach ($departamentos as $dept) {
										echo "<option value='" . $dept->getId() . "'>" . $dept->getNome() . "</option>";
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class='row'>
					<!-- <div class="col-md-6 form-group">
								<label for="projeto">Projeto</label>
								<select class="form-control" name="projeto" id="projeto">
									<?php/*
									foreach ($projetos as $proj) {
										echo "<option value='" . $proj->getId() . "'>" . $proj->getNome() . "</option>";
									}*/
									?>
							</div>
						</div> -->
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
	header("Location: exibeFuncionarios");
}
?>
<!-- fim footer -->
<script>
	$(document).ready(function() {
		$('.cadastrarFuncionario').addClass('active');
	});
</script>