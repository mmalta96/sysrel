

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

		    function verificaCategoria (chk) {
		    	if (chk.checked) {
		    		var id = chk.value;
		    		if (id.substr(1,6) == "000000") {
		    			var check = document.getElementsByName('chkExcluir');
					    for (var i = 0; i < check.length; i++){
					        if (check[i].value.substr(0,1) == id.substr(0,1)) {
					            check[i].checked = true;
					        }
					    }
		    		}
		    		else if (id.substr(3,4) == "0000") {
						var check = document.getElementsByName('chkExcluir');
					    for (var i = 0; i < check.length; i++){
					        if (check[i].value.substr(0,3) == id.substr(0,3)) {
					            check[i].checked = true;
					        }
					    }
		    		}
		    		else if (id.substr(5,2) == "00") {
						var check = document.getElementsByName('chkExcluir');
					    for (var i = 0; i < check.length; i++){
					        if (check[i].value.substr(0,5) == id.substr(0,5)) {
					            check[i].checked = true;
					        }
					    }
		    		}
		    	}
		    	else {
		    		var id = chk.value;
		    		if (id.substr(1,6) == "000000") {
		    			var check = document.getElementsByName('chkExcluir');
					    for (var i = 0; i < check.length; i++){
					        if (check[i].value.substr(0,1) == id.substr(0,1)) {
					            check[i].checked = false;
					        }
					    }
		    		}
		    		else if (id.substr(3,4) == "0000") {
						var check = document.getElementsByName('chkExcluir');
					    for (var i = 0; i < check.length; i++){
					        if (check[i].value.substr(0,3) == id.substr(0,3)) {
					            check[i].checked = false;
					        }
					    }
		    		}
		    		else if (id.substr(5,2) == "00") {
						var check = document.getElementsByName('chkExcluir');
					    for (var i = 0; i < check.length; i++){
					        if (check[i].value.substr(0,5) == id.substr(0,5)) {
					            check[i].checked = false;
					        }
					    }
		    		}
		    	}
		    }

		    
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

 	<?php 

 	 if (isset($_SESSION["ALERT"])){
		      echo'<div class="alert alert-success alert-dismissible"> 
		        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		          '.$_SESSION["ALERT"].'
		      </div>';
		      unset($_SESSION['ALERT']);
		    }

 	 ?>
	</header>
	<!-- FIM DO nav -->
	<div class="row">
		
  	<div class="container">
  		<form method="post">
  		 

		  <h3>Linhas de Pesquisa:</h3>

		  <br><br>
		  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Cadastrar Nova Linha</button>

		 

		  <script type="text/javascript">

		  	function pegaIdsLinhas(){

		  		
			  var check = document.getElementsByName('chkExcluir');
			  	var array = "";
			    for (var i = 0; i < check.length; i++){
			        if ( check[i].checked ) {
			            array = array + "'" + check[i].value + "',";
			        }
			    }

			    array = array.substr(0,array.length-1);

			    document.getElementById("linhas").value = array;


			   	document.getElementById("frmExcluir").submit();

			}


		  </script>
		  

		  <br><br><br>	
		 
		  <table class="table table-striped">
		     <thead>
		       <tr>
		       	 <th>[ ]</th> 
		         <th>Nome</th>
		         <th>Opção</th>
		       </tr>
		     </thead>
		      <?php 
		       include 'abreConexao.php';


		       $sql = "SELECT lp.ID, lp.NOME FROM tb_linha_pesquisa lp";
		        //executo o comando e guardo em uma variavel o resultado
		       $result = $conexao->query($sql);
		        //alimenta a tabela com as linhas de pesquisa do grupo  

		       $aux = 0;
		       while($row = $result->fetch_assoc()) {
		       	$aux = 1;
		         echo('<tr>');
		         //mostra nome da linha em uma coluna
		         echo('<td><input type="checkbox" name="chkExcluir" onclick="verificaCategoria(this)" value="'.$row["ID"].'"></td>');
		         echo('<td value="'.$row["ID"].'">'.$row["NOME"].'</td>');

		         echo('<td><input type="button" class="btn btn-info" value ="Alterar" data-id="'.$row["ID"].','.$row["NOME"].'" id="btnAlterar" onclick="altera(this);" data-toggle="modal" data-target="#modalAlterar"></td>');
		      
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

			function altera(btn) {
		        var info = $(btn).attr('data-id');
		        var str = info.split(',');
		        var meuid = str[0];
		        var nome = str[1];
		        $(".modal-body #idReg").val(meuid);
		        document.getElementById('txtlinha').value = nome;
		    };

		</script>


		<br><br>
    	
		 <button type="button" class="btn btn-info btn-lg" onclick="pegaIdsLinhas()">Excluir</button>
    





		<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Digite o Código e o nome da Linha:</h4>
      </div>
      <div class="modal-body">
      	<form action="cadastraLinhaPesquisaADMSQL.php" method="POST">
      		<label>Código:</label>
      		<input type="text" class="text" id="txtid" name="txtid">
      		<br>
      		<label>Nome:</label>
	        <input type="text" class="text" id="txtnome" name="txtnome">
	        <input type="submit" name="btn" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="modalAlterar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Digite o nomeLinha:</h4>
      </div>
      <div class="modal-body">
      	<form action="alteraLinhaPesquisa.php" method="POST">

	        <input type="text" class="text" id="txtlinha" name="nomeLinha">
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

<form id="frmExcluir" action="excluirlinhas.php" method="POST">
		  	<input type="hidden" name="linhas" id="linhas">

		</form>
</body>
</html>