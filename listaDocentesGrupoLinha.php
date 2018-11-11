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
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="imagens/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon" />
      <title>SYSREL</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="css/bootstrapSkety.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</head>
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

 button{

  margin: 12px;

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
<bR><bR><br>
<div class="container">
<form method="post">
  		  <?php 
		    if (isset($_SESSION["ALERT"])){
		      echo'<div class="alert alert-success alert-dismissible"> 
		        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		          '.$_SESSION["ALERT"].'
		      </div>';
		      unset($_SESSION['ALERT']);
		    }

		        if (isset($_SESSION["EXCLUSAO"])){
		      echo'<div class="alert alert-danger alert-dismissible"> 
		        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		          '.$_SESSION["EXCLUSAO"].'
		      </div>';
		      unset($_SESSION['EXCLUSAO']);
		    }

          if (isset($_SESSION["ERRO"])){
          echo'<div class="alert alert-danger alert-dismissible"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              '.$_SESSION["ERRO"].'
          </div>';
          unset($_SESSION['ERRO']);
        }


		  ?>
<br><br><br><br>
		  <h3>Lista de Docentes </h3>
		 
		  <table class="table table-striped">
		     <thead>
		       <tr>
		         <th>Nome</th>
		         <th>Opções</th> 
		       </tr>
		     </thead>
		      <?php 
		       include 'abreConexao.php';

		       $idGrupo = $_SESSION['idGrupoAtual'];


		       
		       //sql que pega todas as linhas de pesquisa do grupo
		       $sql = "SELECT 
               
            dc.ID  as ID,
            dc.NOME as NOME

                                                        
            FROM tb_docentes dc                                      

            where dc.ID not in (
                SELECT ID_DOCENTE_FK
                FROM tb_docente_grupo
                WHERE ID_GRUPO_FK = '$idGrupo'
            );";
		        //executo o comando e guardo em uma variavel o resultado
		       $result = $conexao->query($sql);
		        //alimenta a tabela com as linhas de pesquisa do grupo  

		       $aux = 0;
		       while($row = $result->fetch_assoc()) {
		       	$aux = 1;
		         echo('<tr>');
		         //mostra nome da linha em uma coluna
		         echo('<td value="'.$row["ID"].'">'.$row["NOME"].'</td>');
		 
		      


		        
		         	 echo('<td><input type="button" class="btn btn-info" value ="Vincular" data-id="'.$row["ID"].'" id="btnvincular" onclick="vincula(this);" data-toggle="modal" data-target="#modalvincular"></td>');
		         
		         
		      
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



			function vincula(btn) {
		        var info = $(btn).attr('data-id');
		        var str = info.split('|');
		        var meuid = str[0];
		        $(".modal-body #IDdocente").val(meuid);
		    };

		</script>


<!-- Large modal -->
<br><br><br>




  

<!--VERIFICA SE O GRUPO SELECIONADO TEM ALGUMA LINHA DE PESQUISA -->
  <?php

$idGrupo = $_SESSION['idGrupoAtual'];

      include 'abreConexao.php';

                $sql = "SELECT * FROM `tb_linha_grupo` WHERE `ID_GRUPO` = '$idGrupo' ";

                $result = $conexao->query($sql);

                $resultado = 0;
              //alimenta Select 
                while($row = $result->fetch_assoc()) {
                   if($row['ID_GRUPO'] == $idGrupo){
                    $resultado = 1;
                   }

                }
                include 'fechaConexao.php'; 


if($resultado == 1 ){
  // FAZ NADA
    }else{
     
        ?>
<script>
$(document).ready(function(){
    // Show the Modal on load
    $("#cadDOC").modal({backdrop: "static"});
    
    // Hide the Modal
    $("#myBtn").click(function(){ 
        $("#cadDOC").modal("hide");
    });
});
</script>
    <?php

    }
  
?>



  <br><br>
</div>
<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>




<!-- Modal DE ALERTA-->
<div class="modal fade" id="cadDOC" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Atenção !</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning" role="alert">
      <center>O Grupo Atual não tem nenhuma linha de Pesquisa, Vincule pelo menos uma para poder Adicionar Docentes.</center>
    </div>
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
<div id="modalvincular" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Digite a data de Vinculação:</h4>
      </div>
      <div class="modal-body">
      	<form action="vinculaDocenteGrupo.php" method="POST">
	        <input type="date" class="date"  name="datavinculo">
	        <input type="hidden" name="IDdocente" id="IDdocente">

          <!-- ADD LINHAS DE PESQUISA -->


<label>Selecionar Linhas de Pesquisa: </label><br>
  
 
 

    <?php
            if (isset($_SESSION["ALERT"])){
          echo'<div class="alert alert-danger alert-dismissible"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              '.$_SESSION["ALERT"].'
          </div>';

          unset($_SESSION['ALERT']);
        }
        ?>


        <!--- ARRAY DAS LINHAS -->
        

      <?php 
$idGrupoA = $_SESSION['idGrupoAtual'];
?>       

        <select  id="cbCat" onchange="pegaCategoria()" class="form-control">
        <option  value="0">Selecione...</option>
        <?php
        //alimenta a tabela com as linhas de pesquisa do idGrupo
           include 'abreConexao.php';

            //preenche lista com as categorias
            $sql = "SELECT ln.NOME as NOME,
             ln.ID as ID
          

        FROM tb_linha_pesquisa ln

        inner join tb_linha_grupo lg
        on ln.ID  = lg.ID_LINHA
        AND lg.ID_GRUPO = '$idGrupoA' ";

       $result = $conexao->query($sql);

              //alimenta Select 
                while($row = $result->fetch_assoc()) {
                    echo'<option value="'.$row['ID'].'">'.$row["NOME"].'</option>';

                }
                include 'fechaConexao.php'; 
                
                ?>


      </select>


           

    
     <br>
  
    
          <script>
          function pegaCategoria() { 


        var idCat = document.getElementById("cbCat");
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
      
      </script>

      <input type="hidden" id="arrayLinhas" name="arrayLinhas">

      <div  id="btnLinhas">
   
    

            <!-- FIM ADD LINHAS DE PESQUISA -->

	        
        
      </div>
      <br><br>
      <div class="modal-footer">
        <input type="submit" name="btn" style="float: right;" value="Salvar" class="btn btn-success">
        </form>
      </div>
    </div>

  </div>
</div>


</body>
</html>
