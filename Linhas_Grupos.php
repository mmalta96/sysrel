

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
	  	<meta name="viewport" content="width=device-width, initial-scale=1.0"
	  	<link rel="icon" href="imagens/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon" />
	  	<title>Linhas de Pesquisa - SYSREL</title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	 	<link rel="stylesheet" href="css/bootstrapSkety.min.css">
	  	<script src="javascript/jquery.min.js"></script>
	  	<script src="javascript/bootstrap.min.js"></script>
	  	<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
	  	<script src="javascript/bootstrap-toggle.min.js"></script>
	  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style>

		#login {cursor: pointer;}




		.active a{
		    width: 310%;
		    background-color : green !important;
		}



		    footer {
		      background-color: #555;
		      color: white;
		      padding: 15px;
		    }

		    button[type=submit] {
		   
		    padding: 10px 100px;
		    margin: 8px 0;
		   

		}

		#FT
		{
		        -webkit-transform: scale(0.8);
		        -ms-transform: scale(0.8);
		        transform: scale(0.8);
		}



		/* Full-width input fields */
		input[type=text], input[type=password] {
		    width: 60%;
		    padding: 12px 20px;
		    margin: 8px 0;
		    display: inline-block;
		    border: 1px solid #ccc;
		    box-sizing: border-box;
		}

		/* Set a style for all buttons */


		button:hover {
		    opacity: 0.8;
		}

		/* Extra styles for the cancel button */
		.cancelbtn {
		    width: auto;
		    padding: 10px 18px;
		    background-color: #f44336;
		}

		/* Center the image and position the close button */
		.imgcontainer {
		    text-align: center;
		    margin: 24px 0 12px 0;
		    position: relative;
		}

		img.avatar {
		    width: 40%;
		    border-radius: 50%;
		}

		.container {
		    padding: 16px;
		}

		span.psw {
		    float: right;
		    padding-top: 16px;
		}

		/* The Modal (background) */
		.modal {
		    display: none; /* Hidden by default */
		    position: fixed; /* Stay in place */
		    z-index: 1; /* Sit on top */
		    left: 0;
		    top: 0;
		    width: 100%; /* Full width */
		    height: 100%; /* Full height */
		    overflow: auto; /* Enable scroll if needed */
		    background-color: rgb(0,0,0); /* Fallback color */
		    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
		    padding-top: 10px;
		}

		/* Modal Content/Box */
		.modal-content {
		    background-color: #fefefe;
		    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
		    border: 1px solid #888;
		    width: 70%; /* Could be more or less, depending on screen size */
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

		@-webkit-keyframes animatezoom {
		    from {-webkit-transform: scale(0)} 
		    to {-webkit-transform: scale(1)}
		}
		    
		@keyframes animatezoom {
		    from {transform: scale(0)} 
		    to {transform: scale(1)}
		}

		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
		    span.psw {
		       display: block;
		       float: none;
		    }
		    .cancelbtn {
		       width: 100%;
		    }
		}
		p { font-family: Trebuchet MS, sans-serif; }


		</style>
		<script type="text/javascript">
		    function apagaLinha(idLinha, idGrupo){  
		        window.location.replace("apagarLinha.php?idLinha=" + idLinha + "&idGrupo = " + idGrupo);
		    };
		</script>
	</head>
