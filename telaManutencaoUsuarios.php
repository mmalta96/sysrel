

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
  include 'MenuNavBar.php';
  ?>
<!-- FIM DO NAV BAR -->

<br><br>






  <div class="container">
  	<h1>Alteração de Dados do Líder de Pesquisa</h1>
    <hr>


		






  <form id="formulario" method="post" enctype="multipart/form-data" action="atualizarUsuarios.php">
    
      <!-- Button to Open the Modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
	Trocar Senha</button><br><br>


        <?php 
    
        
        
        
         $id = $_SESSION["ID_USUARIO"];

         include 'abreConexao.php';
         $sql = "SELECT * FROM tb_lider_pesquisa WHERE ID = '$id';";
	     $result = $conexao->query($sql);

		$nome;
		$fotoselecionada;
		$lattes;

		if($row = $result->fetch_assoc()){
		$nome = $row["NOME"];
		$fotoselecionada = $row["FOTO"];
		$lattes = $row["CLATTES"];

		}

		$foto = "\\"."fotos"."\\".$fotoselecionada;

        if ($foto == "") {	
        	echo '<img src="'."\\fotos\\user-padrao".'" class="img-circle" width="200px" height="200px" alt="...">';
        }else {
        	 echo '<img src="'.$foto.'" class="img-circle" width="200px" height="200px" alt="...">';
        }

		include 'fechaConexao.php';
        ?>



        <br>	
        <br><br>	

        <label for="imagem">Trocar foto:</label>
        <input type="file" name="imagem"/><br><br>


        <label for="clattes"><b>Currículo Lattes:</b></label><br>
        <?php  
	    echo '<input type="url" required="1" placeholder="Exemplo: http://lattes.cnpq.br/4125550226705204" 
	    value="'.$lattes.'" name="clattes" required><br><br>';
	    ?>
        
        <label for="clattes"><b>Nome :</b></label><br>
        <?php  
	   	echo  '<input type="text" required="1" value="'.$nome.'" name="nome" required><br><br>';
	    ?>



        <br/>
    <button type="submit" class="registerbtn">Alterar</button>


    

  </div>


  
  
</form>
<div id="visualizar"></div>

   
       <?php 
        if (isset($_SESSION["ALERT"])){
          echo'<div class="alert alert-danger alert-dismissible"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              '.$_SESSION["ALERT"].'
          </div>';

          unset($_SESSION['ALERT']);
        }
      ?>

      <?php 
        if (isset($_SESSION["ALERT1"])){
            echo'<div class="alert alert-success alert-dismissible"> 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                '.$_SESSION["ALERT1"].'
            </div>';

            unset($_SESSION['ALERT1']);
        }
    ?>



<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Troca de senha lider</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="VerificaTrocaLider.php" method="post">
      <div class="modal-body">

        <label for="">Antiga Senha.</label>
        <input type="password" name="senhaAntiga" required><br>
           <label for="">Nova Senha.</label>
        <input type="password" name="novaSenha" required><br>

   <label for="">Confirma Senha.</label>
        <input type="password" name="confirmaNovaSenha" required><br>


       

            </select><br>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <input type="submit" value="Alterar" class="btn btn-primary">
         </form>
      </div>

    </div>
  </div>
</div><br><br>


</body>
</html>


