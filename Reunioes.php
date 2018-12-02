<?php  
	session_start();
	$id = 2;
	if (isset($_SESSION['ID_USUARIO'])){
        if ($_SESSION['TIPO_USUARIO'] == 2){
        }else{
        header("location:index.php");
    }


	}
	
?>

<?php
$idGrupo = $_SESSION['idGrupoAtual'];
include 'abreConexao.php';
$sql = "SELECT RN.ID as id,tdr.FINALIZACAO as situacao, 
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
$resultado_events = $conexao->query($sql);
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
					               document.getElementById("txtInicio").innerHTML += response[0];
					               document.getElementById("txtFim").innerHTML += response[1];
					               document.getElementById("txtConvidados").innerHTML += response[2];
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
    </head>
    <body>
        <!-- Navbar (sit on top) -->
  <?php
  include 'MenuNavBar.php';
  ?>
<!-- FIM DO NAV BAR -->

<bR><bR><br><br><br><bR>

              <?php
            if(isset($_SESSION['msg'])){
                  echo'<div class="alert alert-success alert-dismissible"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              '.$_SESSION["msg"].'
          </div>';
                unset($_SESSION['msg']);
            }
            ?>

            <center><h2><b><i> Calendário de Reuniões </h2></center> <br><br>
  
        <div id='calendar'></div>   
        
          <div class="legends">
           
        <center> <button class="button button3"></button><a>AGENDADAS</a><br></center>
         <center><button class="button"></button><a>REALIZADAS</a> </center>
         
     </div>
           
 
    </body>
    <br><br><br><br><br>
    <!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>

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
                            <dt>Hora de Inicio</dt>
                            <dd id="txtInicio"></dd>
                            <dt>Hora de Fim</dt>
                            <dd id="txtFim"></dd>
                            <dt>Convidados</dt>
                            <dd id="txtConvidados"></dd>
                            <dt>Participantes</dt>
                            <dd id="txtParticipantes"></dd>
                            <dt>Ata</dt>
                            <dd id="txtAta"></dd>

                     		<hr>


                  
        
                           
                        </dl>
                        <center>
                        <button class="btn btn-canc-vis btn-warning" id="BotaoEditar" onclick="AddCamposEditar()">Editar</button>

                        <button class="btn  btn-info" id="BotaoFinalizar" onclick="FechaModal()" >Finalizar Reunião</button>

                        <button class="btn  btn-danger" id="ExcluirReuniao" onclick="ExcluirR()" >Excluir Reunião</button>
                        </center>
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
        
        <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
             <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center">Cadastrar Reunião</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="CadastraReuniao.php">
                                <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Tipo de Reunião</label>
                                <div class="col-sm-10"><br>
                                    <select name="TipoReuniao" class="form-control" id="cbTipo" onchange="outroTipo()">    
                                        <option style="color:#1C1C1C;" value="0">A Realizar</option>
                                        <option style="color:#1C1C1C;" value="1">Já Realizada</option>
                                    </select>
                                </div>
                            </div>
                   	                   

							<!-- DATA -->
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
                                <div class="col-sm-10">
                                    <input type="datetime" class="form-control" name="DataInicio" id="start" onKeyPress="DataHora(event, this)">
                                </div>
                            </div>
                            
                                     <!-- PAUTAS -->
                                     <div class="form-group">
                            <label  for="inputEmail3" class="col-sm-2 control-label"">Pauta</label>
                                <div class="col-sm-10" id="DivPautas">
                                               
                                        <a class="btn btn-primary" href="javascript:void(0)" id="addPauta">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Adicionar Item</a>
                                        
                                        
                                        <p>
                                        <input required  type="text" class="form-control" name="campoPauta[]" id="inputPauta" size="20" value="" placeholder="Item da Pauta" />
                                        
                                               
                                </div>
                            </div>

                           <center> <button type="button" class="btn btn-info btn-lg" style="visibility:hidden;" id="DetalhesR" data-toggle="collapse"  data-target="#Addlista">Adicionar Detalhes da Reunião</button></center> <br><br>
                            <div id="Addlista" class="collapse">


                                        <div class="form-group">
                                      <label  class="col-sm-2 control-label">Convidado</label>
                                        <div class="col-sm-10">
                                               
                                        <a class="btn btn-primary" href="javascript:void(0)" id="addConvidado">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Adicionar Coonvidado</a>
                                        <br/>
                                        <div id="DivCon">
                                        <p>
                                        <input type="text" class="form-control" name="campo[]" id="inputConv" size="20" value="" placeholder="Nome do Convidado" />
                                        <a class="btn btn-danger" href="javascript:void(0)" id="remConvidado">
                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Remover Convidado</a></p>
                                        </div>
                                        </div>
                                        </div>

                                         <br>

                                        <div id="divOutroTipo"></div>


                                    


                                            </div>
                                        </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit"  class="btn btn-success">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="ModalFinalizarReuniao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
             <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center">Finalizar Reunião</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" id="FormFinalizaR" action="FinalizarReuniao.php">
                               

                       

                                         <input type="hidden" id="idReuniaoF"  name="idReuniaoF">
                                        <div class="form-group">
                                      <label  class="col-sm-2 control-label">Convidado</label>
                                        <div class="col-sm-10">
                                               
                                        <a class="btn btn-primary" href="javascript:void(0)" id="addConvidadoF">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Adicionar Coonvidado</a>
                                        <br/>
                                        <div id="DivConF">
                                        <p>
                                        <input type="text" class="form-control" name="campoF[]" id="inputConv" size="20" value="" placeholder="Nome do Convidado" />
                                        <a class="btn btn-danger" href="javascript:void(0)" id="remConvidado">
                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Remover Convidado</a></p>
                                        </div>
                                        </div>
                                        </div>

                                         <br>

                                        <div id="divOutroTipo2"></div>


                                    


                                        </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit"  class="btn btn-success">Finalizar Reunião</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
                        function outroTipo() {

                var tipo = document.getElementById("cbTipo");

                var itemSelecionado = tipo.options[tipo.selectedIndex].value;

                if (itemSelecionado == "1") {
                document.getElementById("DetalhesR").style.visibility = "visible";
                
                // ADICIONA OS CAMPOS OBRIGATÓRIOS NOVAMENTE - DO MODAL - CADASTRAR REUNIÃO FINALIZADA
                document.getElementById("divOutroTipo").innerHTML = 
                        '<div class="form-group">'+
                        '<label for="inputEmail3" class="col-sm-2 control-label" id="linicio" >Hora do Inicio</label>'+
                        '<div class="col-sm-10">'+
                        '<input required type="text" class="form-control" name="Hinicio" id="inicio" onKeyPress="Hora(event, this)">'+
                                '</div>'+
                            '</div>'+

                         '<div class="form-group">'+
                        '<label for="inputEmail3" class="col-sm-2 control-label" id="lfim" >Hora do Fim</label>'+
                        '<div class="col-sm-10">'+
                        '<input required type="text" class="form-control" name="Hfim" id="fim" onKeyPress="Hora(event, this)">'+
                                '</div>'+
                            '</div>'+



                                '<div class="form-group">'+
                                '<label for="inputEmail3" class="col-sm-2 control-label" id="lDocentes" >(Participantes) Docentes</label>'+
                                '<div class="col-sm-10">'+
                                    '<select required name="docentes" class="form-control" id="cbDocentes" onchange="pegaCategoria()">'+
                                    '</select>'+
                                            '</div>'+
                                        '</div>'+
                                                
                                                '<center><div id="btnLinhas"><br></center>'+

                                                '<input type="Hidden" id="arrayLinhas"  name="arrayLinhas">'+
                                              
                                            '</div><br>'+

                                            
                                            
                                            '<div class="form-group">'+
                                            '<label for="inputEmail3" class="col-sm-2 control-label" id="lata" >ATA</label>'+
                                            '<div class="col-sm-10">'+
                                              '<textarea required class="form-control" name="ata" id="ata" rows="10" ></textarea>'+
                                            '</div>'+
                                            '</div>';



                // PREENCHE COMBO DE DOCENTES


                var Grupo = <?php echo $idGrupo; ?>;

                var itemSelecionado = cbTipo.options[cbTipo.selectedIndex].value;

     if (itemSelecionado != 0  ){
          var url='PegaDocentesGrupo.php';
         
          $.ajax({
              type: 'POST',
              url: url,
              data:'id='+Grupo,
              success:function(response){

               //LIMPA SELECT DA LINHA DE PESQUISA.
                $("#cbDocentes").empty();

                //PREENCHE COM AS LINHAS DO DOCENTE.
                 $('#cbDocentes').append('<option value="" disabled selected>Selecione...</option>');
           document.getElementById("cbDocentes").innerHTML += response;
                 }});
            
        }


                } else {
                    document.getElementById("Addlista").setAttribute("class", "collapse");
                    document.getElementById("DetalhesR").style.visibility = "hidden";
                    document.getElementById("inicio").remove();
                     document.getElementById("linicio").remove();
                    document.getElementById("fim").remove();
                    document.getElementById("lfim").remove();
                    document.getElementById("cbDocentes").remove();
                    document.getElementById("lDocentes").remove();
                    document.getElementById("ata").remove();
                    document.getElementById("lata").remove();
                    
                    
                }
            }


                                    function outroTipo2() {
                // ADICIONA OS CAMPOS OBRIGATÓRIOS NOVAMENTE - DO MODAL FINALIZAR REUNIÃO
                document.getElementById("divOutroTipo2").innerHTML = 
                        '<div class="form-group">'+
                        '<label for="inputEmail3" class="col-sm-2 control-label" id="linicio" >Hora do Inicio</label>'+
                        '<div class="col-sm-10">'+
                        '<input required type="text" class="form-control" name="Hinicio" id="inicio" onKeyPress="Hora(event, this)">'+
                                '</div>'+
                            '</div>'+

                         '<div class="form-group">'+
                        '<label for="inputEmail3" class="col-sm-2 control-label" id="lfim" >Hora do Fim</label>'+
                        '<div class="col-sm-10">'+
                        '<input required type="text" class="form-control" name="Hfim" id="fim" onKeyPress="Hora(event, this)">'+
                                '</div>'+
                            '</div>'+



                                '<div class="form-group">'+
                                '<label for="inputEmail3" class="col-sm-2 control-label" id="lDocentes" >(Participantes) Docentes</label>'+
                                '<div class="col-sm-10">'+
                                    '<select required name="docentes" class="form-control" id="cbDocentes" onchange="pegaCategoria()">'+
                                    '</select>'+
                                            '</div>'+
                                        '</div>'+
                                                
                                                '<center><div id="btnLinhas"><br></center>'+

                                                '<input type="Hidden" id="arrayLinhas"  name="arrayLinhas">'+
                                              
                                            '</div><br>'+

                                            
                                            
                                            '<div class="form-group">'+
                                            '<label for="inputEmail3" class="col-sm-2 control-label" id="lata" >ATA</label>'+
                                            '<div class="col-sm-10">'+
                                              '<textarea required class="form-control" name="ata" id="ata" rows="10" ></textarea>'+
                                            '</div>'+
                                            '</div>';



                // PREENCHE COMBO DE DOCENTES


                var Grupo = <?php echo $idGrupo; ?>;

   
          var url='PegaDocentesGrupo.php';
         
          $.ajax({
              type: 'POST',
              url: url,
              data:'id='+Grupo,
              success:function(response){

               //LIMPA SELECT DA LINHA DE PESQUISA.
                $("#cbDocentes").empty();

                //PREENCHE COM AS LINHAS DO DOCENTE.
                 $('#cbDocentes').append('<option value="" disabled selected>Selecione...</option>');
           document.getElementById("cbDocentes").innerHTML += response;
                 }});
            
        


               
                    
                    
                }
            


            //ADICIONAR ITENS AO EDITAR 
            function AddCamposEditar(){
             $('#divAddEditar').empty();
             $('#divAddEditar div').remove();

            var idReun = document.getElementById("idReuniao").value;
            var url='PegaPautas.php';
          $.ajax({
            type: 'POST',
            url: url,
            data:'id='+idReun,
            success:function(response){


            response = response.split(",");
                
             var cor = document.getElementById("situacao");
                        
            if(cor.value == "#41f456"){
                
                    var x = 0;

              document.getElementById("divAddEditar").innerHTML +=  
                   
                   
                   
                   '<a class="btn btn-primary"  href="javascript:void(0)" id="addPauta2">'+
                                        '<span  class="glyphicon glyphicon-plus" aria-hidden="true"></span>Adicionar Item de Pauta</a>';
                                       
                             
            for(x; x< response.length; x++) {

                        
                      if(x == 0){
               document.getElementById("divAddEditar").innerHTML += 
               '<div  id="DivPautas2">'+
                '<p>'+
            '<input required  type="text" class="form-control" name="campoPauta2[]" id="inputPauta2" size="20" value="'+response[x]+'" placeholder="Item da Pauta" />';
                 
                      }else{
                document.getElementById("divAddEditar").innerHTML += 
                                '<div  id="DivPautas2">'+
                '<p>'+
                '<input required  type="text" class="form-control" name="campoPauta2[]" id="inputPauta2" size="20" value="'+response[x]+'" placeholder="Item da Pauta" />'+
                      '<a class="btn btn-danger" href="javascript:void(0)" id="remPauta2">'+
                            '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> '+
                            'Remover Pauta'+
                        '</a>';
                    }
            }

          

 
                                    }


            }
          });


            }




            // DOCENTES 
             function pegaCategoria() { 


        var idCat = document.getElementById("cbDocentes");
        var itemSelecionado = idCat.options[idCat.selectedIndex].value;
        var nomelinha = idCat.options[idCat.selectedIndex].text;
        if (!itemSelecionado == 0 && idCat.options[idCat.selectedIndex].index > 0){
          var url='linhasSelecionadas.php';
          $.ajax({
            type: 'POST',
            url: url,
            data:'id='+itemSelecionado+"&nome="+nomelinha,
            success:function(response){
        //document.getElementById("demo").innerHTML = response;

      var check = document.getElementById('arrayLinhas').value;

     

      var array = check.split(",");

       //document.getElementById("btnLinhas").appendChild(btn);

       var x = 0;

       response = response.split(",");

          
        if (array.includes(response[0])) {
            x = 1;
        }
          

          if (x == 0) {
  

              var a= document.getElementById("arrayLinhas").value;
              if (a == "") {
                   document.getElementById("arrayLinhas").value = response[0];
              }
              else {
                  document.getElementById("arrayLinhas").value = a + "," + response[0] ;
              }
              
              criaBotao(response[0],response[1]);

          }
        
          function selectByText(select, text) {
          $(select).find('option:contains("' + text + '")').prop('selected', true);
        }

            selectByText('#cbDocentes', 'Selecione...');

            }
          });


        }
          
      }



       function criaBotao(id,linha){


        var btn = document.createElement('BUTTON');
        var lbl = document.createTextNode(linha);        
         
        btn.appendChild(lbl);   

        btn.setAttribute("class", "btn btn-danger");


        btn.setAttribute("id","btn"+id);

        btn.setAttribute("value",linha);

         btn.onclick = function()
         {
            Excluir(id);
         }

        document.getElementById("btnLinhas").appendChild(btn);
        

      }


      function Excluir(linha){
    
          var vetor = document.getElementById("arrayLinhas").value;
          vetor = vetor.split(",");
          
          vetor.splice(vetor.indexOf(linha), 1);


          document.getElementById("arrayLinhas").value = vetor.toString();

          document.getElementById("btn"+linha).remove();
      }








  




      // PAUTAS - ADD E REMOVER

			$(function () {
			    var scntDiv = $('#DivPautas');
			    $(document).on('click', '#addPauta', function () {
			        $('<p>'+
		        		'<input required type="text" name="campoPauta[]" class="form-control" id="inputPauta" size="20" value="" placeholder="Item da Pauta" /> '+
		        		'<a class="btn btn-danger" href="javascript:void(0)" id="remPauta">'+
							'<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> '+
							'Remover Pauta'+
		        		'</a>'+
					'</p>').appendTo(scntDiv);
			        return false;
			    });
			    $(document).on('click', '#remPauta', function () {
		            $(this).parents('p').remove();
			        return false;
			    });
			});


            // PAUTA DO EDITAR
                        $(function () {
                var scntDiv = $('#divAddEditar');
                $(document).on('click', '#addPauta2', function () {
                    $(         
                          
               
                                  
            
                                        '<p>'+
                '<input required  type="text" class="form-control" name="campoPauta2[]" id="inputPauta2" size="20" value="" placeholder="Item da Pauta" />'+
                      '<a class="btn btn-danger" href="javascript:void(0)" id="remPauta2">'+
                            '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> '+
                            'Remover Pauta'+
                        '</a>'

                
                    
                       ).appendTo(scntDiv);
                    return false;
                });
                $(document).on('click', '#remPauta2', function () {
                    $(this).parents('p').remove();
                    return false;
                });
            });






			</script>






			<script>
	    // CONVIDADOS - ADD E REMOVER

			$(function () {
			    var scntDiv = $('#DivCon');
			    $(document).on('click', '#addConvidado', function () {
			        $('<p>'+
		        		'<input type="text" name="campo[]"  class="form-control" id="inputConv" size="20" value="" placeholder="Nome do Convidado" /> '+
		        		'<a class="btn btn-danger" href="javascript:void(0)" id="remConvidado">'+
							'<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> '+
							'Remover Convidado'+
		        		'</a>'+
					'</p>').appendTo(scntDiv);
			        return false;
			    });
			    $(document).on('click', '#remConvidado', function () {
		            $(this).parents('p').remove();
			        return false;
			    });
			});


                    // CONVIDADOS - ADD E REMOVER - DO FINALIZAR

            $(function () {
                var scntDiv = $('#DivConF');
                $(document).on('click', '#addConvidadoF', function () {
                    $('<p>'+
                        '<input type="text" name="campoF[]"  class="form-control" id="inputConv" size="20" value="" placeholder="Nome do Convidado" /> '+
                        '<a class="btn btn-danger" href="javascript:void(0)" id="remConvidadoF">'+
                            '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> '+
                            'Remover Convidado'+
                        '</a>'+
                    '</p>').appendTo(scntDiv);
                    return false;
                });
                $(document).on('click', '#remConvidadoF', function () {
                    $(this).parents('p').remove();
                    return false;
                });
            });




            //BOTAO EDITAR 
                    $('.btn-canc-vis').on("click", function() {
                        var cor = document.getElementById("situacao");
                        
                        if(cor.value == "#41f456"){

                $('.form').slideToggle();
                $('.visualizar').slideToggle();
                            }else{
                                alert("Essa Reunião não pode ser Alterada, pois já foi Finalizada !!");
                            }
            });
            $('.btn-canc-edit').on("click", function() {
                $('.visualizar').slideToggle();
                $('.form').slideToggle();
            });

			
            // Apagando Div Editar
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


            // FECHA MODAL DE VIZUALIZAR E ABRE O DE FINALIZAR REUNIAO
            function FechaModal(){
            	 $('#divAddEditar div').empty();
                $('#divAddEditar div').remove();
                $('#txtInicio ').empty();
                 $('#txtFim ').empty();
                  $('#txtConvidados ').empty();
                   $('#txtParticipantes ').empty();
                    $('#txtAta ').empty();

                var cor = document.getElementById("situacao");
                if(cor.value != "#41f456"){
                                alert("Essa Reunião não pode ser Alterada, pois já foi Finalizada !!");
                            }else{
                                $('#ModalFinalizarReuniao').modal('show');
                            }
                $('#visualizar').modal('hide');
                outroTipo2();
                
            }

            function ExcluirR(){

                var idR = document.getElementById("idReuniao");
                var cor = document.getElementById("situacao");

                                 if(cor.value != "#41f456"){
                                alert("Essa Reunião não pode ser Excluida, pois já foi Finalizada !!");
                                }else{
                                        var respostaE = confirm("Deseja Realmente Excluir está Reunião?");
                                            if (respostaE == true) {

                                             window.location.replace("ExcluirReuniaoSQL.php?idR=" + idR.value);
                                                 }
                                        }
                                 }



 $("#FormFinalizaR").submit(function(event){
  
var resposta = confirm("Nenhuma Alteração poderá ser feita caso finalize a Reunião. \n Tem Certeza que Deseja Finalizar esta reunião?");
 
     if (resposta == true) {
         
     }else{
  event.preventDefault();
        }
});

			</script>