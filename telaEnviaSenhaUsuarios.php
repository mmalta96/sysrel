
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
        window.location.replace("envia_email.php?id=" + id);
    };
</script>
</head>
<body>
    <!-- Navbar (sit on top) -->
  <?php
  include 'MenuNavBar.php';
  ?>
<!-- FIM DO NAV BAR -->

<br><br><br><br><br><br>
 


<form method="post">
  <div class="container">
    <h3>Lista de usuários cadastrados:</h3>
  <?php 
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
            <th>Prontuario</th>
            <th>Email</th>
            <th>Data Cadastro</th>
            <th></th>
   
   </tr>
   </thead>

<?php 


                    include 'abreConexao.php';

                    //sql que pega todas as telas e permissões
                    $sql = "SELECT * FROM `tb_lider_pesquisa`";

                    //executo o comando e guardo em uma variavel o resultado
                    $result = $conexao->query($sql);

                    //alimenta a tabela com as telas e as permissões definidas  
                    while($row = $result->fetch_assoc()) {
                        echo('<tr>');
                        //mostra nome da tela em uma coluna


                        echo('<td name="tela'.$row["NOME"].'" value="'.$row["NOME"].'">'.$row["NOME"].'</td>');
                        echo('<td name="tela'.$row["PRONTUARIO"].'" value="'.$row["PRONTUARIO"].'">'.$row["PRONTUARIO"].'</td>');
                        echo('<td name="tela'.$row["EMAIL"].'" value="'.$row["EMAIL"].'">'.$row["EMAIL"].'</td>');
                        echo('<td name="tela'.$row["DATA_CADASTRO"].'" value="'.$row["DATA_CADASTRO"].'">'.$row["DATA_CADASTRO"].'</td>');
                         echo('<td><input type="button" class="btn btn-success" value ="Enviar E-mail" onclick="peganame('.$row["ID"].')" name="'.$row["ID"].'" data-toggle="toggle"></td>');
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

</form>

<form>
    
    </form>
    
  
  </div>

  
</form>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>
</body>
</html>


