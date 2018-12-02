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


		<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset='utf-8' />
                <link href='css/fullcalendar.min.css' rel='stylesheet' />
                <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
                <link href='css/personalizado.css' rel='stylesheet' />
                <script src='../lib/moment.min.js'></script>
                <script src='../lib/jquery.min.js'></script>
                <script src='../fullcalendar.min.js'></script>
                <script src='locale/pt-br.js'></script>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="icon" href="imagens/favicon.ico" type="image/x-icon" />
                <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon" />
                <title>SYSREL</title>
                <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                <link rel="stylesheet" href="css/bootstrapSkety.min.css">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <link href="css/style.css" rel="stylesheet" type="text/css" />
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


 button{

  margin: 12px;

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

.button {
    background-color: #f44336; 
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

.button3 {background-color: #41f456;} 

textarea {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    font: bold 18px Arial, Helvetica, sans-serif;
    width: 100%;


}

input[type=button] {
  display: inline-block;
  padding: 5px 5px;
  font-size: 12px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

input[type=button]:hover 
{background-color: #3e8e41}

input[type=button]:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

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

							 <?php

include 'abreConexao.php';
$sql2 = "SELECT RN.ID as id,tdr.FINALIZACAO as situacao, 
GROUP_CONCAT(tp.DESCRICAO) as title,
RN.DATA as start,
RN.DATA  as FIM 

FROM tb_reuniao as RN

INNER JOIN tb_pauta tp
ON tp.ID_REUNIAO_FK = RN.ID
LEFT JOIN tb_detalhe_reuniao tdr
ON tdr.ID_REUNIAO_FK = RN.ID

WHERE RN.ID_GRUPO_FK = '$idGrupo'
GROUP BY RN.ID";
$resultado_events = $conexao->query($sql2);
?>

  <script>
            $(document).ready(function() {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay,listWeek'
                    },
                    defaultDate: Date(),
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                                eventClick: function(event) {
                        $('#divAddEditar div').empty();
                        $('#divAddEditar div').remove();
                        $('#visualizar #idReuniao').text(event.id);
                        $('#visualizar #idReuniao').val(event.id);
                        $('#ModalFinalizarReuniao #idReuniaoF').val(event.id);
                        $('#visualizar #title').text(event.title);
                        $('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm'));
                        $('#visualizar #DtaEditar').val(event.start.format('DD/MM/YYYY HH:mm'));
                        $('#visualizar #situacao').val(event.color);


                             var Situacao = event.color;
                          	var IdReuniaoBusca = event.id;
                          	var url='BuscaDadosDaReuniao.php';

                          if(Situacao == "#f44242"){

                          	     $.ajax({
					              type: 'POST',
					              url: url,
					              data:'id='+IdReuniaoBusca,
					              success:function(response){

					              	 response = response.split("|");
					              
					               
					               document.getElementById("txtParticipantes").innerHTML += response[3];
					               document.getElementById("txtAta").innerHTML +=  response[4];

					              
					                 }});
                          	}

                        if(event.color == "#41f456"){
                        $('#visualizar #situacao').text("A Realizar");
                        }
                        else{
                        $('#visualizar #situacao').text("Realizada");
                        }

                        $('#visualizar').modal('show');
                        return false;


                             

                          

                    },
                    
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end){
                        $('#cadastrar #start').val(moment(start).format('DD/MM/YYYY HH:mm'));
                      //  $('#cadastrar #ender').val(moment(end).format('DD/MM/YYYY HH:mm'));
                        $('#cadastrar').modal('show');                      
                    },
                    events: [
                        <?php
                        $Cont = 1;
                        $ReuniaoAntiga = "";
                            while($row_events = mysqli_fetch_array($resultado_events)){
                     

                                    
                                


                                ?>
                                {
                                id: '<?php echo $row_events['id']; ?>',
                                title: '<?php echo 'PAUTAS:'.$row_events['title']; ?>',
                                start: '<?php echo $row_events['start']; ?>',
                                end: '<?php echo $row_events['FIM']; ?>',
                                <?php 
                                if($row_events['situacao'] == 1){
                              ?>  color: '<?php echo "#f44242"  ?>',
                               <?php   }else{
                              ?>  color: '<?php echo "#41f456"  ?>',
                               <?php } ?>

                                },<?php

                                }
                        ?>
                    ]
                });
            });

            //Mascara para o campo data e hora
            function DataHora(evento, objeto){
                var keypress=(window.event)?event.keyCode:evento.which;
                campo = eval (objeto);
                if (campo.value == '00/00/0000 00:00'){
                    campo.value=""
                }
             
                caracteres = '0123456789';
                separacao1 = '/';
                separacao2 = ' ';
                separacao3 = ':';
                conjunto1 = 2;
                conjunto2 = 5;
                conjunto3 = 10;
                conjunto4 = 13;
                conjunto5 = 16;
                if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (16)){
                    if (campo.value.length == conjunto1 )
                    campo.value = campo.value + separacao1;
                    else if (campo.value.length == conjunto2)
                    campo.value = campo.value + separacao1;
                    else if (campo.value.length == conjunto3)
                    campo.value = campo.value + separacao2;
                    else if (campo.value.length == conjunto4)
                    campo.value = campo.value + separacao3;
                    else if (campo.value.length == conjunto5)
                    campo.value = campo.value + separacao3;
                }else{
                    event.returnValue = false;
                }
            }


                        //Mascara para Hora
            function Hora(evento, objeto){
                var keypress=(window.event)?event.keyCode:evento.which;
                campo = eval (objeto);
                if (campo.value == '00:00'){
                    campo.value=""
                }
             
                caracteres = '0123456789';
                separacao1 = ':';
                conjunto1 = 2;
                conjunto2 = 5;
                conjunto3 = 10;
                conjunto4 = 13;
                conjunto5 = 16;
                if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (5)){
                    if (campo.value.length == conjunto1 )
                    campo.value = campo.value + separacao1;
                 
                }else{
                    event.returnValue = false;
                }
            }


        </script>

							 <h3>CALENDARIO DE REUNIÕES</h3>
							   
      			  <div id='calendar'></div> 
                  <div class="legends">
                  	<?php
                  	 while($row_events = mysqli_fetch_array($resultado_events)){
                  		echo 'PAUTAS:'.$row_events['title'];
                  		} 
                  		?>
           
        <center> <button class="button button3"></button><a>AGENDADAS</a><br></center>
         <center><button class="button"></button><a>REALIZADAS</a> </center>
         
     </div>
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




