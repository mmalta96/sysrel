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
</style>
</head>
<body>
   <!-- Navbar (sit on top) -->
  <?php
  include 'MenuNavBar.php';
  ?>
<!-- FIM DO NAV BAR -->
 <br><br><br><br><br>

<form method="post">
  <div class="container">

  

  <?php 

include 'abreConexao.php';

$idProjeto = $_GET['id'];




$sql = "SELECT * FROM tb_projeto_pesquisa WHERE ID = '$$idProjeto';";
    $result = $conexao->query($sql);
      $row = $result->fetch_assoc();
       $nome = $row["NOME"];



                 

   ?>


    <h3>
 <?php 
         if (isset($_SESSION["ALERT"])){
            echo'<div class="alert alert-success alert-dismissible"> 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                '.$_SESSION["ALERT"].'
            </div>';

            unset($_SESSION['ALERT']);
        }


     ?>

     Discentes do projeto <br><br><br> <?php echo $nome; 


     echo('<input type="button" class="btn btn-primary" value ="Cadastrar Discente" onclick="peganameP('.$idProjeto.')" name="'.$idProjeto.'" data-toggle="toggle">');
    ?></h3>

   

    <hr> 
   

    <tr>
                 <table class="table table-striped">
            <thead>
    <tr>    
            <th>Nome</th>
            <th>Curso</th>
            <th>Data Vinculo </th>
            <th>Data Desvinculamento </th>
            <th>Opções </th>
   </tr>


   </thead>

<?php 


include 'abreConexao.php';

$sql = "
SELECT d.NOME, d.CURSO, o.DATA_INICIO, o.DATA_TERMINO, d.ID, o.ID AS IDOrientacao
FROM tb_discente d
inner join tb_orientacao o
on d.ID = o.ID_DISCENTE_FK
AND o.ID_PROJETO_FK = '$idProjeto';";
$resultado = $conexao->query($sql);

    while($row = $resultado->fetch_assoc()) {

    $nome = $row["NOME"];
    $idDiscente = $row["ID"];
    $curso = $row["CURSO"];
    $dataTermino = $row["DATA_TERMINO"];
    $dataTermino1 = date('d/m/Y', strtotime($dataTermino));
    $dataInicio =  $row["DATA_INICIO"];
    $dataCerta = date('d/m/Y', strtotime($dataInicio));
    $idOrientacao = $row["IDOrientacao"];
    
    
    echo('<tr>');

    
    echo('<td name="tela'.$nome.'" value="'.$nome.'">'.$nome.'</td>');
    echo('<td name="tela'.$curso.'" value="'.$curso.'">'.$curso.'</td>');
    echo('<td name="tela'.$dataCerta.'" value="'.$dataCerta.'">'.$dataCerta.'</td>');
     if ($dataTermino == NULL) {
      $status = "ATIVO";
    echo('<td name="tela'.$status.'" value="'.$status.'">'.$status.'</td>');
     }else {
$status = "INATIVO";
echo('<td name="tela'.$status." ".$dataTermino1.'" value="'.$status." ".$dataTermino1.'">'.$status." ".$dataTermino1.'</td>');
  }
  
echo('<td><input type="button" class="btn btn-primary" value ="Alterar Dados" onclick="peganameG('.$idDiscente.')" name="'.$idDiscente.'" data-toggle="toggle"></td>');
echo('<td><input type="button" class="btn btn-danger" value ="Excluir" onclick="peganameE('.$idDiscente.')" name="'.$idDiscente.'" data-toggle="toggle"></td>');
echo('<td><input type="button" class="btn btn-info" value ="Desvincular" data-id="'.$idOrientacao.'" id="btnDesvincular" onclick="desvincula(this);" data-toggle="modal" data-target="#modalDesvincular"></td>');

  
}
                    include 'fechaConexao.php'; 
 ?>




 <script type="text/javascript">
      function peganameE(idDiscente){  
           var resposta = confirm("Deseja remover esse discente?");
 
     if (resposta == true) {
          window.location.replace("excluirDiscente.php?id=" + idDiscente );  
     }

    };

  function desvincula(btn) {
            var info = $(btn).attr('data-id');
            var str = info.split('|');
            var meuid = str[0];
            $(".modal-body #idReg").val(meuid);
        };

   function peganameG(idDiscente){  
          
          window.location.replace("TelaAlteraDiscente.php?id=" + idDiscente );


             
    }

    function peganameP(idProjeto){  
          
          window.location.replace("TelaCadastraDiscente.php?id=" + idProjeto );


             
    }


    ;






</script>

</table>



</form>

<form>
    
    </form>
    
  
  </div>

  
</form>



<!-- Modal -->
<div id="modalDesvincular" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Digite a data de desvinculação do discente:</h4>
      </div>
      <div class="modal-body">
        <form action="inativarDiscente.php" method="POST">
          <input type="date" class="date"  name="datadesvinculo">
          <input type="hidden" name="idReg" id="idReg">
          <?php echo '<input type="hidden" id="custId" name="idProjeto" value="'.$idProjeto.'">'; ?>
          <input type="submit" name="btn" value="Desvincular" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>

  </div>
</div>










<br><br><br><br><br><br>
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>
</body>
</html>


