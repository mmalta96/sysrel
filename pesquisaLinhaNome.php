

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

				* {
		    box-sizing: border-box;
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
  		<form action="pesquisaLinhaNome.php" method="POST">
  		  <?php 
		    if (isset($_SESSION["ALERT"])){
		      echo'<div class="alert alert-success alert-dismissible"> 
		        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		          '.$_SESSION["ALERT"].'
		      </div>';
		      unset($_SESSION['ALERT']);
		    }
		  ?>

		  <h3>Pesquisa de Linha de Pesquisa por Nome:</h3>

		  <h4>Digite o nome:</h4>

		  <input type="text" class="text" name="nome">

		  <input type="submit" name="btn"  class="btn btn-success" value="Pesquisar">
		 
		 <?php 
		 	if (isset($_POST["nome"])){
		 		echo '<table class="table table-striped">
		     <thead>
		       <tr>
		         <th>Nome</th>
		         <th>Opções</th> 
		       </tr>
		     </thead>
		     ';

		     include 'abreConexao.php';

		       $idGrupo = $_SESSION['idGrupoAtual'];


		
		       //sql que pega todas as linhas de pesquisA
		       $sql = "SELECT ID, NOME FROM tb_linha_pesquisa WHERE NOME LIKE '%".$_POST["nome"]."%'";
		        //executo o comando e guardo em uma variavel o resultado
		       $result = $conexao->query($sql);
		        //alimenta a tabela com as linhas de pesquisa do grupo  

		       $aux = 0;
		       while($row = $result->fetch_assoc()) {
		       	$aux = 1;
		         echo('<tr>');
		         //mostra nome da linha em uma coluna
		         echo('<td value="'.$row["ID"].'">'.$row["NOME"].'</td>');

		         echo('<td><input type="button" class="btn btn-info" value ="Selecionar" data-id="'.$row["ID"].'" id="btnDesvincular" onclick="vincula(this);" data-toggle="modal" data-target="#modalVincular"></td>');

		         

		      
		        echo('</tr>');


		        }
		        include 'fechaConexao.php'; 

		        if ($aux == 0) {
					echo('<tr>');
					echo('<td name="nulo" value="0">Sem Registros</td>');
		  		}

		  		echo "</table>";
			}


		  ?>
		    
		    
		</form>

		<script type="text/javascript">


			function vincula(btn) {
		        var info = $(btn).attr('data-id');
		        var str = info.split('|');
		        var meuid = str[0];
		        $(".modal-body #idLinha").val(meuid);
		    };

		</script>



		<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>


<!-- Modal -->
<div id="modalVincular" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Vincular Linha de Pesquisa:</h4>
      </div>
      <div class="modal-body">
      	<form action="vinculalinhagruposql.php" method="POST">
	        <h4>Data</h4>
	        <input type="date" name="dataInicio" required="true" requiredMessage="Preencha este campo">
	        <br>
	        <h4>Descrição</h4>
			<input type="textarea" name="txtDescricao" required="true" requiredMessage="Preencha este campo">
	        <input type="hidden" name="idLinha" id="idLinha">
	        <input type="submit" name="btn" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>


</div>
</body>
</html>