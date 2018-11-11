
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
    

   		    if (isset($_SESSION["ALERT"])){
		      echo'<div class="alert alert-success alert-dismissible"> 
		        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		          '.$_SESSION["ALERT"].'
		      </div>';
		      unset($_SESSION['ALERT']);
		    }
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
  		<form method="post">
  		 

		  <h3>Linhas de Pesquisa do Grupo:</h3>
		 
		  <table class="table table-striped">
		     <thead>
		       <tr>
		         <th>Nome</th>
		         <th>Data de Início</th>
		         <th>Data Fim</th>
		         <th>Descrição</th>
		         <th>Opções</th> 
		       </tr>
		     </thead>
		      <?php 
		       include 'abreConexao.php';

		       $idGrupo = $_SESSION['idGrupoAtual'];


		       
		       //sql que pega todas as linhas de pesquisa do grupo
		       $sql = "SELECT lg.ID as ID_REG,lp.ID, if(DATE_FORMAT(lg.DATA_CADASTRO,'%d/%m/%Y')=DATE_FORMAT(NOW(),'%d/%m/%Y'),1,0) AS EXCLUIR,lp.NOME, DATE_FORMAT(lg.DATA_INICIO,'%d/%m/%Y') AS DATA_INICIO, DATE_FORMAT(lg.DATA_TERMINO,'%d/%m/%Y') AS DATA_TERMINO, lg.DESCRICAO FROM tb_linha_pesquisa lp inner join tb_linha_grupo lg on lp.ID = lg.ID_LINHA AND lg.ID_GRUPO = ".$idGrupo;
		        //executo o comando e guardo em uma variavel o resultado
		       $result = $conexao->query($sql);
		        //alimenta a tabela com as linhas de pesquisa do grupo  

		       $aux = 0;
		       while($row = $result->fetch_assoc()) {
		       	$aux = 1;
		         echo('<tr>');
		         //mostra nome da linha em uma coluna
		         echo('<td value="'.$row["ID"].'">'.$row["NOME"].'</td>');
		         echo('<td value="'.$row["DATA_INICIO"].'">'.$row["DATA_INICIO"].'</td>');
		       	 echo('<td value="'.$row["DATA_TERMINO"].'">'.$row["DATA_TERMINO"].'</td>');
		         echo('<td value="'.$row["DESCRICAO"].'">'.$row["DESCRICAO"].'</td>');


		         if ($row["DATA_TERMINO"] == "") {
		         	 echo('<td><input type="button" class="btn btn-info" value ="Desvincular" data-id="'.$row["ID_REG"].'" id="btnDesvincular" onclick="desvincula(this);" data-toggle="modal" data-target="#modalDesvincular"></td>');
		         }
		         
		          if ($row["EXCLUIR"] == 1 ) {
		         	echo('<td><input type="button" class="btn btn-danger" value ="Excluir" onclick="apagaLinha('.$row["ID_REG"].')" data-toggle="toggle"></td>');
		         }
		      
		        echo('</tr>');


		        }
		        include 'fechaConexao.php'; 

		        if ($aux == 0) {
					echo('<tr>');
					echo('<td name="nulo" value="0">Sem Registros</td>');
		  		}
		      ?>

		    

		    </table>
		    
		</form>

		<script type="text/javascript">
			function apagaLinha(id) {
				window.location.replace("apagaVinculoLinhaGrupo.php?id=" + id);
			}


			function desvincula(btn) {
		        var info = $(btn).attr('data-id');
		        var str = info.split('|');
		        var meuid = str[0];
		        $(".modal-body #idReg").val(meuid);
		    };

		</script>


		<br><br>
    	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Vincular Nova Linha</button>

    	







<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Selecione Uma Opção</h4>
      </div>
      <div class="modal-body">
      	<center>
        <button class="btn btn-success" onclick="window.location.replace('pesquisaLinhaSelect.php');">Pesquisa por Categorias</button>
 		&nbsp;
        <button class="btn btn-success" onclick="window.location.replace('pesquisaLinhaNome.php');">Pesquisa por Nome</button>
        </center>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="modalDesvincular" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Digite a data de desvinculação da linha de pesquisa:</h4>
      </div>
      <div class="modal-body">
      	<form action="desvinculaLinhaGrupo.php" method="POST">
	        <input type="date" class="date"  name="datadesvinculo">
	        <input type="hidden" name="idReg" id="idReg">
	        <input type="submit" name="btn" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>

</div>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br>
		<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>

</div>
</body>
</html>