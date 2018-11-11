

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
        <title>Dados Equipento</title>
        <meta charset="utf-8"/>

</head>
<body>
    
    </form>
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

* {
    box-sizing: border-box;
}

/* Add padding to containers */
.container {
    padding: 16px;
    background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email],input[type=url] {
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
<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card"">
    <a href="index.php" class="w3-bar-item w3-button">SYSREL</a>

    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right">
             <?php 
              $usuario;
              
              if($_SESSION["TIPO_USUARIO"] == 1){
              $usuario = "Administrador  ";
              }else{
                $usuario = "Líder   ";
              }
            
              echo " <font class='w3-bar-item w3-hide-small' > Olá, ".$_SESSION["NOMEL"].".".$usuario." ".'&nbsp'."  </font>";
            
              ?>
              <a href="Logoff.php"><span class="glyphicon glyphicon-log-out w3-bar-item w3-button">Logoff</span> </a>
    </div>
      <a class="dropdown ">
          <a class="dropdown-toggle w3-bar-item"  data-toggle="dropdown" href="#">Menu
         
         </a>
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
        </a>
  </div>
</div>

<br><br>






  <div class="container">
    <h1>Alterar dados Equipamento</h1>
    <hr>

  <form id="formulario" method="post" enctype="multipart/form-data" action="VerificaAlteraEquipamento.php">
       
     
        <?php 
    
    include 'abreConexao.php';

    $idEquipamento = $_GET["id"];


       $sql = "SELECT * FROM tb_equipamentos WHERE ID = '$idEquipamento';";
    $result = $conexao->query($sql);

    if($row = $result->fetch_assoc()){
    $nome = $row["NOME"];
    $descricao = $row["DESCRICAO"];
    $datainicio = $row["DATA_INICIO"];
    $dataInicioCerta = date('d/m/Y', strtotime($datainicio));
   }

       
?>

 <label for="clattes"><b>Nome :</b></label>
        <?php  
      echo  '<input type="text"  value="'.$nome.'" name="nome" ><br><br>';
      ?>
        

<label for="descricao"><b>Descrição:</b></label><br>
<?php
    echo '<textarea name="descricao"  id="atividade" rows="8" cols="100"> '.$descricao.' </textarea>';
    ?><br><br>


    <label>Data de Inicio do Vinculo: <?php echo $dataInicioCerta; ?> </label><br>
    

     <?php  

      echo  '   <input type="date"   value="" name="dataVinculo"><br><br>';
      ?>

      <?php echo '<input type="hidden" id="custId" name="idEquipamento" value="'.$idEquipamento.'">'; ?>


 
    <button type="submit" class="registerbtn">Alterar</button>

  


</body>
</html>


