	<?php  
	session_start();
	$id = 2;
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
<script src="javascript/moment.js"></script>
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
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
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

<body>
	<!-- Navbar (sit on top) -->
	<?php
		include 'MenuNavBar.php';
	?>
	<!-- FIM DO NAV BAR -->
	<br><br><br><br><br>

	<div class="container">

		<?php 
			$idGrupo = $_SESSION['idGrupoAtual'];

			include 'abreConexao.php';
			
			$sql = "SELECT * FROM tb_grupo_pesquisa WHERE ID = '$idGrupo';";
			$result = $conexao->query($sql);
			$row = $result->fetch_assoc();
			$sigla = $row["SIGLA"];
			$logotipo = $row["LOGOTIPO"];
            $ano = $_GET["ano"];
		?>
		<h3>Relatório de Equipamentos do Grupo no ano de <?php echo $ano; ?></h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th><h3>Equipamentos</h3></th>
                </tr>
            </thead>

            	<?php 

            	
                    $sql = "SELECT *
                    FROM tb_equipamentos E
                    WHERE E.DATA_INICIO BETWEEN '".$ano."-01-01 00:00:00' AND '".$ano."-12-31 23:59:59'
                    OR  E.DATA_TERMINO BETWEEN '".$ano."-01-01 00:00:00' AND '".$ano."-12-31 23:59:59'
                    AND E.ID_GRUPO_FK = ".$_SESSION["idGrupoAtual"];

            		$result = $conexao->query($sql);

            		$x = 1;
            		while ($row = $result->fetch_assoc()) {
            			$x = 0;
            			echo "<tr><td>";

            			echo "<h5>Nome:".$row["NOME"]."</h5>";
                        echo "Descrição:".$row["DESCRICAO"];

		                echo " </td></tr> ";

            		}



            		if ($x == 1) {
						echo "<tr><td>";

            			echo "<h5>Sem Resultados.</h5>";

		                echo " </td></tr> ";
            		}
            		

            		?>
                
        </table>

</div>
<footer class="w3-center w3-light-grey w3-padding-32">
            <p>Desenvolvedores : Emerson Castro | Carlos Moura | Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
        </footer>
</body>
</html>
