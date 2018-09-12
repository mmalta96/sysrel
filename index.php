

<?php 




include 'abreConexao.php';

//VERIFICA SE Email existe
$sql = "SELECT * FROM `tb_administrador`";

$resultado =  $conexao->query($sql);
$verificador = 0;
$quantidadeDisponivel = 5;

$consulta = $conexao->query($sql);
$conta = $consulta->fetch_assoc();
if (empty($conta))
{
	//SE NÃO HOUVER ADMNISTRADORES, CHAMA PAGINA DE CADASTRO
	header("location:PrimeiroAcessoAdm.php");
} else {
	
}



include 'fechaConexao.php'
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
			     	<li><a href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			    </ul>
	        </ul>
	      </li>
	    </ul>
	  </div>
	</nav>
	
 
   <?php 

   		session_start();
   		if (isset($_SESSION["ID_USUARIO"])){
			header("location:index_logado.php");
		}

		else if (isset($_SESSION["ALERT"])){
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