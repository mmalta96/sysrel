
<?php 



include 'abreConexao.php';

//VERIFICA SE Email existe
$sql = "SELECT * FROM `tb_administrador`";

$resultado =  $conexao->query($sql);
$verificador = 0;
$quantidadeDisponivel = 5;

$consulta = $conexao->query($sql);
$conta = $consulta->fetch_assoc();
if (empty($conta))
{
    //SE NÃO HOUVER ADMNISTRADORES, CHAMA PAGINA DE CADASTRO
    
} else {
    header("location:index.php");
}



include 'fechaConexao.php'
?>



 
!DOCTYPE html>
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
    background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email],input[type=url] ,input[type=date]{
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



<body>
<!-- Navbar (sit on top) -->
  <?php
  include 'MenuNavBarZero.php';
  ?>
<!-- FIM DO NAV BAR -->
 <br><br>


<form method="post" action="VerificaPassword.php">
  <div class="container">
    <h1>Primeiro Acesso ao Sistema</h1>
    <h3>Cadastro de Administrador</h3>
    <hr>

    <label for="email"><b>Login</b></label>
    <input type="text" placeholder="Digite o Login..." name="login" maxlength="70" required>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Digite o Email..." name="email" maxlength="70" required>

    <label for="psw"><b>Senha</b></label>
    <input type="password" placeholder="Digite a senha..." minlength="6 placeholder="Digite a Senha" name="psw" maxlength="70" required>

    <label for="psw-repeat"><b>Repitir Senha</b></label>
    <input type="password"  placeholder="Repita a senha..." minlength="6 placeholder="Repita a Senha" name="psw-repeat" maxlength="70" required>
    <hr>

                        <?php 

                        session_start();
                                if (isset($_SESSION["ALERT"])){
            echo'<div class="alert alert-danger alert-dismissible"> 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                '.$_SESSION["ALERT"].'
            </div>';

            unset($_SESSION['ALERT']);
        }


                      ?>
    
    <button type="submit" class="registerbtn">Cadastrar</button>

  </div>
  </form>
<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>
</body>
</html>
