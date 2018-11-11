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
    <h3>Equipamentos do grupo <?php echo $sigla 
    ?><br><br> <?php  echo '<img src="'.$foto.'" class="img-circle" width="100px" height="100px" alt="..."id="image"  >'; ?></h3>

    <?php 
   

    
        if (isset($_SESSION["ALERT"])){
            echo'<div class="alert alert-success alert-dismissible"> 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                '.$_SESSION["ALERT"].'
            </div>';

            unset($_SESSION['ALERT']);
        }


     ?>
    <hr> 
   

    <tr>
                 <table class="table table-striped">
            <thead>
    <tr>    
            <th>Nome</th>
            <th>Descrição</th>
            <th>Data Disponibilização </th>
            <th>Alterar </th>
            <th>Ação </th>
   </tr>

<a href="telaCadastroEquipamento.php" style="margin: 0 15px;" class="btn btn-info" role="button">Cadastrar Novo Equipamento </a>
<br><br>
   </thead>

<?php 


include 'abreConexao.php';

$sql = "SELECT * FROM `tb_equipamentos` WHERE `ID_GRUPO_FK` = $idGrupo ";

    $resultado = $conexao->query($sql);
    while($row = $resultado->fetch_assoc()) {
       $nome = $row["NOME"];
       $descricao = $row["DESCRICAO"];
       $dataInico = $row["DATA_INICIO"];
       $dataTermino = $row["DATA_TERMINO"];
       $dataCerta = date('d/m/Y', strtotime($dataInico));

       $idEquipamento = $row["ID"];
         echo('<tr>');

//sql que pega todas as telas e permissões


    
    echo('<td name="tela'.$nome.'" value="'.$nome.'">'.$nome.'</td>');
    echo('<td name="tela'.$descricao.'" value="'.$descricao.'">'.$descricao.'</td>');
    echo('<td name="tela'.$dataCerta.'" value="'.$dataCerta.'">'.$dataCerta.'</td>');
    echo('<td><input type="button" class="btn btn-primary" value ="Alterar Dados" onclick="peganameG('.$idEquipamento.')" name="'.$idEquipamento.'" data-toggle="toggle"></td>');


  
  echo('<td><input type="button" class="btn btn-danger" value ="Excluir" onclick="peganameE('.$idEquipamento.')" name="'.$idEquipamento.'" data-toggle="toggle"></td>');




 


    echo('</tr>');


}
                    include 'fechaConexao.php'; 
 ?>




 <script type="text/javascript">
      function peganameE(idEquipamento){  
           var resposta = confirm("Deseja remover esse equipamento?");
 
     if (resposta == true) {
          window.location.replace("excluirEquipamento.php?id=" + idEquipamento);  
     }

    };



   function peganameG(idEquipamento){  
          
          window.location.replace("AlteraEquipamento.php?id=" + idEquipamento );
        }



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

        <h4 class="modal-title">Digite a data da saída do equipamento:</h4>
      </div>
      <div class="modal-body">
        <form action="inativarTecnico.php" method="POST">
          <input type="date" class="date"  name="datadesvinculo">
          <input type="hidden" name="idReg" id="idReg">
          <input type="submit" name="btn" class="btn btn-success">
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


