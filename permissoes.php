<?php  
session_start();
$id = 2;
if (isset($_SESSION['ID_USUARIO'])){
	include 'abreConexao.php';

	$sql = "SELECT *
	FROM tb_permissao_telas p
	WHERE p.ID_TELA_FK =".$id;

	if ($_SESSION['TIPO_USUARIO'] == 1){
		$sql = $sql." AND p.ADM = 1";
	}
	else if ($_SESSION['TIPO_USUARIO'] == 2){
		$sql = $sql." AND p.LIDER = 1";
	}

	$retorno = $conexao->query($sql);
	$result = $retorno->fetch_assoc();

	if (!isset($result)){
		header("location:index.php");
	}
}
else {
	header("location:index.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>SYSREL</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="javascript/jquery.min.js"></script>
	<script src="javascript/bootstrap.min.js"></script>
	<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="javascript/bootstrap-toggle.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



	<style type="text/css">
	button {
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		cursor: pointer;
		width: 100%;
	}

	button:hover {
		opacity: 0.8;
	}

</style>
</head>
<body>
	<div class="row">

		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">SYSREL</a>
				</div>
				<ul class="nav navbar-nav navbar-right">
					
					<?php 
					$usuario;
					
					if($_SESSION["TIPO_USUARIO"] == 1){
						$usuario = "Administrador";
					}else{
						$usuario = "Líder";
					}
					echo("<br>");
					echo " <font color=\"#green\"> Olá, ".$_SESSION["NOMEL"].".".$usuario."    </font>";
					
					?>
					<b><a href="Logoff.php"><span class="glyphicon glyphicon-log-out"></span> Logoff</a> </b>

				</ul>
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
								
								<?php 
	        		 // Inicia a sessão
								include 'abreConexao.php';

								$tipo_usuario = $_SESSION["TIPO_USUARIO"];


								$sql = "";

								if ($tipo_usuario == 1) {
	        			//permissoes do ADM
									$sql = "SELECT t.DESCRICAO 'nome', t.CAMINHO 'caminho' FROM tb_telas t INNER JOIN tb_permissao_telas p on t.ID = p.ID_TELA_FK and p.ADM = 1";
								}
								else if ($tipo_usuario == 2) {
	        			//permissoes do LIDER
									$sql = "SELECT t.DESCRICAO 'nome', t.CAMINHO 'caminho' FROM tb_telas t INNER JOIN tb_permissao_telas p on t.ID = p.ID_TELA_FK and p.LIDER = 1";
								}

								$result = $conexao->query($sql);

	        		//alimenta menu com telas permitidas	
								while($row = $result->fetch_assoc()) {
									echo('<li><a href="'.$row["caminho"].'">'.$row["nome"].'</a></li>');
								}

								include 'fechaConexao.php';
								
								?>
								
							</ul>
						</li>
					</ul>
				</div>
			</nav>

		</div>
		<div class="container">

			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<?php 
					if (isset($_SESSION["ALERT"])){
						echo'<div class="alert alert-success alert-dismissible"> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						'.$_SESSION["ALERT"].'
						</div>';

						unset($_SESSION['ALERT']);
					}
					?>
					<h2>Permissões de Usuário</h2>
					<br>
					<form action="salvaPermissoes.php" method="POST">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Tela</th>
									<th>Administrador</th>
									<th>Líder</th>
								</tr>
							</thead>
							<tbody>
								<?php  
								include 'abreConexao.php';

								$sql = "select t.DESCRICAO 'tela', t.id 'id', p.ADM 'adm', p.LIDER 'lider' 
								from tb_permissao_telas p
								inner join tb_telas t
								on p.ID_TELA_FK = t.ID;";

								$result = $conexao->query($sql);

		        	//alimenta menu com telas permitidas	
								while($row = $result->fetch_assoc()) {
									echo('<tr>');
		        		//mostra nome da tela em uma coluna
									echo('<td name="tela'.$row["id"].'" value="'.$row["id"].'">'.$row["tela"].'</td>');

					    //verifica se ta permitido no banco pra mostrar checkbox checado
									if ($row["adm"] == "1") {
										echo('<td><input type="checkbox" name="'.$row["id"].'ADM" checked data-toggle="toggle"></td>');
									}
									else if ($row["adm"] == "0") {
										echo('<td><input type="checkbox" name="'.$row["id"].'ADM" data-toggle="toggle"></td>');
									}

					    //verifica se ta permitido no banco pra mostrar checkbox checado
									if ($row["lider"] == "1") {
										echo('<td><input type="checkbox" name="'.$row["id"].'LIDER" checked data-toggle="toggle"></td>');
									}
									else if ($row["lider"] == "0") {
										echo('<td><input type="checkbox" name="'.$row["id"].'LIDER" data-toggle="toggle"></td>');
									}

									echo('</tr>');


								}
								include 'fechaConexao.php';	
								
								?>
							</tbody>
						</table>
						<button type="submit" class="btn btn-sucess btn-block" name="btnSalvar">Salvar Alterações</button>
					</form>	  	


				</div>
				<div class="col-sm-2"></div>
			</div>
			
			


		</body>
		</html>