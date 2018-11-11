<!--CODIGO DESENVOLVIDO POR MATHEUS -->
<?php  
session_start();

if (!isset($_SESSION['ID_USUARIO'])){
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html>
<head>
   
<meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="javascript/jquery.min.js"></script>
    <script src="javascript/bootstrap.min.js"></script>
    <link href="css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="javascript/bootstrap-toggle.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: black;
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
input[type=text], input[type=password] {
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

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">SYSREL</a>
        </div>
          <ul class="nav navbar-nav navbar-right">
                    <li><a href="Logoff.php"><span class="glyphicon glyphicon-log-out"></span> Logoff <?php 
                        $usuario;
                        if($_SESSION["TIPO_USUARIO"] == 1){
                        $usuario = "ADMINISTRADOR";
                        }else{
                            $usuario = "LIDER DE PESQUISA";
                        }

                     echo " <br> <b><font color=\"#green\"> Usuario :".$usuario."   </font></b>";
                     echo $_SESSION["NOMEL"];
                      ?></a></li> 

                </ul>
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
           
                <?php 
                     // Inicia a sessão
                    include 'abreConexao.php';

                    $tipo_usuario = $_SESSION["TIPO_USUARIO"];


                    $sql = "";

                    if ($tipo_usuario == 1) {
                        //permissoes do ADM
                        $sql = "SELECT t.DESCRICAO 'nome', t.CAMINHO 'caminho' FROM tb_telas t INNER JOIN tb_permissao_telas p on t.ID = p.ID_TELA_FK and p.ADM = 1";
                    }
                    else if ($tipo_usuario == 2) {
                        //permissoes do LIDER
                        $sql = "SELECT t.DESCRICAO 'nome', t.CAMINHO 'caminho' FROM tb_telas t INNER JOIN tb_permissao_telas p on t.ID = p.ID_TELA_FK and p.LIDER = 1";
                    }

                    $result = $conexao->query($sql);

                    //alimenta menu com telas permitidas    
                    while($row = $result->fetch_assoc()) {
                        echo('<li><a href="'.$row["caminho"].'">'.$row["nome"].'</a></li>');
                    }

                    include 'fechaConexao.php';
        
                ?>
              
            </ul>
          </li>
        </ul>
      </div>
    </nav>

<form method="post">
  <div class="container">
    <h3>Lista de usuários cadastrados:</h3>
    <hr>
    <tr>
                 <table class="table table-striped">
            <thead>
    <tr>
            <th>Nome</th>
            <th>Prontuario</th>
            <th>Email</th>
            <th>Data Cadastro</th>
   
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
                         echo('<td><input type="button"  value ="Enviar E-mail" onclick="peganame('.$row["ID"].')" name="'.$row["ID"].'" data-toggle="toggle"></td>');
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
               

       


  
  

</body>
</html>
