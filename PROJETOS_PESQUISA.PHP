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
		<h3>Projetos de Pesquisa do Grupo </h3>

		<script type="text/javascript">

			function apagaProjeto(id) {
				var url = 'apagaProjetoSQL.php';
				$.ajax({
					url: url,
					data: 'id=' + id,
					success: function(response) {
						location.reload();
					}
				});
			}


			function pegaDocentes() {

				$("#cbDocente").empty();

				var url = 'pegaDocentesGrupo.php';
				$.ajax({
					url: url,
					data: 'id=' + 1,
					success: function(response) {
						response = '<option value="0">Selecione...</option>' + response;
						document.getElementById("cbDocente").innerHTML += response;
					}
				});
			}


			function pegaLP() {

				$("#selectLinha").empty();

				var idDocente = document.getElementById("cbDocente");

				var itemSelecionado = idDocente.options[idDocente.selectedIndex].value;

				if (itemSelecionado != 0 && idDocente.options[idDocente.selectedIndex].index > 0) {
					var url = 'pegaLinhasDocente.php';
					$.ajax({
						type: 'POST',
						url: url,
						data: 'id=' + itemSelecionado,

						success: function(response) {
							response = '<option value="0">Selecione...</option>' + response;

							document.getElementById("selectLinha").innerHTML += response;
						}
					});
				}
			}


			


			function outroTipo() {
				var tipo = document.getElementById("cbTipo");

				var itemSelecionado = tipo.options[tipo.selectedIndex].value;

				if (itemSelecionado == "Outras") {

					document.getElementById("divOutroTipo").innerHTML = '<h4 id="lblTipo">Digite o tipo:</h4><input type="text" id="txtTipo" name="txtTipo" class="text"><br>';

				} else {
          document.getElementById("txtTipo").remove();
					document.getElementById("lblTipo").remove();
				}
			}

			

		</script>

		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalNovoProjeto" onclick="pegaDocentes()">Cadastrar Novo Projeto</button>
		<hr>
		<?php 
       
				if (isset($_SESSION["ALERT"])){
					echo'<div class="alert alert-success alert-dismissible"> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						'.$_SESSION["ALERT"].'
					</div>';

					unset($_SESSION['ALERT']);
				}


				if (isset($_SESSION["ALERT1"])){
					echo'<div class="alert alert-danger alert-dismissible"> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						'.$_SESSION["ALERT1"].'
					</div>';

					unset($_SESSION['ALERT1']);
				}

      
			?>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Título</th>
					<th>Tipo</th>
					<th>Data Início</th>
					<th>Data Fim</th>
					<th>Docente</th>
					<th>Opções</th>
				</tr>
			</thead>
			<?php 
           include 'abreConexao.php';

           $idGrupo = $_SESSION['idGrupoAtual'];


           
           //sql que pega todas as linhas de pesquisa do grupo
           $sql = "SELECT pp.ID, pp.TITULO, pp.TIPO, DATE_FORMAT(pp.DATA_INICIO,'%d/%m/%Y') AS DATA_INICIO, DATE_FORMAT(pp.DATA_TERMINO,'%d/%m/%Y') AS DATA_TERMINO, d.NOME FROM tb_projeto_pesquisa pp inner join tb_docentes d on pp.ID_DOCENTE_FK = d.ID and pp.ID_GRUPO_FK =".$idGrupo;
            //executo o comando e guardo em uma variavel o resultado
           $result = $conexao->query($sql);
            //alimenta a tabela com as linhas de pesquisa do grupo  

           $aux = 0;
           while($row = $result->fetch_assoc()) {
            $aux = 1;
             echo('<tr>');
             //mostra nome da linha em uma coluna
             echo('<td value="'.$row["ID"].'">'.$row["TITULO"].'</td>');
             echo('<td value="'.$row["TIPO"].'">'.$row["TIPO"].'</td>');
             echo('<td value="'.$row["DATA_INICIO"].'">'.$row["DATA_INICIO"].'</td>');
             echo('<td value="'.$row["DATA_TERMINO"].'">'.$row["DATA_TERMINO"].'</td>');
             echo('<td value="'.$row["NOME"].'">'.$row["NOME"].'</td>');

              echo('<td><input type="button" class="btn btn-danger" value ="Excluir" onclick="apagaProjeto('.$row["ID"].')" data-toggle="toggle"></td>');

              echo('<td><input type="button" class="btn btn-warning" value ="Alterar" onclick="alteraProjeto('.$row["ID"].');" data-toggle="toggle"></td>');

              echo('<td><input type="button" class="btn btn-success" value ="Colaborações" onclick="OrientacoesProjeto('.$row["ID"].');" data-toggle="toggle"></td>');

              echo('<td><input type="button" class="btn btn-primary" value ="Discentes" onclick="DiscentesProjeto('.$row["ID"].');" data-toggle="toggle"></td>');
             
          
            echo('</tr>');


            }
            include 'fechaConexao.php'; 

            if ($aux == 0) {
          echo('<tr>');
          echo('<td name="nulo" value="0">Sem Registros</td>');
          }
          ?>



		</table>


		<!-- Modal -->
		<div id="modalNovoProjeto" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">

						<h4 class="modal-title">Novo Projeto de Pesquisa</h4>
					</div>
					<div class="modal-body">

						<form action="cadastraProjetoPesquisa.php" id="formCadastro" name="formCadastro" method="POST">

							<h4>Título</h4>
							<input type="text" class="text" name="txtTitulo" id="txtTitulo" required>

							<h4>Docente Responsável</h4>
							<SELECT name="cbDocente" id="cbDocente" class="form-control" onchange="pegaLP()">
								<option value="0">Selecione...</option>
							</SELECT>
							<br>

							<h4>Linha de Pesquisa</h4>
							<select name="cbLinhaPesquisa" id="selectLinha" class="form-control">
								<option value="0">Selecione...</option>
							</select>
							<br>

							<h4>Tipo</h4>
							<select name="cbTipo" id="cbTipo" class="form-control" onchange="outroTipo()">
								<option value="0">Selecione...</option>
								<option value="PIBIFSP">PIBIFSP</option>
								<option value="CNPQ">CNPQ</option>
								<option value="Outras">Outras...</option>
							</select>

							<div id="divOutroTipo"></div>
							<br>

							<h4>Data de Início</h4>
							<input type="date" name="dataInicio" id="dataInicio" class="date" required>
							<br>

							<h4>Data de Fim</h4>
							<input type="date" name="dataFim" id="dataFim" class="date">

							<input type="button" name="btnSubmit" id="btnSubmit" class="btn btn-success" value="Cadastrar" onclick="verificaCampos()">

							<div id="divsubmit"></div>

						</form>
					</div>
					<div class="modal-footer">

					</div>
				</div>

			</div>
		</div>


		<script type="text/javascript">

			function verificaCampos() {
				var titulo = document.getElementById("txtTitulo").value.trim();
				var dataInicio = document.getElementById("dataInicio").value;
        var dataFim = document.getElementById("dataFim").value;
				var cbDocente = document.getElementById("cbDocente");
				var docente = cbDocente.options[cbDocente.selectedIndex].value;
				var cbTipo = document.getElementById("cbTipo");
				var tipo = cbTipo.options[cbTipo.selectedIndex].value;
				var cbLinhaPesquisa = document.getElementById("selectLinha");
				var linha = cbLinhaPesquisa.options[cbLinhaPesquisa.selectedIndex].value;



				if (titulo == "") {
					alert("Preencha o título!");
				} else if (docente == 0 || docente < 0) {
					alert("Docente inválido!");
				} else if (linha == 0 || linha < 0) {
					alert("Linha de Pesquisa inválida!");
				} else if (dataInicio == "") {
					alert("Preencha a Data de Início!");
				}
        else if (dataFim != "" && moment(dataInicio).isAfter(dataFim)) {
              alert("Data de Fim menor que a de Início!");
        }
        else if (tipo == 0 || tipo < 0) {
					alert("Selecione um tipo!");
				} else {
					document.getElementById("formCadastro").submit();

				}


			}

			
			function alteraProjeto (id) {
				window.location.replace("alteraProjetoPesquisa.php?id="+id);
			}

      function OrientacoesProjeto (id) {
        window.location.replace("ColaboracaoProjetoPesquisa.php?id="+id);
      }

      function DiscentesProjeto (id) {
        window.location.replace("discentes.php?id="+id);
      }
		</script>

		<br><br><br><br><br><br>
		<footer class="w3-center w3-light-grey w3-padding-32">
			<p>Desenvolvedores : Emerson Castro | Carlos Moura | Matheus Malta <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green"></a></p>
		</footer>


    <!-- Modal -->
