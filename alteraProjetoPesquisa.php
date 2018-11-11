
<?php  
	session_start();
	if (isset($_SESSION['ID_USUARIO'])){
	}
	else{
		header("location:index.php");
	}

	

?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="imagens/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon" />
<title>SYSREL</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/bootstrapSkety.min.css">
<script src="javascript/jquery.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="javascript/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
	body {
    font-family: Arial, Helvetica, sans-serif;
 
}

* {
    box-sizing: border-box;
}

/* Add padding to containers */
.container {
    padding: 16px;
    background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email], input[type=date], input[type=url] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #9898a0;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #5b5b5e;
    outline: none;
}

button:hover {
    opacity: 0.8;
}


/* Overwrite default styles of hr */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}



/* Set a style for the submit button */
.registerbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

.registerbtn:hover {
    opacity: 1;
}

/* Add a blue text color to links */
a {
    color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
    background-color: #f1f1f1;
    text-align: center;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 90%; /* Could be more or less, depending on screen size */

}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 10px;

}

.container {
    padding: 16px;
    background-color: #f2f2f2;
}


#myBtn {
    width: 300px;
    padding: 10px;
    font-size:20px;
    position: absolute;
    margin: 0 auto;
    right: 0;
    left: 0;
    bottom: 50px;
    z-index: 9999;
}
</style>

<script>
	function pegaLP() {

				$("#selectLinha").empty();

				var idDocente = document.getElementById("cbDocente");

				var itemSelecionado = idDocente.options[idDocente.selectedIndex].value;

				if (itemSelecionado != 0 && idDocente.options[idDocente.selectedIndex].index > 0) {
					var url = 'pegaLinhasDocente.php';
					$.ajax({
						type: 'POST',
						url: url,
						data: 'id=' + itemSelecionado,

						success: function(response) {
							response = '<option value="0">Selecione...</option>' + response;

							document.getElementById("selectLinha").innerHTML += response;
						}
					});
				}
		
			}
	
		function outroTipo() {
				var tipo = document.getElementById("cbTipo");

				var itemSelecionado = tipo.options[tipo.selectedIndex].value;

				if (itemSelecionado == "Outras") {

					document.getElementById("divOutroTipo").innerHTML = '<h4 id="lblTipo">Digite o tipo:</h4><input type="text" id="txtTipo" name="txtTipo" class="text"><br>';

				} else {
					document.getElementById("lblTipo").remove();
					document.getElementById("txtTipo").remove();
					
				}
			}
		
</script>

