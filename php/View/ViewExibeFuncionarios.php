<?php
$titulo="Exibir Funcionários";
include $_SESSION["root"].'includes/header.php';
?>
<body>
	<div class="container" >
		<!-- add no menu -->
		<?php include $_SESSION["root"].'includes/menu.php';?>
		<!-- fim menu -->	
		<div id="principal">
			<h1 class="text-center">Funcionários</h1>
			<table class="table table-striped">
			<?php 
				//$funcionarios foi criado no controller que chamou essa classe;
				echo "<tr>";
					echo "<th>Nome</th>";
					echo "<th>Salário</th>";
					echo "<th scope='col'>Permissão</th>";
					echo "<th scope='col'>Departamento</th>";
					echo "<th scope='col'>Ação</th>";
				echo "</tr>";
				foreach ($funcionarios as $value) {
					foreach($departamentos as $dept){ 
						if($dept->getId() == $value->getDepartamento()) { $departamento = $dept->getNome();}
					}
					echo "<tr>";
						echo "<td>".$value->getNome()."</td>";
						echo "<td>".$value->getSalario()."</td>";
						echo "<td>".$value->getPermissao()."</td>";
						echo "<td>". $departamento ."</td>";
						echo "<td>
								<button type='button' class='btn btn-primary' onClick={edita_usuario('" . $value->getLogin(). "');}>Editar</button>
								<button type='button' onClick={deleta_usuario('" . $value->getLogin() . "');} class='btn btn-danger'>Delete</button>
	      					 </td>";
					echo "</tr>";
				}
			?>
			</table>
		</div>
	</div>	
</body>
<!-- add no footer -->
<?php 
	include $_SESSION["root"].'includes/footer.php';
	if(isset($_SESSION["flash"])){
		foreach ($_SESSION["flash"] as $key => $value) {
			unset($_SESSION["flash"][$key]);	
		}
	}?>
<!-- fim footer -->
<script>		
	$(document).ready(function () {
        $('.visualizarFuncionario').addClass('active');
    });
</script>