<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" >
                        <button type="button" class="close" data-dismiss="modal" onclick="ApagaDivEditar()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center">Dados da Reunião</h4>
                    </div>
                    <div class="modal-body">
                        <dl class="dl-horizontal">
                    

                           <input type="Hidden" id="idReuniao"  name="idReuniao">
                            <dt>Pautas da Reunião</dt>
                            <dd id="title"></dd>
                            <dt>Inicio da Reunião</dt>
                            <dd id="start"></dd>
                            <dt>Situação da Reunião</dt>
                            <dd id="situacao"></dd>
                            <dt>Participantes</dt>
                            <dd id="txtParticipantes"></dd>
                            <dt>Ata</dt>
                            <dd id="txtAta"></dd>

                     		<hr>


                  
        
                           
                        </dl>
           
                        <br><br>
                                        <div class="form" id="divFormEditar" style="display: none;">
                            <form class="form-horizontal" method="POST" action="VerificaEditarReuniao.php">

                                             <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
                                <div class="col-sm-10">
                                    <input type="datetime" class="form-control" name="DataInicio" id="DtaEditar" onKeyPress="DataHora(event, this)">
                                </div>
                            </div>

                                            <div  class="border">
                                          <h3 ><center>Itens de Pauta da Reunião</center></h3>
                                          <br><br>
                                    <div id="divAddEditar"></div>
                                            </div>
                                            <br><hr>
                                            

                                <input type="Hidden" class="form-control" name="idReuniao" id="idReuniao">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="button" class="btn btn-canc-edit btn-primary">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Salvar Alterações</button>
                                    </div>
                                </div>
                            </form>
                            
                        
                        </div>

                    </div>
                </div>
            </div>
        </div>

        		<script>
                    // Apagando Div Visualizar
            function ApagaDivEditar(){
               var visivel  = $('#divFormEditar').is(':visible');
                if (visivel){
                    $('.visualizar').slideToggle();
                    $('.form').slideToggle();
                }
            

                $('#divAddEditar div').empty();
                $('#divAddEditar div').remove();
                $('#txtInicio ').empty();
                 $('#txtFim ').empty();
                  $('#txtConvidados ').empty();
                   $('#txtParticipantes ').empty();
                    $('#txtAta ').empty();

            }
        </script>