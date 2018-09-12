<?php  
session_start();
$id  =  $_SESSION['ID_USUARIO'];

        include 'abreConexao.php';

//VERIFICA SE JÁ NÃO SALVOU ESTE USUARIO
$sql = "SELECT * FROM `tb_lider_pesquisa` where id = $id ";

$resultado =  $conexao->query($sql);
$verificador = 0;

while($row = $resultado->fetch_assoc()){

if($row['CLATTES'] == "" || $row['FOTO'] == ""  ){

}else{

     header("location:index.php");  
 
}
}


include 'fechaConexao.php'


?>

<html>
<head>
        <title>Upload de imagens com PHP</title>
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
</head>
<body>

   <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">SYSREL</a>
        </div>
          <ul class="nav navbar-nav navbar-right">
                    
                     <?php 

                       


        if (isset($_SESSION["ALERT"])){
          echo'<div class="alert alert-danger alert-dismissible"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              '.$_SESSION["ALERT"].'
          </div>';

          unset($_SESSION['ALERT']);
        }
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



  <div class="container">
  	<h1>Passo 2.</h1>
    <h2>Insira os dados abaixo para completar seu cadastro.</h2>
    <hr>

	
		



  <form id="formulario" method="post" enctype="multipart/form-data" action="upload.php">
        <label for="imagem">Escolha uma foto:</label>
        <input type="file" required="" name="imagem"/><br>

        <label for="clattes"><b>Currículo Lattes:</b></label><br>
	    <input type="text" required="1" placeholder="Exemplo: http://lattes.cnpq.br/4125550226705204" name="clattes" required><br><br>
        <br/>
    <button type="submit" class="registerbtn">Cadastrar</button>


    

  </div>
  
  
</form>
<div id="visualizar"></div>

</body>
</html>
