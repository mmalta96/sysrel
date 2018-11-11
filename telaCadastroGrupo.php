
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
    background-color:white;
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
</style>


<script type="text/javascript">
    function peganame(id){  
        window.location.replace("envia_email.php?id=" + id);
    };
</script>
</head>
<body>
   <!-- Navbar (sit on top) -->
  <?php
  include 'MenuNavBar.php';
  ?>
<!-- FIM DO NAV BAR -->
<BR><BR><BR><BR>
 

<form method="post" action="VerificaCadastroGrupo.php">
    <div class="container">
        <h1>Cadastro de grupo de pesquisa</h1>
        <p>Insira os dados para efetuar o cadastro:</p>

        <label for="nomegrupo"><b>Nome</b></label><br>
        <input type="text" placeholder="Digite o Nome" name="nomegrupo" required maxlength="70"><br><br>
        <label for="sigla"><b>Sigla</b></label><br>
        <input type="text" placeholder="Digite a Sigla do Grupo" name="sigla" required maxlength="10"><br>
        <label for="sigla"><b>Líder do Grupo:</b></label><br>
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
    <br><br><br><br><br><br>
    <footer class="w3-center w3-light-grey w3-padding-32">
  <p>Desenvolvedores : Emerson Castro |  Carlos Moura |  Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
</footer>
</body>

</html>
