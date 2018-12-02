
<?php  
session_start();
$id = 2;
if (isset($_SESSION['ID_USUARIO']) && $_SESSION["TIPO_USUARIO"] == 1){
}
else{
    header("location:index.php");
}
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
      function pegaID(id){  
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
  include 'MenuNavBar.php';
  ?>
<!-- FIM DO NAV BAR -->
 <br><br><br><br>


<form method="post">
  <div class="container">
    <h3>Lista de Itens Adicionados:</h3>
  <?php 
      if (isset($_SESSION["ALERT"])){
      echo'<div class="alert alert-success alert-dismissible"> 
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          '.$_SESSION["ALERT"].'
      </div>';

      unset($_SESSION['ALERT']);
    }
  ?>

    <tr>
                 <table class="table table-striped">
            <thead>
    <tr>
            <th>Titulo</th>
            <th>Desrição</th>
            <th>Desrição</th>
   
   </tr>
   </thead>

<?php 


                    include 'abreConexao.php';

                    //sql que pega todas as telas e permissões
                    $sql = "SELECT * FROM `tb_itens_index`";

                    //executo o comando e guardo em uma variavel o resultado
                    $result = $conexao->query($sql);

                    //alimenta a tabela com as telas e as permissões definidas  
                    while($row = $result->fetch_assoc()) {
                        echo('<tr>');
                        //mostra nome da tela em uma coluna


                        echo('<td name="tela'.$row["TITULO"].'" value="'.$row["TITULO"].'">'.$row["TITULO"].'</td>');
                        echo('<td name="tela'.substr($row["DESCRICAO"],0 ,100).'" value="'.substr($row["DESCRICAO"],0 ,100).'">'.substr($row["DESCRICAO"],0 ,100).''."...".'</td>');
                       
                          echo('<td><input type="button" class="btn btn-danger" value ="Remover Item" onclick="pegaID('.$row["ID"].')" name="'.$row["ID"].'" data-toggle="toggle"></td>');
/*
                        //verifica se ta permitido no banco pra mostrar checkbox checado
                        if ($row["lider"] == "1") {
                            echo('<td><input type="checkbox" name="'.$row["id"].'LIDER" checked data-toggle="toggle"></td>');
                        }
                        else if ($row["lider"] == "0") {
                            echo('<td><input type="checkbox" name="'.$row["id"].'LIDER" data-toggle="toggle"></td>');
                        }
*/
                        echo('</tr>');


                    }
                    include 'fechaConexao.php'; 
 ?>

</table>

</form>

<form>
    
    </form>
    
  
  </div>

  
</form>

<div class="container">
  
   
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Adicionar	</button>
  <br><br>
<p> Clique aqui para adiconar um novo Item. <p>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title">Adicionando Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
        	 <form method="post" action="AdicionaItem.php">
        	<h3> Digite o Titulo <h3>
          <textarea name="Titulo" id="Titulo" rows="05" ></textarea>
          <br><br>
          <h3> Digite a Descrição <h3>
          <textarea  name="Descricao" id="Descricao" rows="30" ></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" >Confirmar</button>
            </form>
        </div>
      </div>
      
    </div>
  </div>
   
</div>
<br><br><br>
<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>

</body>
</html>


