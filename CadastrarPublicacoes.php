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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"> </script>


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


 button{

  margin: 12px;

}

/* Overwrite default styles of hr */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

textarea {
    border-style: default;
    overflow: auto;
    outline: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;

    resize: none; /*remove the resize handle on the bottom right*/
    font: bold 18px Arial, Helvetica, sans-serif;
    width: 100%;


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
</style>

<body>
<!-- Navbar (sit on top) -->
  <?php
  include 'MenuNavBar.php';
  ?>

<?php 
$idGrupoA = $_SESSION['idGrupoAtual'];
?> 

<!-- FIM DO NAV BAR -->
<bR><bR><br>
<div>
<form id="formulario" method="post" enctype="multipart/form-data"" action="CadastraPublicacaoSql.php">
  <div class="container">
    <?php
            if (isset($_SESSION["ALERT"])){
          echo'<div class="alert alert-danger alert-dismissible"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              '.$_SESSION["ALERT"].'
          </div>';

          unset($_SESSION['ALERT']);
        }
        ?>

    <h1> Cadastro de Publicação</h1>
    <hr>

      <label for="text"><b>Titulo:</b></label>  
   <input type="text"  maxlength="60" name="Titulo" id="Titulo" required>

       <label for="text"><b>Projeto de Pesquisa:</b></label><br>
   <select class="form-control" id="cbProj" onchange="pegaDocente()" name="cbProj" required>
      <option value="0">NÃO POSSUI....</option>
        
        <?php  
                include 'abreConexao.php';

                $sql = "SELECT ID, TITULO FROM `tb_projeto_pesquisa` WHERE ID_GRUPO_FK = '$idGrupoA'  ";
              
                $result = $conexao->query($sql);

              //alimenta Select 
                while($row = $result->fetch_assoc()) {
                    echo'<option value="'.$row['ID'].'">'.$row["TITULO"].'</option>';

                }
                include 'fechaConexao.php'; 
                
                ?>


      </select>
<br>

       <label for="text"><b>Tipo:</b></label><br>
   <select class="form-control" id="TipoPublic" name="TipoPublic" required>      
        <option value="Livro">Livro</option>
        <option value="Capítulo de Livro">Capítulo de Livro</option>
        <option value="Anais de Congresso">Anais de Congresso</option>
        <option value="Periódicos">Periódicos</option>

       

      </select>
<br>


  <!-- <label for="text"><b>Docente Do Projeto:</b></label>
   <input type="text"  maxlength="60" name="Textdocente" id="Textdocente" required>
      -->

             
        <label for="text"><b>Docentes Do Grupo:</b></label>   
        <select class="form-control" onchange="pegaLinhaDocente()" id="DocentesDisp" name="DocentesDisp" required>      

                   <?php  
                include 'abreConexao.php';

                $sql = "SELECT D.ID, D.NOME
                FROM tb_docentes D

                INNER JOIN tb_docente_grupo DG
                ON DG.ID_DOCENTE_FK = D.ID
                AND DG.DATA_TERMINO IS NULL
                AND DG.ID_GRUPO_FK = '$idGrupoA'  ";
              
                $result = $conexao->query($sql);

              //alimenta Select 
                while($row = $result->fetch_assoc()) {
                    echo'<option value="'.$row['ID'].'">'.$row["NOME"].'</option>';

                }
                include 'fechaConexao.php'; 
                
                ?>
       

      </select>







           <br>

 <label for="text"><b>Linha de Pesquisa:</b></label>   
        <select class="form-control" id="LinhaPesquisa" name="LinhaPesquisa" required> 
        <option value="0">SELECIONE UMA LINHA ...</option>   
                   <?php  
                include 'abreConexao.php';

                    $sql = "SELECT L.ID, L.NOME 
                      FROM tb_linha_pesquisa L

                      INNER JOIN tb_linha_grupo GL
                      ON GL.ID_LINHA = L.ID
                      AND GL.ID_GRUPO = '$idGrupoA'  ";
              
                $result = $conexao->query($sql);

              //alimenta Select 
                while($row = $result->fetch_assoc()) {
                    echo'<option value="'.$row['ID'].'">'.$row["NOME"].'</option>';

                }
                include 'fechaConexao.php'; 
                
                ?>
       

      </select> <br><br>





     <label for="text"><b>Referencias:</b></label>
     <br>
    <textarea name="Referencias" id="Referencias" rows="08" required></textarea>
    <br><br>



    <label>Data da Publicação: </label><br>
    
    <input type="date"  required value=" " name="data" id="data" required>
    
<br><br>



      <button type="submit" onclick="HabilitaSelects()" class="registerbtn">Cadastrar</button>

   

      </div>

      </div>
  

 

    
   

  </div>
  </form>


  <br><br>
</div>







<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>




</body>
</html>


  <script> 


            function HabilitaSelects(){
                $("#DocentesDisp").prop('disabled', false);
               $("#LinhaPesquisa").prop('disabled', false);
            }


               function pegaDocente() { 

        var idProjeto = document.getElementById("cbProj");
        var itemSelecionado = idProjeto.options[idProjeto.selectedIndex].value;

      if (itemSelecionado != 0  ){
                //ADICIONANDO LINHAS INICIALMENTE PARA COMPARAÇÃO DEPOIS
          var url='PegaLinhasGRUPO.php';
          var GrupoA = <?php echo $idGrupoA; ?>;

          $.ajax({
              type: 'POST',
              url: url,
              data:'id='+GrupoA,
              success:function(response){
               //LIMPA SELECT DA LINHA DE PESQUISA.
                $("#LinhaPesquisa").empty();

                //PREENCHE COM AS LINHAS DO DOCENTE.
           document.getElementById("LinhaPesquisa").innerHTML += response;
          }});

        // FIM 
          var url='PegaDocenteProjetoPesquisa.php';
         
          $.ajax({
              type: 'POST',
              url: url,
              data:'id='+itemSelecionado,
              success:function(response){
      

         $('#DocentesDisp option').each(function(){$(this).removeAttr('selected');});   
         $('#LinhaPesquisa option').each(function(){$(this).removeAttr('selected');});

               var x = 0;

               response = response.split("|");
              //alert(response);


            for (x; x< response.length; x++) {
                   if(x == 3){ 
                     $("#DocentesDisp option").filter(function() {
                          return this.value == response[3];
                      }).attr('selected', true);
                      $("#DocentesDisp").prop('disabled', true);
                   }if(x == 2){
                      $("#LinhaPesquisa option").filter(function() {
                          return this.value== response[2]; 
                      }).attr('selected', true);
                      $("#LinhaPesquisa").prop('disabled', true);
                   }
                    
               } 
     
          }});
      }else{
         $("#DocentesDisp").prop('disabled', false);
         $('#DocentesDisp option').each(function(){$(this).removeAttr('selected');});   

         $("#LinhaPesquisa").prop('disabled', false);
         $('#LinhaPesquisa option').each(function(){$(this).removeAttr('selected');});   


        var idDocente = document.getElementById("DocentesDisp");
        var itemSelecionado = idDocente.options[idDocente.selectedIndex].value;

     
          var url='PegaLinhasDoDocente.php';
         
          $.ajax({
              type: 'POST',
              url: url,
              data:'id='+itemSelecionado,
              success:function(response){

               //LIMPA SELECT DA LINHA DE PESQUISA.
                $("#LinhaPesquisa").empty();

                //PREENCHE COM AS LINHAS DO DOCENTE.
           document.getElementById("LinhaPesquisa").innerHTML += response;
          }});
        


      }



          
      }




       function pegaLinhaDocente() { 
         var idDocente = document.getElementById("DocentesDisp");
        var itemSelecionado = idDocente.options[idDocente.selectedIndex].value;

      if (itemSelecionado != 0  ){
          var url='PegaLinhasDoDocente.php';
         
          $.ajax({
              type: 'POST',
              url: url,
              data:'id='+itemSelecionado,
              success:function(response){

               //LIMPA SELECT DA LINHA DE PESQUISA.
                $("#LinhaPesquisa").empty();

                //PREENCHE COM AS LINHAS DO DOCENTE.
           document.getElementById("LinhaPesquisa").innerHTML += response;
          }});
        }
    }


</script>