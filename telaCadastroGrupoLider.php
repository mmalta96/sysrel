

<?php  
session_start();

  $idGrupoAtual = ($_GET["id"]);

$_SESSION['idGrupoAtual']=$idGrupoAtual;


               $tipo_usuario = $_SESSION["TIPO_USUARIO"];


                    $sql = "";

                    if ($tipo_usuario == 1) {
                        //permissoes do ADM
                        header("location:index.php");
                    }
                    else if ($tipo_usuario == 2) {
                      
                    }

                

$_SESSION['grupo']=$idGrupoAtual;


?>

<html>
<head>
        <title>Dados Grupo de Pesquisa</title>
        <meta charset="utf-8"/>

    
</script>
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
 <link rel="stylesheet" href="css/bootstrapSlate.min.css">
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

textarea {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    font: bold 18px Arial, Helvetica, sans-serif;
    width: 100%;


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

   /* 	$sql = "SELECT * FROM `tb_grupo_lider` WHERE ID_LIDER_FK = $id;";
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
    $data;

		if($row = $result->fetch_assoc()){
		$sigla = $row["SIGLA"];	
		$nome = $row["NOME"];
		$logotipo = $row["LOGOTIPO"];
		$descricao = $row["DESCRICAO"];
		$email = $row["EMAIL"];
		$lattes = $row["LINK_DGP"];
    $data = $row ["DATA_INICIO"];
		}


?>

<?php 
             $id = $_SESSION["ID_USUARIO"];



        if (isset($_SESSION["ALERT"])){
            echo'<div class="alert alert-success alert-dismissible"> 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                '.$_SESSION["ALERT"].'
            </div>';

            unset($_SESSION['ALERT']);
        }
    ?>


	<div class="container">
	  	<h1>Dados do Grupo de Pesquisa</h1>

	    <hr>

      <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
Trocar Lider</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Troca de Lider de Pesquisa</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="VerificaTrocaLider.php" method="post">
      <div class="modal-body">

        <label for="">Para realizar a alteração é necessário escolher um líder diferente do atual.</label>
        <select class="form-control" required name="lider">
            <option value="">Selecione o novo lider</option><br>

        <?php
        include 'abreConexao.php';

        //Pega ID do grupo qe eu acabei de inserir
        $sql = "SELECT * FROM `tb_grupo_lider` WHERE ID_GRUPO_FK = $idGrupoAtual ORDER BY ID DESC ;  ";
        $resultado =  $conexao->query($sql);
        
        if ($row = $resultado->fetch_assoc()) {
        $idLiderAtual = $row["ID_LIDER_FK"];  
        }



        $sql = "SELECT * FROM `tb_lider_pesquisa` WHERE NOT ID = $idLiderAtual";
        $result = $conexao->query($sql);


        while($row = $result->fetch_assoc()) {

        echo('<option  value="'.$row['ID'].'">'.$row['NOME'].'</option>');

        }
        


            ?>



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

  <form id="formulario" method="post" enctype="multipart/form-data" action="verificaCadastroGrupoLider.php">

  	<?php 
  		$foto = "\\"."fotos"."\\".$logotipo;

        if ($foto == "") {	
        	echo '<img src="'."\\fotos\\user-padrao".'" class="img-fluid img-thumbnail" width="200px" height="200px" alt="...">';
        }else {
        	 echo '<img src="'.$foto.'" class="img-fluid img-thumbnail" width="200px" height="200px" alt="...">';
        }
  	 ?>
  	<br>	
    <br><br>	
	<label for="imagem">Trocar foto:</label>
    <input type="file" name="imagem"/><br><br>

     <label for="nome"><b>Nome :</b></label><br>
    <?php  
   	echo  '<input type="text" required="1" value="'.$nome.'" name="nome" required><br><br>';
    ?>

    <label for="sigla"><b>Sigla :</b></label><br>
    <?php  
   	echo  '<input type="text" required="1" value="'.$sigla.'" name="sigla" required><br><br>';
    ?>

  	<label for="email"><b>Email :</b></label><br>
    <?php  
   	echo  '<input type="email"  value="'.$email.'" name="email"><br>';
    ?>

  	<label for="descricao"><b>Descrição :</b></label><br>
    <?php
    echo '<textarea name="descricao" required id="descricao" rows="8" cols="100"> '.$descricao.' </textarea>';
    ?><br><br>

  <label for="clattes"><b>Lattes:</b></label><br>
	<?php  
	echo '<input type="url" required placeholder="Exemplo: http://lattes.cnpq.br/4125550226705204" 
	value="'.$lattes.'" name="clattes" ><br><br>';
	?>

	<?php  

$dataCerta = date('d/m/Y', strtotime($data));

   	echo  '
    <label>Data Inicio do Grupo: '.$dataCerta.' </label><br>
    
    <input type="date"  required value="'.$dataCerta.'" name="data">
    ';
    ?>

<br>	
    <button type="submit" class="registerbtn">Alterar</button>
  

  </div>
</form>
<div id="visualizar"></div>


</body>

<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>
</html>


