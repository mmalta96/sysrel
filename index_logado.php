<?php  
session_start();


if($_SESSION["TIPO_USUARIO"] == 2){
  include 'abreConexao.php';

$id = $_SESSION["ID_USUARIO"];

//VERIFICA SE O LIDER JÁ PREENCHEU OS DADOS INICIAIS
$sql = "SELECT * FROM `tb_lider_pesquisa` where id = '$id'  ";

$resultado =  $conexao->query($sql);
$row = $resultado->fetch_assoc();

if($row['SENHA_ANTIGA'] == "" ){
    header("location:telaPrimeiroAcessoLider.php"); 
}
else if($row['SENHA_ANTIGA'] != "" && $row['CLATTES'] == "" || $row['FOTO'] == ""   ){

     header("location:primeiroAcessoLiderDados.php");   
 
}


            $verificadorGrupo = 0;
            $sql = "SELECT gp.NOME, gp.ID
            FROM tb_grupo_pesquisa gp
            inner join tb_grupo_lider gl
            on gp.ID = gl.ID_GRUPO_FK
            AND gp.SITUACAO = 0
            AND gl.ID_LIDER_FK = $id
            AND GL.DATA_FIM IS NULL

            ;";

            $result = $conexao->query($sql);


            while($row = $result->fetch_assoc()) {
                            $verificadorGrupo = 1;
            }

             


include 'fechaConexao.php';
}else{
   $verificadorGrupo = 0;

}





if (!isset($_SESSION['ID_USUARIO'])){
  header("location:index.php");
} 

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="imagens/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon" />
      <title>SYSREL</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="css/bootstrapSkety.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>


#login {cursor: pointer;}


.active a{
    width: 310%;
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

}

#FT
{
        -webkit-transform: scale(0.8);
        -ms-transform: scale(0.8);
        transform: scale(0.8);
}



/* Full-width input fields */
input[type=text], input[type=password] {
    width: 60%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */


button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}


/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 90%; /* Could be more or less, depending on screen size */

}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 10px;
}




@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
p { font-family: Trebuchet MS, sans-serif; }


</style>



<body>

<!-- Navbar (sit on top) -->
  <?php
  include 'MenuNavBar.php';
  ?>
<!-- FIM DO NAV BAR -->

<!-- Header -->
<br><br><br>
<header class="w3-display-container w3-content w3-wide" style="max-width:1700px;min-width:300px" id="home">
  <div class="w3-center w3-animate-top " style=" background-color:#f2f2f2">
  <p>Sistema de Gerenciamento - SYSREL</p>
    <?php 


//Verifica se tem grupos com indice 0 com o id do usuario
          


            if ($verificadorGrupo == 1) {
echo '<div class="alert alert-primary" role="alert">
  Você foi atribuído a um grupo de pesquisa <a href="http://localhost/telaMostraGruposLider.php" class="alert-link">Clique para acessar</a>. Você deve preencher os dados do grupo.
</div>' ;            }






      if (isset($_SESSION["ALERT"])){
      echo'<div class="alert alert-success alert-dismissible"> 
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          '.$_SESSION["ALERT"].'
      </div>';

      unset($_SESSION['ALERT']);
    }
  ?>
</div>
   <div class=" w3-center w3-animate-top " >
  	  <img class="w3-image w3-animate-top" src="\imagens\SYS.png" alt="Hamburger Catering" width="1200" height="800">
  </div>
  <br><br>
   <div class="w3-container w3-center " style=" background-color:#f2f2f2">
  <h2>Grupos de Pesquisa</h2>
</div>
</header>

<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

<?php 




include 'abreConexao.php';

//VERIFICA SE Email existe
$sql = "SELECT * FROM `tb_grupo_pesquisa` WHERE SITUACAO = 1";

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


        echo '<form method="post" action="'.$Sigla.'">';
        ?>
    
      <hr>
      
       

     
    
      
<div class="card border-light mb-3" style="max-width: 100rem;">
  <div class="card-header"  ><?php
      echo '<h5> <img src="fotos/'.$Foto.'" class="img-thumbnail" id="FT" alt="Cinque Terre" height="150" width="150"> '.$nomeGrupo.' ( '.$Sigla.' )  </h5>'
        ?></div>
  <div class="card-body">
    <p class="card-text"> <?php
      echo '<p>'.$Descricao.'</p>'
      ?>

<?php echo "Acesse ao DPG do Grupo :  " ?>
       <?php 
        echo '<a style="color:steelblue" href='.$DPG.'>'.$DPG.'  <br></a>'
        ?>  

      <button type="submit" class="btn btn-success"   id="Info" >Mais informações</button></p>
  </div>
</div>
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
<!-- End page content -->
</div>





<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>

</body>
</html>
