

<?php  
session_start();


               $tipo_usuario = $_SESSION["TIPO_USUARIO"];


                    $sql = "";

                    if ($tipo_usuario == 1) {
                        //permissoes do ADM
                        header("location:index.php");
                    }
                    else if ($tipo_usuario == 2) {
                      
                    }

                




?>

<html>
<head>
        <title>Dados Lider de Pesquisa</title>
        <meta charset="utf-8"/>
</head>
<body>
    
    </form>
</body>
</html>





<!--CODIGO DESENVOLVIDO POR MATHEUS -->
<!DOCTYPE html>
<html>
<head>
  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
input[type=text], input[type=password], input[type=url] {
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
</head>
<body>

 
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">SYSREL</a>
      </div>
          <ul class="nav navbar-nav navbar-right">
            
             <?php 
              $usuario;
              
              if($_SESSION["TIPO_USUARIO"] == 1){
              $usuario = "Administrador";
              }else{
                $usuario = "Líder";
              }
              echo("<br>");
              echo " <font color=\"#green\"> Olá, ".$_SESSION["NOMEL"].".".$usuario."    </font>";
            
              ?>
              <b><a href="Logoff.php"><span class="glyphicon glyphicon-log-out"></span> Logoff</a> </b>

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


 


<form method="post" action="VerificaTrocaSenha.php">
  <div class="container">
    <h1>Cadastre uma nova senha</h1>
    <hr>

    <label for="nsenha"><b>Digite sua senha atual:</b></label>
    <input type="password" placeholder="Digite a Senha" name="senhaatual" minlength="6" maxlength="15" required>

    <label for="nsenhac"><b>Digite sua nova senha:</b></label>
    <input type="password" placeholder="Confirme a Senha" name="novasenha" minlength="6" maxlength="15"  required>

     <label for="nsenhac"><b>Confirme sua nova senha:</b></label>
    <input type="password" placeholder="Confirme a Senha" name="confirmanovasenha" minlength="6" maxlength="15"  required>
   



   
    
    
    <button type="submit" class="registerbtn">Salvar</button>
       
     <?php 
  
        if (isset($_SESSION["ALERT"])){
          echo'<div class="alert alert-danger alert-dismissible"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              '.$_SESSION["ALERT"].'
          </div>';

          unset($_SESSION['ALERT']);
        }
      ?>
  </div>
  
  
</form>

</body>
</html>