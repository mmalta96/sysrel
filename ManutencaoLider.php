

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


  <div class="container">
  	<h1>Alteração de Dados do Líder de Pesquisa</h1>
    <hr>

	
		



  <form id="formulario" method="post" enctype="multipart/form-data" action="atualizarUsuarios.php">
        <label for="imagem">Escolha uma foto:</label>
        <input type="file" name="imagem"/><br>
        <h4>Foto Atual.</h4>
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
        <br>	
        <label for="clattes"><b>Currículo Lattes:</b></label><br>
        <?php  
	    echo '<input type="url" required="1" placeholder="Exemplo: http://lattes.cnpq.br/4125550226705204" 
	    value="'.$lattes.'" name="clattes" required><br><br>';
	    ?>
        <br/>
        <label for="clattes"><b>NOME :</b></label><br>
        <?php  
	   	echo  '<input type="text" required="1" value="'.$nome.'" name="nome" required><br><br>';
	    ?>
        <br/>
    <button type="submit" class="registerbtn">Alterar</button>


    

  </div>
  
  
</form>
<div id="visualizar"></div>

</body>
</html>


