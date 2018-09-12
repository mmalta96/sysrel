<?php 
  session_start();

if (!isset($_SESSION['ID_USUARIO'])){
    
}else{
  header("location:index.php");
}




 ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="javascript/jquery.min.js"></script>
    <script src="javascript/bootstrap.min.js"></script>
    <link href="css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="javascript/bootstrap-toggle.min.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}



button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 30%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
</head>
<body>
<div class="container">
<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
    <form method="post" action="VerificaAdministrador.php">
      <div class="imgcontainer">
        <a href="index.php"><img src="\imagens\SYSREL.png"  alt="Avatar" class="avatar"></a>
      </div>

      
        <label for="uname"><b>Login</b></label>
        <input id="Usuario" type="text" placeholder="Digite seu Login ou Prontuário" name="uname" required>

        <label for="psw"><b>Senha</b></label>
        <input id="Senha" type="password" placeholder="Digite sua Senha" name="psw" required>
            
        <button type="submit" id="BOTAOLOGIN" >Entrar</button>
        <br>
        <span class="psw"><a href="telaRecuperacaoSenha.php">Esqueceu a Senha?</a></span>
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

  </div>
  <div class="col-sm-2"></div>
   
  </div>
</body>
</html>
