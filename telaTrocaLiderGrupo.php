

<?php  
session_start();

$idGrupoAtual = 0;


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
        <title>Dados Grupo de Pesquisa</title>
        <meta charset="utf-8"/>

    
</script>
</head>
<body>
    
    
</body>
</html>





<!--CODIGO DESENVOLVIDO POR MATHEUS -->
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
body {font-family: "Times New Roman", Georgia, Serif;}
h1,h2,h3,h4,h5,h6 {
    font-family: "Playfair Display";
      letter-spacing: 5px;
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
  include 'MenuNavBar.php';
  ?>
<!-- FIM DO NAV BAR -->
 <br><br><bR><br><br>



       
        <?php 
    
        
        
        
         $id = $_SESSION["ID_USUARIO"];


       include 'abreConexao.php';

   /*   $sql = "SELECT * FROM `tb_grupo_lider` WHERE ID_LIDER_FK = $id;";

      $result2 = $conexao->query($sql);
     if ($row = $result2->fetch_assoc()) {
     $idGrupo = $row["ID_GRUPO_FK"];
     }*/

        $sql = "SELECT * FROM tb_grupo_pesquisa WHERE ID = '$idGrupoAtual';";
       $result = $conexao->query($sql);
    
    $sigla;
    $nome;
    $logotipo;
    $descricao;
    $email;
    $lattes;

    if($row = $result->fetch_assoc()){
    $sigla = $row["SIGLA"]; 
    $nome = $row["NOME"];
    $logotipo = $row["LOGOTIPO"];
    $descricao = $row["DESCRICAO"];
    $email = $row["EMAIL"];
    $lattes = $row["LINK_DGP"];

    }


?>



  <div class="container">
      <h1>Dados do Grupo de Pesquisa</h1>

      <hr>

<div id="visualizar"></div>



<form method="post" action="VerificaCadastroGrupo.php">
    <div class="container">
        
  <h3>Atual Lider: </h3><br>
  <h3>Selecione o novo lider: </h3>
      
        <select class="form-control" required name="lider">
            <option value="">Selecione</option>
        <?php
        include 'abreConexao.php';

        $sql = "SELECT * FROM `tb_lider_pesquisa`";
        $result = $conexao->query($sql);


        while($row = $result->fetch_assoc()) {
        echo('<option  value="'.$row['ID'].'">'.$row['NOME'].'</option>');

        }
        


            ?>



            </select><br>



            <button type="submit" class="registerbtn">Cadastrar</button>

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

</form>


</body>

<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>
</html>