<div id="modalvincular" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Selecione os docentes:</h4>
      </div>
      <div class="modal-body">
        <form action="cadastraColaboracao.php" method="POST">


      <?php 
          $idGrupoA = $_SESSION['idGrupoAtual'];
      ?>       

        <select  id="cbCat" onchange="pegaCategoria()" class="form-control">
        <option  value="0">Selecione...</option>
        <?php
        //alimenta a tabela com as linhas de pesquisa do idGrupo
           include 'abreConexao.php';

            //preenche lista com as categorias
            $sql = "SELECT d.NOME as NOME,
             d.ID as ID
          

        FROM tb_docentes d

        inner join tb_docentes_grupo dg
        on d.ID  = dg.ID_DOCENTE_FK
        AND dg.ID_GRUPO = '$idGrupoA' ";

       $result = $conexao->query($sql);

              //alimenta Select 
                while($row = $result->fetch_assoc()) {
                    echo'<option value="'.$row['ID'].'">'.$row["NOME"].'</option>';

                }
                include 'fechaConexao.php'; 
                
                ?>


      </select>


           

    
     <br>
  
    
          <script>
          function pegaCategoria() { 


        var idCat = document.getElementById("cbCat");
        var itemSelecionado = idCat.options[idCat.selectedIndex].value;
        var nomelinha = idCat.options[idCat.selectedIndex].text;
        if (!itemSelecionado == 0 && idCat.options[idCat.selectedIndex].index > 0){
          var url='linhasSelecionadas.php';
          $.ajax({
            type: 'POST',
            url: url,
            data:'id='+itemSelecionado+"&nome="+nomelinha,
            success:function(response){
        //document.getElementById("demo").innerHTML = response;

      var check = document.getElementById('arrayLinhas').value;

     

      var array = check.split(",");

       //document.getElementById("btnLinhas").appendChild(btn);

       var x = 0;

       response = response.split(",");

          
        if (array.includes(response[0])) {
            x = 1;
        }
          

          if (x == 0) {
  

              var a= document.getElementById("arrayLinhas").value;
              if (a == "") {
                   document.getElementById("arrayLinhas").value = response[0];
              }
              else {
                  document.getElementById("arrayLinhas").value = a + "," + response[0] ;
              }
              
              criaBotao(response[0],response[1]);

          }
        


            }
          });


        }
          
      }



      function criaBotao(id,linha){


        var btn = document.createElement('BUTTON');
        var lbl = document.createTextNode(linha);        
         
        btn.appendChild(lbl);   

        btn.setAttribute("class", "btn btn-danger");


        btn.setAttribute("id","btn"+id);

        btn.setAttribute("value",linha);

         btn.onclick = function()
         {
            Excluir(id);
         }

        document.getElementById("btnLinhas").appendChild(btn);
        

      }


      function Excluir(linha){
    
          var vetor = document.getElementById("arrayLinhas").value;
          vetor = vetor.split(",");
          
          vetor.splice(vetor.indexOf(linha), 1);


          document.getElementById("arrayLinhas").value = vetor.toString();

          document.getElementById("btn"+linha).remove();
      }
      
      </script>

      <input type="hidden" id="arrayLinhas" name="arrayLinhas">

      <div  id="btnLinhas">
   
    

            <!-- FIM ADD LINHAS DE PESQUISA -->

          
        
      </div>
      <br><br>
      <div class="modal-footer">
        <input type="submit" name="btn" style="float: right;" value="Salvar" class="btn btn-success">
        </form>
      </div>
    </div>

  </div>
</div>
</body>

</html>