<body>
	<!-- Navbar (sit on top) -->
	<?php
		include 'MenuNavBar.php';
	?>
	<!-- FIM DO NAV BAR -->
	<br><br><br><br><br>

	<div class="container" id="container">
	
	
		<h2>Alterar Projeto de Pesquisa</h2>


		<form action="alteraProjetoPesquisaSQL.php" id="formCadastro" name="formCadastro" method="GET">
							
							<?php
								include 'abreConexao.php';
								$id = $_GET["id"];
								echo '<input type="hidden" name="id" value="'.$id.'">';
							?>

							<br><br>
							<h4>Título</h4>
							<?php
								$sql = "SELECT TITULO FROM tb_projeto_pesquisa WHERE ID=".$id;
									
										$result = $conexao->query($sql);

										$linha = 0;
										if ($row = $result->fetch_assoc()) {
											echo '<input type="text" class="text" value="'.$row["TITULO"].'" name="txtTitulo" id="txtTitulo" required>';
										}
							?>
							

							<h4>Docente Responsável</h4>
							<SELECT name="cbDocente" id="cbDocente" class="form-control" onchange="pegaLP()">
								<option value="0">Selecione...</option>
								
								<?php
									
									$id = $_GET["id"];
									$sql = "SELECT ID_DOCENTE_FK FROM tb_projeto_pesquisa WHERE ID=".$id;
								
									$result = $conexao->query($sql);
								
									$docente = 0;
									if ($row = $result->fetch_assoc()) {
										$docente = $row["ID_DOCENTE_FK"];
									}
									
								
									$sql = "SELECT d.ID, d.NOME FROM tb_docente_grupo dg inner join tb_docentes d on d.ID = dg.ID_DOCENTE_FK and dg.ID_GRUPO_FK = ".$_SESSION["idGrupoAtual"];
								

									$result = $conexao->query($sql);
								
									while($row = $result->fetch_assoc()) {
										if ($row["ID"] == $docente) {
											echo '<option value="'.$row["ID"].'" selected="selected">'.$row["NOME"].'</option>';
										}
										else {
											echo '<option value="'.$row["ID"].'">'.$row["NOME"].'</option>';
										}
										
									}
								 echo'
								</SELECT>
						
							<br>

							<h4>Linha de Pesquisa</h4>
							<select name="cbLinhaPesquisa" id="selectLinha" class="form-control">
								<option value="0">Selecione...</option>';
								
										$sql = "SELECT ID_LINHA_FK FROM tb_projeto_pesquisa WHERE ID=".$id;
									
										$result = $conexao->query($sql);

										$linha = 0;
										if ($row = $result->fetch_assoc()) {
											$linha = $row["ID_LINHA_FK"];
										}
									
										$sql = "SELECT lp.ID, lp.NOME FROM tb_linha_pesquisa lp inner join tb_docente_linha dl on dl.ID_LINHA_PESQUISA_FK = lp.ID and dl.ID_DOCENTE_FK = ".$docente." and dl.ID_GRUPO_FK = ".$_SESSION["idGrupoAtual"];
								

									$result = $conexao->query($sql);
								
									while($row = $result->fetch_assoc()) {
										if ($row["ID"] == $linha) {
											echo '<option value="'.$row["ID"].'" selected="selected">'.$row["NOME"].'</option>';
										}
										else {
											echo '<option value="'.$row["ID"].'">'.$row["NOME"].'</option>';
										}
										
									}
									
									?>
							</select>
							<br>

							<h4>Tipo</h4>
							<select name="cbTipo" id="cbTipo" class="form-control" onchange="outroTipo()">
								<option value="0">Selecione...</option>
								<?php
										$sql = "SELECT TIPO, DATE_FORMAT(DATA_INICIO,'%Y-%m-%d') AS DATA_INICIO, DATE_FORMAT(DATA_TERMINO,'%Y-%m-%d') AS DATA_TERMINO FROM tb_projeto_pesquisa WHERE ID=".$id;
									
										$result = $conexao->query($sql);
								
										$datainicio = "";
										$datatermino = "";
								

										$tipo= 0;
										if ($row = $result->fetch_assoc()) {
											$tipo = $row["TIPO"];
											$datainicio = $row["DATA_INICIO"];
											$datatermino = $row["DATA_TERMINO"];
										}
								
										if ($tipo == "PIBIFSP") {
											echo '<option value="PIBIFSP" selected="selected">PIBIFSP</option>';
										}
										else {
											echo '<option value="PIBIFSP">PIBIFSP</option>';
										}
								
										if ($tipo == "CNPQ") {
											echo '<option value="CNPQ" selected="selected">CNPQ</option>';
										}
										else {
											echo '<option value="CNPQ">CNPQ</option>';
										}
								
										if ($tipo != "PIBIFSP" && $tipo != "CNPQ"){
											echo '<option value="Outras" selected="selected">Outras</option>';
										}
										else {
											echo '<option value="Outras">Outras</option>';
										}
										
										
								
								?>
							</select>

							<div id="divOutroTipo"></div>
								<?php
									if ($tipo != "PIBIFSP" && $tipo != "CNPQ"){
											echo '<h4 id="lblTipo">Digite o tipo:</h4><input type="text" name="txtTipo" id="txtTipo" value="'.$tipo.'" class="text"><br>';
										}
							
								?>
						
							<br>

							<h4>Data de Início</h4>
								<?php
									echo '<input type="date" name="dataInicio" value="'.$datainicio.'" id="dataInicio" class="date" required>';
								?>
							
							<br>

							<h4>Data de Fim</h4>
							<?php
									echo '<input type="date" name="dataFim" value="'.$datatermino.'" id="dataTermino" class="date">';
								?>

							<input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-success" value="Alterar">

							<div id="divsubmit"></div>

						</form>
	</div>
	

		<br><br><br><br><br><br>
		<footer class="w3-center w3-light-grey w3-padding-32">
			<p>Desenvolvedores : Emerson Castro | Carlos Moura | Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
		</footer>
</body>

</html>
