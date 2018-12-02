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
<bR><bR><br><br><br><bR>
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




		  ?>

		    
      <?php
      $idGrupo = $_SESSION['idGrupoAtual'];
      include 'abreConexao.php';

$sql = "SELECT * FROM tb_grupo_pesquisa WHERE ID = '$idGrupo';";
    $result = $conexao->query($sql);
      $row = $result->fetch_assoc();
       $sigla = $row["SIGLA"];
       $logotipo = $row["LOGOTIPO"];


$foto = "\\"."fotos"."\\".$logotipo;
                  $dataTerminoCerta = date('d/m/Y', strtotime($row["DATA_INICIO"]));

                 

   ?>
    <h3>Publicações - <?php echo $sigla 
    ?>.<br><br>&nbsp &nbsp &nbsp <?php  echo '<img src="'.$foto.'" class="img-circle" width="100px" height="100px" alt="..."id="image"  >'; ?></h3> 
<br><br><br>
    


    <a href="CadastrarPublicacoes.php" style="margin: 0 15px;" class="btn btn-info" role="button">Cadastrar Publicações</a>
    <br><br>
    
		  <table class="table table-striped">
		     <thead>
		       <tr>
              <th>Titulo</th>
		         <th>Tipo</th>
		         <th>Docente</th>
		         <th>Projeto Pesquisa</th>
		         <th>Linha de Pesquisa</th> 
             <th>Data</th>              
             <th>Opções</th>
             <th></th> <th></th>
             


		       </tr>
		     </thead>
		      <?php 
		       include 'abreConexao.php';

		       $idGrupo = $_SESSION['idGrupoAtual'];


		       
		       //sql que pega todas as linhas de pesquisa do grupo
		       $sql = "SELECT P.ID, P.TITULO AS TITULO_P, P.TIPO, D.NOME AS NOME_D, PP.TITULO AS TITULO_PP, L.NOME, DATE_FORMAT(P.DATA_PUBLICACAO,'%d/%m/%Y') AS DATA_PUBLICACAO
FROM tb_publicacao P

INNER JOIN tb_docentes D
ON D.ID = P.ID_DOCENTE_FK

LEFT JOIN tb_projeto_pesquisa PP
ON PP.ID = P.ID_PROJETO_FK

INNER JOIN tb_linha_pesquisa L
ON L.ID = P.ID_LINHA_FK
AND P.ID_GRUPO_FK = '$idGrupo'
order by date(P.DATA_PUBLICACAO) asc";
		        //executo o comando e guardo em uma variavel o resultado
		       $result = $conexao->query($sql);
		        //alimenta a tabela com as linhas de pesquisa do grupo  

		       $aux = 0;
		       while($row = $result->fetch_assoc()) {
		       	$aux = 1;
      
		         echo('<td value="'.$row["ID"].'">'.$row["TITULO_P"].'</td>');
		         echo('<td value="'.$row["TIPO"].'">'.$row["TIPO"].'</td>');
		       	 echo('<td value="'.$row["NOME_D"].'">'.$row["NOME_D"].'</td>');
		         echo('<td value="'.$row["TITULO_PP"].'">'.$row["TITULO_PP"].'</td>');
             echo('<td value="'.$row["NOME"].'">'.$row["NOME"].'</td>');
             echo('<td value="'.$row["DATA_PUBLICACAO"].'">'.$row["DATA_PUBLICACAO"].'</td>');


             echo('<td><input type="button" class="btn btn-primary" value ="Alterar" onclick="AlterarPublicacao('.$row["ID"].')" name="'.$row["ID"].'" data-toggle="toggle"></td>');
     
		     echo('<td><input type="button" class="btn btn-danger" value ="Excluir" onclick="apagaPublicacao('.$row["ID"].')" name="'.$row["ID"].'" data-toggle="toggle"></td>');

		     
		         
		      
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
















</body>
<br><br><br>
<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>
</html>





 <script type="text/javascript">
      function apagaPublicacao(id){  
           var resposta = confirm("Deseja remover esta Publicacao?");
 
     if (resposta == true) {
          window.location.replace("apagaPublicacao.php?id=" + id);  
     }

    };




       function AlterarPublicacao(idPublicacao){  
          
          window.location.replace("AlterarPublicacao.php?id=" + idPublicacao );


     

        
    };

    </script>


