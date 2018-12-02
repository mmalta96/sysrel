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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="imagens/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon" />
<title>SYSREL</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/bootstrapSkety.min.css">
<script src="javascript/jquery.min.js"></script>
<script src="javascript/bootstrap.min.js"></script>
<link href="css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="javascript/bootstrap-toggle.min.js"></script>
<script src="javascript/moment.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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

.container {
    padding: 16px;
    background-color: #f2f2f2;
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
	<!-- Navbar (sit on top) -->
	<?php
		include 'MenuNavBar.php';
	?>
	<!-- FIM DO NAV BAR -->
	<br><br><br><br><br>

	<div class="container">

		<?php 
			$idGrupo = $_SESSION['idGrupoAtual'];

			include 'abreConexao.php';
			
			$sql = "SELECT * FROM tb_grupo_pesquisa WHERE ID = '$idGrupo';";
			$result = $conexao->query($sql);
			$row = $result->fetch_assoc();
			$sigla = $row["SIGLA"];
			$logotipo = $row["LOGOTIPO"];
		?>
		<h3>Relatórios</h3>

        <center>
        <table class="table table-striped">


             <tr>
                 <td>
                    <p><h4> Linhas de Pesquisa </h4>
                      <a  class="btn btn-info btn-lg" onclick="idRelatorio(1)" data-toggle="modal"  data-target="#modalAno">
                      <span class="glyphicon glyphicon-list"></span> Gerar Relatório
                      </a> 
                    </p> 
                 </td>
             </tr> 
             <tr>
                 <td>   <p><h4> Linha de Pesquisa e Seus Docentes </h4>
                      <a  class="btn btn-info btn-lg" onclick="idRelatorio(2)" data-toggle="modal"  data-target="#modalAno">
                      <span class="glyphicon glyphicon-list"></span> Gerar Relatório
                      </a> 
                    </p> </td>
             </tr> 
             <tr>
                 <td>     
                     <p><h4> Docentes </h4>
                      <a  class="btn btn-info btn-lg" onclick="idRelatorio(3)" data-toggle="modal"  data-target="#modalAno">
                      <span class="glyphicon glyphicon-list"></span> Gerar Relatório
                      </a> 
                    </p> 
                 </td>
             </tr>  
             <tr>
                 <td>
                      <p><h4> Docentes e Suas Linhas de Pesquisa </h4>
                      <a  class="btn btn-info btn-lg" onclick="idRelatorio(4)" data-toggle="modal"  data-target="#modalAno">
                      <span class="glyphicon glyphicon-list"></span> Gerar Relatório
                      </a> 
                      </p>   
                 </td>
             </tr>  
             <tr>
                 <td>
                      <p><h4> Discentes </h4>
                      <a  class="btn btn-info btn-lg" onclick="idRelatorio(5)" data-toggle="modal"  data-target="#modalAno">
                      <span class="glyphicon glyphicon-list"></span> Gerar Relatório
                      </a> 
                      </p> 
                </td>
             </tr> 
             <tr>
                 <td>
                      <p><h4> Discentes e Seus Orientadores </h4>
                      <a  class="btn btn-info btn-lg" onclick="idRelatorio(6)" data-toggle="modal"  data-target="#modalAno">
                      <span class="glyphicon glyphicon-list"></span> Gerar Relatório
                      </a> 
                      </p> 
                 </td>
             </tr> 
             <tr>
                 <td>
                      <p><h4> Discentes, Orientadores e Suas Linhas de Pesquisa </h4>
                      <a  class="btn btn-info btn-lg" onclick="idRelatorio(7)" data-toggle="modal"  data-target="#modalAno">
                      <span class="glyphicon glyphicon-list"></span> Gerar Relatório
                      </a> 
                    </p> 
                 </td>
             </tr> 
             <tr>
                 <td>    
                      <p><h4> Técnicos </h4>
                      <a  class="btn btn-info btn-lg" onclick="idRelatorio(8)" data-toggle="modal"  data-target="#modalAno">
                      <span class="glyphicon glyphicon-list"></span> Gerar Relatório
                      </a> 
                      </p> 
                </td>
             </tr> 
             <tr>
                 <td>
                      <p><h4> Equipamentos </h4>
                      <a  class="btn btn-info btn-lg" onclick="idRelatorio(9)" data-toggle="modal"  data-target="#modalAno">
                      <span class="glyphicon glyphicon-list"></span> Gerar Relatório
                      </a> 
                      </p> 
                 </td>
             </tr> 
             <tr>
                 <td>
                      <p><h4> Publicações </h4>
                      <a  class="btn btn-info btn-lg" onclick="idRelatorio(10)" data-toggle="modal"  data-target="#modalAno">
                      <span class="glyphicon glyphicon-list"></span> Gerar Relatório
                      </a> 
                      </p> 
                 </td>
             </tr> 
             <tr>
                 <td>
                      <p><h4> Projetos de Pesquisa Finalizados </h4>
                      <a  class="btn btn-info btn-lg" onclick="idRelatorio(11)" data-toggle="modal"  data-target="#modalAno">
                      <span class="glyphicon glyphicon-list"></span> Gerar Relatório
                      </a> 
                      </p> 
                 </td>
             </tr> 
                
        </table>
        </center>

        <input type="hidden" name="idRel" id="idRel">

        <script type="text/javascript">
            
            function idRelatorio (id) {
                    document.getElementById("idRel").value = id;
            }

            function redirecionar(){
                var id = document.getElementById("idRel").value;
                var ano = document.getElementById("txtAno").value;

                window.location.replace(id+".php?ano="+ano);
                
            }
        </script>


        <!-- Modal -->
        <div id="modalAno" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Digite o Ano</h4>

                    </div>
                    <div class="modal-body">

                        <form id="formCadastro" name="formCadastro" method="POST">

                            <center>

                            <input type="number" class="number" name="txtAno" id="txtAno" required>
                            <br><br>
                            <input type="button" name="btnSubmit" class="btn btn-success" value="Gerar Relatório" onclick="redirecionar()">

                            </center>

                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>

            </div>
        </div>


        

</div>
<footer class="w3-center w3-light-grey w3-padding-32">
            <p>Desenvolvedores : Emerson Castro | Carlos Moura | Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
        </footer>
</body>
</html>