<body> 

	<!-- Navbar (sit on top) -->
	<?php
	include 'MenuNavBar.php';
	?>
	<!-- FIM DO NAV BAR -->

	<!-- Header -->
	<br><br><br>
	<header class="w3-display-container w3-content w3-wide" style="max-width:1700px;min-width:300px" id="home">
 	<br><br>
	</header>
	<!-- FIM DO nav -->
	<div class="row">
		
  	<div class="container">

  		<div class="col-sm-2"></div>

  		<div class="col-sm-8">

  		<form method="post" action="vinculalinhagrupo.php">
  		  <?php 
		    if (isset($_SESSION["ALERT"])){
		      echo'<div class="alert alert-success alert-dismissible"> 
		        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		          '.$_SESSION["ALERT"].'
		      </div>';
		      unset($_SESSION['ALERT']);
		    }
		  ?>

		  <h1>Pesquisa de Linhas de Pesquisa:</h3>

		  <?php 

	        	include 'abreConexao.php';

	        	//preenche lista com as categorias
	        	$sql = "SELECT SUBSTRING(lp.ID, 1, 7) as ID, lp.NOME FROM tb_linha_pesquisa lp where SUBSTRING(lp.ID, 2, 6)= '000000'";

				$result = $conexao->query($sql);
			    //alimenta a tabela com as linhas de pesquisa do grupo  
			    echo '<h6>Selecione uma Categoria</h6>';
				echo '<select  id="cbCat" onchange="pegaCategoria()" class="form-control">';
				echo '<option  value="0">Selecione...</option>';
			    while($row = $result->fetch_assoc()) {
			     	echo '<option value="'.$row["ID"].'">'.$row["NOME"].'</option>';
			    }
			    echo "</select>";

			    if (isset($_GET["cat"])){
			    	$idCategoria = $_GET["cat"];

			    	$idCategoria = substr($idCategoria, 0,1);

			    	echo '<script>
			    		var v = "'.$idCategoria.'000000";
			    		var c = document.getElementById("cbCat");
			    		var i = 0;
			    		for (i; i< c.options.length; i++)
						{	
							if (c.options[i].value == v)
								{
									c.options[i].selected = true;
								break;
							}
					}</script>';

			    	$sql = "SELECT lp.NOME, SUBSTRING(lp.ID, 1, 7) as ID FROM tb_linha_pesquisa lp where SUBSTRING(lp.ID, 2, 6) != '000000' and SUBSTRING(lp.ID, 4, 4) = '0000' and SUBSTRING(lp.ID, 1, 1) = $idCategoria";

			    	$result = $conexao->query($sql);
					    //alimenta a tabela com as linhas de pesquisa do grupo
					    echo '<h6>Selecione uma Subcategoria</h6>';  
						echo '<select id="cbSubCat" onchange="pegasubCategoria('.$idCategoria.')" class="form-control">';

						echo '<option  value="0">Selecione...</option>';
					    while($row = $result->fetch_assoc()) {
					     	echo '<option  value="'.$row["ID"].'">'.$row["NOME"].'</option>';
					    }
					    echo "</select>";

					
						
				}

				if (isset($_GET["subcat"])){
			    	$idsubCategoria = $_GET["subcat"];


			    	$idsubCategoria = substr($idsubCategoria, 0,2);


			    	echo '<script>
			    		var v = "'.$idCategoria.$idsubCategoria.'0000";
			    		var c = document.getElementById("cbSubCat");
			    		var i = 0;
			    		for (i; i< c.options.length; i++)
						{	
							if (c.options[i].value == v)
								{
									c.options[i].selected = true;
								break;
							}
					}</script>';

			    	$sql = "SELECT lp.NOME, SUBSTRING(lp.ID, 1, 7) as ID FROM tb_linha_pesquisa lp where SUBSTRING(lp.ID, 2, 6) != '000000' and SUBSTRING(lp.ID, 4, 4) != '0000' and SUBSTRING(lp.ID, 1, 1) = $idCategoria and SUBSTRING(lp.ID, 2, 2) = $idsubCategoria and SUBSTRING(lp.ID, 6, 2) = 00 ";

			    	$result = $conexao->query($sql);
					    //alimenta a tabela com as linhas de pesquisa do grupo
					    echo '<h6>Selecione uma segunda Subcategoria</h6>';  
						echo '<select id="cbSubCat2" 
						onchange="pegasubCategoria2('.$idCategoria.',String('.$idsubCategoria.'))"
						class="form-control">';
						echo '<option  value="0">Selecione...</option>';
					    while($row = $result->fetch_assoc()) {
					     	echo '<option  value="'.$row["ID"].'">'.$row["NOME"].'</option>';
					    }
					    echo "</select>";
						
				}

				if (isset($_GET["subcat2"])){
			    	$idsubCategoria2 = $_GET["subcat2"];

			    	$idsubCategoria2 = substr($idsubCategoria2, 0,2);

			    	echo '<script>
			    		var v = "'.$idCategoria.$idsubCategoria.$idsubCategoria2.'00";
			    		var c = document.getElementById("cbSubCat2");
			    		var i = 0;
			    		for (i; i< c.options.length; i++)
						{	
							if (c.options[i].value == v)
								{
									c.options[i].selected = true;
								break;
							}
					}</script>';

			    	$sql = "SELECT lp.NOME, SUBSTRING(lp.ID, 1, 7) as ID FROM tb_linha_pesquisa lp where SUBSTRING(lp.ID, 2, 6) != '000000' and SUBSTRING(lp.ID, 4, 4) != '0000' and SUBSTRING(lp.ID, 1, 1) = $idCategoria and SUBSTRING(lp.ID, 2, 2) = $idsubCategoria and SUBSTRING(lp.ID, 4, 2) = $idsubCategoria2 and SUBSTRING(lp.ID, 6, 2) != 00";

			    	$result = $conexao->query($sql);
					    //alimenta a tabela com as linhas de pesquisa do grupo
					    echo '<h6>Selecione uma linha de Pesquisa</h6>';  
						echo '<select id="cbLinha" class="form-control">';
						echo '<option  value="0">Selecione...</option>';
					    while($row = $result->fetch_assoc()) {
					     	echo '<option  value="'.$row["ID"].'">'.$row["NOME"].'</option>';
					    }
					    echo '</select> <br><br><input type="button" onclick="verificaLinhaSelecionada();" class="btn btn-sucess" value="Selecionar" name="btnCat">';
						
				}

		  ?> 	

		  
		  </div>

		  <script>
		  	function verificaLinhaSelecionada() { 
				var idCat = document.getElementById("cbLinha");
				var itemSelecionado = idCat.options[idCat.selectedIndex].value;
				if (itemSelecionado != 0){
					document.location=('vinculalinhagrupo.php?idLinha=' + itemSelecionado); 
				}

		    	
		 	}
			function pegaCategoria() { 
				var idCat = document.getElementById("cbCat");
				var itemSelecionado = idCat.options[idCat.selectedIndex].value;
				if (!itemSelecionado == 0){
					itemSelecionado = itemSelecionado.substr(0,1);
					document.location=('Linhas_Grupos.php?cat=' + itemSelecionado); 
				}
		    	
		 	}
		 	function pegasubCategoria(cat) { 
				var idCat = document.getElementById("cbSubCat");
				var itemSelecionado = idCat.options[idCat.selectedIndex].value;
				
				itemSelecionado = itemSelecionado.substr(2,1);

				if (!itemSelecionado == 0){
					if (itemSelecionado < 10) {

						itemSelecionado = "0" + itemSelecionado;

					}
					

			    	document.location=('Linhas_Grupos.php?cat=' + cat + "&subcat=" + String(itemSelecionado)); 
		   		}
		 	}
		 	function pegasubCategoria2(cat, subcat) { 
				var idCat = document.getElementById("cbSubCat2");
				var itemSelecionado = idCat.options[idCat.selectedIndex].value;
				itemSelecionado = itemSelecionado.substr(3,2);

				var x = subcat;

				if (!itemSelecionado == 0){
					if (subcat < 10) {
					x = "0"+String(subcat);
					}
			    	document.location=('Linhas_Grupos.php?cat=' + cat + "&subcat=" +String(x)+ "&subcat2="+String(itemSelecionado));
				}

				
		 	}

		 	
		  </script>

		  <div class="col-sm-2"></div>

   
</div>

</body>
</html>