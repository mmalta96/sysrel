
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

* {
    box-sizing: border-box;
}

/* Add padding to containers */
.container {
    padding: 16px;
    background-color: #f2f2f2;
}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email] {
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
</style>


<script type="text/javascript">
      function peganame(id){  
           var resposta = confirm("Deseja remover esse grupo?");
 
     if (resposta == true) {
          window.location.replace("removeGrupo.php?id=" + id);  
     }

    };

</script>

<script type="text/javascript">
      function peganame1(id){  
           var resposta = confirm("Deseja inativar esse grupo?");
 
     if (resposta == true) {
          window.location.replace("inativaGrupo.php?id=" + id);  
     }

    };

</script>

<script type="text/javascript">
      function peganame2(id){  
           var resposta = confirm("Deseja ativar esse grupo?");
 
     if (resposta == true) {
          window.location.replace("ativaGrupo.php?id=" + id);  
     }

    };

</script>

</head>
<body>
   <!-- Navbar (sit on top) -->
  <?php
  include 'MenuNavBar.php';
  ?>
<!-- FIM DO NAV BAR -->
 <br><br><bR><br><br>


<form method="post">
  <div class="container">
    <h3>Grupos de Pesquisa:</h3>
    <hr> <?php 
        if (isset($_SESSION["ALERT"])){
            echo'<div class="alert alert-success alert-dismissible"> 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                '.$_SESSION["ALERT"].'
            </div>';

            unset($_SESSION['ALERT']);
        }
    ?>

    <tr>
                 <table class="table table-striped">
            <thead>
    <tr>
            <th>Nome</th>
            <th>Sigla</th>
            <th>Lider</th>
            <th>Data Cadastro</th>
            <th>Status  </th>
            <th>Apagar </th>
            <th>Inativar   </th>
            <th>Ativar   </th>   
   </tr>

<a href="telaCadastroGrupo.php" style="margin: 0 15px;" class="btn btn-info" role="button">Cadastrar Novo Grupo </a>
<br><br>




   </thead>

<?php 


                    include 'abreConexao.php';

                    //sql que pega todas as telas e permissões
                    $sql = "SELECT * FROM `tb_grupo_pesquisa`";



                    //executo o comando e guardo em uma variavel o resultado
                    $result1 = $conexao->query($sql);

                    //sql que pega todas as telas e permissões



                    //alimenta a tabela com as telas e as permissões definidas  
                    while($row = $result1->fetch_assoc()) {

                    $nomeGrupo = $row["NOME"];
                    $idGrupo = $row["ID"];
                    $siglaGrupo = $row["SIGLA"];
                    $dataInicio =  $row["DATA_INICIO"];
                    $dataCerta = date('d/m/Y', strtotime($dataInicio));
                    $situacao = $row["SITUACAO"];


$sql = "SELECT * FROM `tb_grupo_lider` WHERE ID_GRUPO_FK = $idGrupo ORDER BY ID DESC;";
                     //$sql = "SELECT * FROM `tb_grupo_lider` WHERE ID_GRUPO_FK = $idGrupo;";
                     $result = $conexao->query($sql);
                     if ($row = $result->fetch_assoc()) {
                     $idLider = $row["ID_LIDER_FK"];
                     }
                    

                     $sql = "SELECT * FROM `tb_lider_pesquisa` WHERE ID = $idLider;";
                     $result2 = $conexao->query($sql);
                     if ($row = $result2->fetch_assoc()) {
                     $nomeLider = $row["NOME"];
                     }
                        

                    if ($situacao == 0) {
                    $status = "AGUARDANDO LIDER";
                    $dataCerta = "";
                    }elseif ($situacao == 1) {
                    $status = "ATIVO";
                    }elseif ($situacao == 2) {
                    $status = "INATIVO";
                    }


                        echo('<tr>');
                        //mostra nome da tela em uma coluna


                        echo('<td name="tela'.$nomeGrupo.'" value="'.$nomeGrupo.'">'.$nomeGrupo.'</td>');
                        echo('<td name="tela'.$siglaGrupo.'" value="'.$siglaGrupo.'">'.$siglaGrupo.'</td>');
                        echo('<td name="tela'.$nomeLider.'" value="'.$nomeLider.'">'.$nomeLider.'</td>');
                        echo('<td name="tela'.$dataCerta.'" value="'.$dataCerta.'">'.$dataCerta.'</td>');
                        echo('<td name="tela'.$status.'" value="'.$status.'">'.$status.'</td>');
                        echo('<td><input type="button" class="btn btn-danger" value ="Excluir" onclick="peganame('.$idGrupo.')" name="'.$idGrupo.'" data-toggle="toggle"></td>');
                        echo('<td><input type="button" class="btn btn-secondary" value ="Inativar " onclick="peganame1('.$idGrupo.')" name="'.$idGrupo.'" data-toggle="toggle"></td>');
                        echo('<td><input type="button" class="btn btn-success" value ="Ativar " onclick="peganame2('.$idGrupo.')" name="'.$idGrupo.'" data-toggle="toggle"></td>');



                       
/*
                        //verifica se ta permitido no banco pra mostrar checkbox checado
                        if ($row["lider"] == "1") {
                            echo('<td><input type="checkbox" name="'.$row["id"].'LIDER" checked data-toggle="toggle"></td>');
                        }
                        else if ($row["lider"] == "0") {
                            echo('<td><input type="checkbox" name="'.$row["id"].'LIDER" data-toggle="toggle"></td>');
                        }
*/
                        echo('</tr>');


                    }
                    include 'fechaConexao.php'; 
 ?>

</table>

 <?php 
        if (isset($_SESSION["ALERT1"])){
          echo'<div class="alert alert-danger alert-dismissible"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              '.$_SESSION["ALERT1"].'
          </div>';

          unset($_SESSION['ALERT1']);
        }
      ?>

</form>

<form>
    
    </form>
    
  
  </div>

  
</form>

<br><br><br><br><br><br>
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>
</body>
</html>


