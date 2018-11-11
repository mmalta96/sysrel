
<?php  
session_start();

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
textarea {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    font: bold 18px Arial, Helvetica, sans-serif;
    width: 100%;


}

</style>

<script type="text/javascript">
      function peganame(id){  
           var resposta = confirm("Deseja remover esse registro?");
 
     if (resposta == true) {
          window.location.replace("RemoveItemGrupo.php?id=" + id);  
     }



        
    };
</script>
</head>
<body>
<!-- Navbar (sit on top) -->
  <?php
  include 'MenuNavBarNaoLogado.php';
  ?>
<!-- FIM DO NAV BAR -->
 <br><br><br><br>



 


<form method="post" action="salvaSenhaRecuperacao.php">
  <div class="container">
    <h1>Cadastre uma nova senha</h1>
    <hr>

    <label for="nsenha"><b>Digite a Nova Senha</b></label>
    <input type="password" placeholder="Digite a Senha" name="novasenha" minlength="6" maxlength="15" required>

    <label for="nsenhac"><b>Confirme a Senha</b></label>
    <input type="password" placeholder="Confirme a Senha" name="confirmanovasenha" minlength="6" maxlength="15"  required>
   

<?php 

$chave = $_GET['chave'];

$_SESSION['chave']=$chave;


?>

   
    
    
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
