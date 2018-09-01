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
			     	<li><a href="VerificaPrimeiroAcesso"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
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
		if (isset($_SESSION["ALERT"])){
			echo'<div class="alert alert-success alert-dismissible"> 
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  		'.$_SESSION["ALERT"].'
			</div>';

			unset($_SESSION['ALERT']);
		}
	?>
	<img src="IFSP.png"> 
</body>
</html>