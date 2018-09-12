<?php  
session_start();



if (!isset($_SESSION['ID_USUARIO'])){
	header("location:index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>SYSREL</title>
<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
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
	<?php 
		if (isset($_SESSION["ALERT"])){
			echo'<div class="alert alert-success alert-dismissible"> 
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  		'.$_SESSION["ALERT"].'
			</div>';

			unset($_SESSION['ALERT']);
		}
	?>

	<img src="\imagens\IFSP.png"> 
</body>
</html>