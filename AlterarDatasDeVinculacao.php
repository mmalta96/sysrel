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

.container {
    padding: 16px;
    background-color: #f2f2f2;
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
<!-- FIM DO NAV BAR -->
<bR><bR><br><br><b><br>

  <?php
    $id = $_GET["id"];

    ?>


<div>
<form id="formulario" method="post" enctype="multipart/form-data"" action="uploadFotoDocente.php">
  <div class="container">
      <?php 
        if (isset($_SESSION["ALERT"])){
          echo'<div class="alert alert-success alert-dismissible"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              '.$_SESSION["ALERT"].'
          </div>';
          unset($_SESSION['ALERT']);
        }
        ?>

 
<br><label><h3>Alterar Datas </h3></label><br>

   <table class="table table-striped">
         <thead>
           <tr>
             <th>Nome</th>
             <th>Data de Início</th>
             <th>Data de Desvinculação</th>
             <th>Opções</th> 
           </tr>
         </thead>
          <?php 


           include 'abreConexao.php';

           $idGrupo = $_SESSION['idGrupoAtual'];


           
           //sql que pega todas as linhas de pesquisa do grupo
           $sql = "SELECT 
            dl.ID, 
            lp.NOME AS LINHA,
              DATE_FORMAT(dl.DATA_INICIO,'%d/%m/%Y') AS DATA_INICIO, 
            DATE_FORMAT(dl.DATA_TERMINO,'%d/%m/%Y') AS DATA_TERMINO,
            IF(DATA_TERMINO IS NULL,'hidden','date') AS APARECE

          FROM tb_docente_linha dl

          inner join tb_linha_pesquisa lp
          ON lp.ID = dl.ID_LINHA_PESQUISA_FK
          AND  dl.ID_DOCENTE_FK =".$id;
            //executo o comando e guardo em uma variavel o resultado
           $result = $conexao->query($sql);
            //alimenta a tabela com as linhas de pesquisa do grupo  

           $aux = 0;
           while($row = $result->fetch_assoc()) {
            $aux = 1;
             echo('<tr>');
             //mostra nome da linha em uma coluna
             echo('<td value="'.$row["ID"].'">'.$row["LINHA"].'</td>');
             echo('<td value="'.$row["DATA_INICIO"].'">'.$row["DATA_INICIO"].'</td>');
             echo('<td value="'.$row["DATA_TERMINO"].'">'.$row["DATA_TERMINO"].'</td>');
          


            echo('<td><input type="button" class="btn btn-primary" value ="Alterar"  data-id="'.$row["ID"].''.'|'.''.$row["APARECE"].'"   id="btnDesvincular" onclick="desvincula(this);" data-toggle="modal" data-target="#modalDesvincular"></td>');

         

         


         
             
          
            echo('</tr>');


            }
            include 'fechaConexao.php'; 

            if ($aux == 0) {
          echo('<tr>');
          echo('<td name="nulo" value="0">Sem Registros</td>');
          }
          ?>

        

        </table>


   

      </div>

      </div>
  

 

    
   

  </div>
  </form>

<script>
      function desvincula(btn) {
            //id do registro
            var info = $(btn).attr('data-id');
            var str = info.split('|');
            var meuid = str[0];
            var meuid2 = str[1];
            
            passaDado(meuid,meuid2);


            $(".modal-body #idReg").val(meuid);
            $(".modal-body #idReg2").val(meuid2);

            //$('#dataFim').attr('hidden', meuid2);

            if (meuid2 == "hidden") {
                $("#dataFim").prop('disabled', true);
            }
            else {
                            $("input").prop('disabled', false);
 
            }
  


        };


               function passaDado(idUsuario,exibicao){
              
              var idRegistroS = idUsuario;
              
              var ExibeS = exibicao;
             
              
              
             };

</script>
    <!-- Modal -->
<div id="modalDesvincular" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Alteração de Datas</h4>
      </div>
      <div class="modal-body">
        <form action="AlterarDatasVinculo.php" method="POST">
          

   


          <input type="hidden" name="idReg"  id="idReg"  >
          <input type="hidden" name="idReg2"  id="idReg2" >

          <label> DATA DE INICIO </label>
          <input type="date" class="date"  name="dataInicio">

            <label>DATA FIM</label>            
            <input type="date" class="date"  id="dataFim" name="dataFim">
         



         

       
          


          
          <input type="submit" name="btn" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>

      
    </body>