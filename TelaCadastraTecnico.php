<?php  
session_start();
$id = 2;
if (isset($_SESSION['ID_USUARIO'])){
}
else{
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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"> </script>


</head>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
 
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
input[type=text], input[type=password], input[type=email], input[type=date], input[type=url] {
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

button:hover {
    opacity: 0.8;
}


 button{

  margin: 12px;

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


#myBtn {
    width: 300px;
    padding: 10px;
    font-size:20px;
    position: absolute;
    margin: 0 auto;
    right: 0;
    left: 0;
    bottom: 50px;
    z-index: 9999;
}
</style>

<body>

<body>
<!-- Navbar (sit on top) -->
  <?php
  include 'MenuNavBar.php';
  ?>
<!-- FIM DO NAV BAR -->
<bR><bR><br>
<div>

  <div class="container">
    <h1>Cadastro de Técnico</h1>
    <hr>

<?php 
        if (isset($_SESSION["ALERT"])){
            echo'<div class="alert alert-danger alert-dismissible"> 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                '.$_SESSION["ALERT"].'
            </div>';

            unset($_SESSION['ALERT']);
        }
    ?>


       <form id="formulario" method="post" enctype="multipart/form-data" action="VerificaCadastroTecnico.php">

       <label for="clattes"><b>Nome :</b></label>
         
      <input type="text" placeholder="Digite o nome do técnico" required="1" name="nome" required><br>
    

     <h4 class="card-title">Foto do Técnico:</h4>

            <p class="card-text">Selecione uma foto no botão abaixo</p>

            <img src="" class="img-circle" style="display:none" height="200px" width="200px" id="image"><br>
            <input type="file" onchange="showImage.call(this)"  required="" name="imagem" > 

            <script>
              function showImage(){
                if(this.files && this.files[0]){
                  var obj = new FileReader();
                  obj.onload = function(data){
                    var image = document.getElementById("image");
                    image.src = data.target.result;
                    image.style.display = "block";
                  }
                  obj.readAsDataURL (this.files[0]);


                }
              }
            </script><br>

 
        <label for="clattes"><b>Currículo Lattes:</b></label><br>
        <?php  
      echo '<input type="url" required="1" placeholder="Exemplo: http://lattes.cnpq.br/4125550226705204" 
       name="clattes" required><br><br>';
      ?>
        
<label for="descricao"><b>Atividade do técnico no grupo:</b></label><br>
<textarea name="descricao" minlength="10" placeholder="Digite a atividade do técnico no grupo" required id="descricao" rows="3" cols="100">  </textarea>
<br><br>



   <label for="text"><b>Titulação</b></label><br>
   <select class="form-control" id="" name="titulacao">
      
        
        <?php  
                include 'abreConexao.php';

                $sql = "SELECT `NOME`,`ID` FROM `tb_titulacao`";

                $result = $conexao->query($sql);

              //alimenta Select 
                while($row = $result->fetch_assoc()) {
                    echo'<option value="'.$row['ID'].'">'.$row["NOME"].'</option>';

                }
                include 'fechaConexao.php'; 
                
                ?>


      </select>

<br>
     <label for="text"><b>Descrição da Titulação</b></label>
    <input type="text" placeholder="Digite qual o tipo de Titulação realizada" maxlength="60" name="desc" required>

<br>
<label>Data de Conclusão do Curso: </label><br>
    
    <input type="date" name="dataConclusao" required>

<br>
<br>




    <label>Data de Inicio do Vinculo: </label><br>
    
    <input type="date" name="dataVinculo" required>
    

    <hr>
 



    <button type="submit" class="registerbtn">Salvar</button>


    

  </div><br>

 
  
  
</form>
<div id="visualizar"></div>

</body>
</html>


