

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
	header("location:PrimeiroAcessoAdm.php");
} else {
	
}



include 'fechaConexao.php'
?>




<!DOCTYPE html>
<html>
<head>
	<title>SYSREL</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <style>
.active a{
    background-color : green !important;
}

    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    button {
    background-color: green;
    color: white;
    padding: 10px 10px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 15%;
}

</style>


</head>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="index.php">SYSREL</a>
	    </div>
	  		    <ul class="nav navbar-nav navbar-right ">
			     	<li><a href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			    </ul>
	        </ul>
	      </li>
	    </ul>
	  </div>
	</nav>
	
 
   <?php 

   		session_start();
   		if (isset($_SESSION["ID_USUARIO"])){
			header("location:index_logado.php");
		}

		else if (isset($_SESSION["ALERT"])){
			echo'<div class="alert alert-success alert-dismissible"> 
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  		'.$_SESSION["ALERT"].'
			</div>';

			unset($_SESSION['ALERT']);
		}
	?>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <ul class="nav nav-pills nav-stacked ">
        <li class="active" ><a href="index.php">Inicio</a></li>
      </ul><br>

        <img src="\imagens\IFSP.png"  height="200" width="200""> 
    </div>

    <div class="col-sm-9">
      <h1>Grupos de Pesquisa</h1>

<?php 




include 'abreConexao.php';

//VERIFICA SE Email existe
$sql = "SELECT * FROM `tb_grupo_pesquisa`";

$resultado =  $conexao->query($sql);

$nomeGrupo;
$Descricao;
$Foto;
$Sigla;

	while($row = $resultado->fetch_assoc()){
		$nomeGrupo = $row["NOME"];
		$Foto = $row["LOGOTIPO"];
		$Descricao = $row["DESCRICAO"];
		$Sigla = $row["SIGLA"];
    $DPG = $row["LINK_DGP"];

    $Descricao = str_replace("\n", "<br>", $Descricao);

				?>
		<form method="post" action="login.php">
      <hr>
      <?php
      echo '<h3> '.$nomeGrupo.' ( '.$Sigla.' ) <img src="fotos/'.$Foto.'" class="img-thumbnail" alt="Cinque Terre" height="150" width="150"> </h3>'
        ?>
       

     
     <?php
      echo '<p>'.$Descricao.'</p>'
      ?>

<?php echo "Saiba mais em  " ?>
       <?php 
        echo '<a  href='.$DPG.'>'.$DPG.'  <br></a>'
        ?>  

      <button type="submit"   id="Info" >Mais informações</button>
      <br><br>
      </form>

      <?php

		}



include 'fechaConexao.php'
?>


<?php 
//ITENS INDEX
include 'abreConexao.php';

//VERIFICA SE Email existe
$sql = "SELECT * FROM `tb_itens_index`";

$resultado =  $conexao->query($sql);

$Titulo;
$Descricao;


	while($row = $resultado->fetch_assoc()){
		$Titulo = $row["TITULO"];
		$Descricao = $row["DESCRICAO"];

    $Descricao = str_replace("\n", "<br>", $Descricao);
    

				?>
		<form method="post" action="login.php">
      
      <?php
      echo '<h3> '.$Titulo.' </h3>'
        ?>
     
     <?php
      echo '<p>'.$Descricao.'</p>'

      ?>

      <br><br>
      </form>

      <?php

		}



include 'fechaConexao.php'
?>

	 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta </p>
</footer>

	

	
</body>
</html>