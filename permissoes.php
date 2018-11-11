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
  <meta name="viewport" content="width=device-width, initial-scale=1.0"
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
					<h2> Permissões de Usuário</h2>
					<br>
					<form action="salvaPermissoes.php" method="POST" >
						<table class="table table-striped" >
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

						<div class="col-sm-3">
						</div>
						<div class="col-sm-4">
							<button type="submit" class="btn btn-success"  name="btnSalvar">Salvar Alterações</button>
						</div>
						<div class="col-sm-5">
						</div>

						
						
						<br><br>
					</form>	  	
				</div>

				</div>
				<div class="col-sm-2"></div>
			</div>
			
		<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>


		</body>
		</html>