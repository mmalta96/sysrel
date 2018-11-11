<html>

<head>
	<?php

	$sigla = filter_input(INPUT_SERVER, 'REQUEST_URI');
   	
	$sigla = substr ( $sigla , 1) ;

	include 'abreConexao.php';
	
	$sql = "SELECT * FROM tb_grupo_pesquisa WHERE SIGLA = '$sigla'";

	$consulta = $conexao->query($sql);
	$row = $consulta->fetch_assoc();
	
	if (empty($row))
	{
		header("location:404.html");
	}

	echo "<title>".$row["SIGLA"]." - ".$row["NOME"]." - SYSREL"."</title>";
	
?>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0"
  <link rel="icon" href="imagens/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="css/bootstrapSkety.min.css">
  <script src="javascript/jquery.min.js"></script>
  <script src="javascript/bootstrap.min.js"></script>
  <link href="css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="javascript/bootstrap-toggle.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    button {
    background-color: green;
    color: white;
    padding: 10px 10px;
    margin: 8px 0;
    border: none;
    cursor: pointer;

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


</head>

<body>

 <!-- Navbar (sit on top) -->
  <?php
  include 'MenuNavBarZero.php';
  ?>
<!-- FIM DO NAV BAR -->
<br><br><br><br>

	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-2 sidenav">
				
			</div>

			<div class="col-sm-8">
				<h1>Detalhes do Grupo de Pesquisa</h1>
				<?php 

					include 'abreConexao.php';


					$sigla = filter_input(INPUT_SERVER, 'REQUEST_URI');

					$sigla = substr ( $sigla , 1) ;

					$sql = "SELECT NOME,LOGOTIPO,DESCRICAO,SIGLA,LINK_DGP,DATE_FORMAT(DATA_INICIO, '%d/%m/%Y') DATA_INICIO FROM `tb_grupo_pesquisa` WHERE SIGLA='$sigla'";

					$resultado =  $conexao->query($sql);

					$nomeGrupo;
					$Descricao;
					$Foto;
					$Sigla;

						while($row = $resultado->fetch_assoc()){
							$nomeGrupo = $row["NOME"];
							$Foto = $row["LOGOTIPO"];
							$Descricao = $row["DESCRICAO"];
							$Sigla = $row["SIGLA"];
							$dataInicio= $row["DATA_INICIO"];
							$DPG = $row["LINK_DGP"];
							$Descricao = str_replace("\n", "<br>", $Descricao);
				?>
				<form>
					<hr>
					<div class="card border-light mb-3" style="max-width: 100rem;">
						<div class="card-header">
							<?php
						  		echo '<h3><img src="fotos/'.$Foto.'" class="img-thumbnail" alt="Logotipo" height="150" width="150">          '.$nomeGrupo.' ( '.$Sigla.' )</h3>'
							?>
						</div>
						<div class="card-body">
							<p class="card-text">
								<?php
						  			echo '<p>'.$Descricao.'</p>';
									echo "Início em ".$dataInicio."<br><br>	";
									echo '<a style="color:steelblue" href='.$DPG.'>DGP: '.$DPG.'<br><br></a>';
							
									$sql = "SELECT ID FROM `tb_grupo_pesquisa` WHERE SIGLA='$sigla'";

									$resultado =  $conexao->query($sql);

									$row = $resultado->fetch_assoc();
							
									$idGrupo = $row["ID"];
							
							
									$sql = "SELECT L.NOME
									FROM TB_LIDER_PESQUISA L
									INNER JOIN TB_GRUPO_LIDER G
									ON L.ID = G.ID_LIDER_FK
									AND G.ID_GRUPO_FK = $idGrupo
									AND DATA_INICIO = (
										SELECT MAX(GR.DATA_INICIO)
										FROM TB_GRUPO_LIDER GR
										WHERE GR.ID_GRUPO_FK = $idGrupo
									)";

									$resultado =  $conexao->query($sql);
							
									$row = $resultado->fetch_assoc();
							
									echo "O líder do grupo é o ".$row["NOME"].".<br>";

						  		?>						
						</div>
						<div class="card-header">
							<h4>Linhas de Pesquisa do Grupo:</h4>

							<?php 
								$sql = "SELECT lp.ID, lp.NOME, lg.DESCRICAO, DATE_FORMAT(lg.DATA_INICIO, '%d/%m/%Y') DATA_INICIO FROM tb_linha_grupo LG inner join tb_linha_pesquisa LP on lg.ID_LINHA = lp.ID and lg.DATA_TERMINO is null";

								$result = $conexao->query($sql);

								while($row = $result->fetch_assoc()) {
									echo $row["ID"]." - ".$row["NOME"]."<br>";
									echo "Descrição: ".$row["DESCRICAO"]."<br>";
									echo "Início em ".$row["DATA_INICIO"]."<br><br>";
								}

							 ?>
						</div>
						<br><br><br>
						<div class="card-header">
							<h4>Técnicos do grupo:</h4>

							<?php 
								$sql = "
                    			SELECT t.NOME, t.DESCRICAO_FORMACAO, tg.DATA_INICIO, t.ID, tg.DATA_TERMINO, tg.DATA_TERMINO, tt.NOME as GRADUACAO, t.FOTO, t.ATIVIDADE_REALIZADA, if(DATE_FORMAT(tg.DATA_CADASTRO,'%d/%m/%Y')=DATE_FORMAT(NOW(),'%d/%m/%Y'),1,0) AS EXCLUIR
                    			FROM tb_tecnico t
                    				inner join tb_tecnico_grupo tg
                   					 on t.ID = tg.ID_TECNICO_FK
                   					 inner join tb_titulacao tt 
                   					 on t.TITULACAO_FK = tt.ID
                    			AND tg.ID_GRUPO_FK = '$idGrupo'
								and tg.DATA_TERMINO is null
                    			;";

								$result = $conexao->query($sql);

								while($row = $result->fetch_assoc()) {
									$fotoselecionada = $row["FOTO"];
									$foto = "\\"."fotos"."\\".$fotoselecionada;
									$dataTerminoCerta = date('d/m/Y', strtotime($row["DATA_INICIO"]));

									echo '<img src="'.$foto.'" class="img-circle" width="100px" height="100px" alt="..."id="image"  ><br><br>'; 

									echo "Nome: ".$row["NOME"]."<br>";
									echo "Atividade no grupo: ".$row["ATIVIDADE_REALIZADA"]."<br>";
									echo "Graduação: ".$row["GRADUACAO"]."<br>";
									echo "Início em ".$dataTerminoCerta."<br><br>";

								}

							 ?>
						</div>
					</div>
					<br><br>
				
									<div class="card-header">
							<h4>Docentes do Grupo:</h4>

							<?php 
							
								$sql = "
                    			SELECT t.NOME, tg.DATA_INICIO, t.ID, tg.DATA_TERMINO, tg.DATA_TERMINO, tt.NOME as GRADUACAO, t.FOTO,  if(DATE_FORMAT(tg.DATA_CADASTRO,'%d/%m/%Y')=DATE_FORMAT(NOW(),'%d/%m/%Y'),1,0) AS EXCLUIR
                    				FROM tb_docentes t
                    				inner join tb_docente_grupo tg
                   					 on t.ID = tg.ID_DOCENTE_FK
                   					 inner join tb_titulacao tt 
                   					 on t.ID_TITULACAO_FK = tt.ID
                    			AND tg.ID_GRUPO_FK =  '$idGrupo'
								and tg.DATA_TERMINO is null
                    			;";

								$result = $conexao->query($sql);

								while($row = $result->fetch_assoc()) {
									$fotoselecionada = $row["FOTO"];
									$foto = "\\"."fotos"."\\".$fotoselecionada;
									$dataTerminoCerta = date('d/m/Y', strtotime($row["DATA_INICIO"]));

									echo '<img src="'.$foto.'" class="img-circle" width="100px" height="100px" alt="..."id="image"  ><br><br>'; 

									echo "Nome: ".$row["NOME"]."<br>";
									echo "Graduação: ".$row["GRADUACAO"]."<br>";
									echo "Início em ".$dataTerminoCerta."<br><br>";



									$idDocente = $row["ID"];
									echo '<h4> Linhas de Pesquisa </h4>';
										$sql = "
                    			SELECT TL.NOMe FROM tb_docente_linha dl

								INNER JOIN tb_linha_pesquisa TL
								on TL.ID = DL.ID_LINHA_PESQUISA_FK
								AND dl.ID_DOCENTE_FK = '$idDocente'
                    			;";

								$resultoo = $conexao->query($sql);

								while($row = $resultoo->fetch_assoc()) {
									echo $row["NOMe"]."<br>";
								}


									echo '<hr> ';
								}

							 ?>
						</div>

						<br><br><br>

						<h4>Projetos de Pesquisa do Grupo:</h4>
						
							

							<?php 
								$sql = "SELECT pp.ID, pp.TITULO, pp.TIPO, lp.NOME AS LINHA, d.NOME AS DOCENTE FROM tb_projeto_pesquisa pp INNER JOIN tb_linha_pesquisa lp ON lp.ID = pp.ID_LINHA_FK INNER JOIN tb_docentes d ON D.ID = PP.ID_DOCENTE_FK AND pp.ID_GRUPO_FK = ".$idGrupo;

								$result = $conexao->query($sql);

								while($row = $result->fetch_assoc()) {
									echo "<div class='card-header'>";
									echo $row["TITULO"]."<br>";
									echo "Tipo: ".$row["TIPO"]."<br>";
									echo "Docente Responsável: ".$row["DOCENTE"]."<br>";
									echo "Linha de Pesquisa: ".$row["LINHA"]."<br>";

									$sql = "SELECT * FROM tb_orientacao o INNER JOIN tb_discente d on d.ID = o.ID_DISCENTE_FK AND o.ID_PROJETO_FK = ".$row["ID"];

									$resultado = $conexao->query($sql);

									echo "";
									echo "Discentes do Projeto:";

									$x = 1;
									while($linha = $resultado->fetch_assoc()) {
										echo "\t".$linha["NOME"]."-".$linha["CURSO"]."<br>";
										$x = 0;
									}
									if ($x == 1){
										echo "\tSem Discente.";
									}

									echo "<br><br>";
									echo "Publicações do Projeto:";

									$sql = "SELECT P.REFERENCIAS FROM tb_publicacao P WHERE P.ID_PROJETO_FK = ".$row["ID"];

									$resultado = $conexao->query($sql);

									$x = 1;
									while($linha = $resultado->fetch_assoc()) {
										echo "\t<h5>".$linha["REFERENCIAS"]."<h5>";
										$x = 0;
									}
									if ($x == 1){
										echo "\tSem Publicações.";
									}
									
									
									echo'</div>';

								}

							 ?>
							
							
				

							<br><br>											
							<h4>Publicações Não Ligadas a Projetos :</h4>

							<?php 
							
								$sql = "
                				 SELECT TP.TITULO,
                    			 TP.TIPO,
                    			  DATE_FORMAT(TP.DATA_PUBLICACAO,'%d/%m/%Y') AS DATA_PUBLICACAO,
                    			   TP.REFERENCIAS,
                    			    TL.NOME AS LINHA,
                    			     TD.NOME AS DOCENTE,
                    			      TPP.TITULO AS PROJETO

								from tb_publicacao TP

								LEFT JOIN tb_linha_pesquisa TL
								ON TL.ID = TP.ID_LINHA_FK

								LEFT JOIN tb_docentes TD
								ON TD.ID = TP.ID_DOCENTE_FK

								LEFT JOIN tb_projeto_pesquisa TPP
								ON TPP.ID = TP.ID_PROJETO_FK
                                
                                INNER JOIN tb_grupo_pesquisa TG
                                ON TG.ID = TP.ID_GRUPO_FK

								AND TP.ID_GRUPO_FK = '$idGrupo'
								AND TP.ID_PROJETO_FK = 0
								order by date(TP.DATA_PUBLICACAO) asc
                    			;";

								$result = $conexao->query($sql);

								

								while($row = $result->fetch_assoc()) {
									echo "<div class='card-header'>";
									echo  "<h5> <strong>Referencia:  ".$row["REFERENCIAS"]." </strong></h5>";						
									echo  "<h5>Data da Publicação: ".$row["DATA_PUBLICACAO"]."<h5><br>";
									echo "</div>";
									echo '<br> ';
								}


					

							 ?>
						</div>



				<?php
					}
					include 'fechaConexao.php';
				?>

			</div>
		</div>
	</div>
		<br><br><br>
<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>

</body>

</html>
