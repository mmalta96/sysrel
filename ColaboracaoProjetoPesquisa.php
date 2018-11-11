<!DOCTYPE html>
<html>
<head>
	<title></title>
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
	<script type="text/javascript">
		function apagaColaboracao(id) {
				var url = 'apagaColaboracaoSQL.php';
				$.ajax({
					url: url,
					data: 'id=' + id,
					success: function(response) {
						location.reload();
					}
				});
			}


	</script>
</head>
<body>
		<!-- Navbar (sit on top) -->
	<?php
		session_start();
		include 'MenuNavBar.php';
	?>
	<!-- FIM DO NAV BAR -->
	<br><br><br><br><br>

	<div class="container">
		<?php 
			
			$idProjeto = $_GET["id"];

			include 'abreConexao.php';
			
			$sql = "SELECT * FROM tb_projeto_pesquisa WHERE ID = $idProjeto";
			$result = $conexao->query($sql);
			$row = $result->fetch_assoc();
			echo "<h2>".$row["TITULO"]."</h2>";
		?>
		<h3>Colaborações do Projeto de Pesquisa</h3>

		<br><br>

		<input type="button" class="btn btn-success" value ="Nova Colaboração" data-toggle="modal" data-target="	#modalvincular">
		<br><br>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Docente</th>
					<th>Opções</th>
				</tr>
			</thead>
			<?php 



	  
	           //sql que pega todas as linhas de pesquisa do grupo
	           $sql = "SELECT pc.ID, d.NOME from tb_docentes d inner join tb_projeto_colaboracao
	            pc on pc.ID_DOCENTE_FK = d.ID and pc.ID_PROJETO_FK = ".$idProjeto;
	            //executo o comando e guardo em uma variavel o resultado
	           $result = $conexao->query($sql);
	            //alimenta a tabela com as linhas de pesquisa do grupo  

	           $aux = 0;
	           while($row = $result->fetch_assoc()) {
	            $aux = 1;
	             echo('<tr>');
	             //mostra nome da linha em uma coluna
	             echo('<td value="'.$row["ID"].'">'.$row["NOME"].'</td>');

	              echo('<td><input type="button" class="btn btn-danger" value ="Excluir" onclick="apagaColaboracao('.$row["ID"].')" ></td>');
	            
	            echo('</tr>');


	            }
	            include 'fechaConexao.php'; 

	            if ($aux == 0) {
		            echo('<tr>');
		            echo('<td name="nulo" value="0">Sem Registros</td>');
	            }
	        ?>

		</table>



	</div>



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

        inner join tb_docente_grupo dg
        on d.ID  = dg.ID_DOCENTE_FK
        AND dg.ID_GRUPO_FK = '$idGrupoA' ";

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
      <?php 

      		echo '<input type="hidden" value="'.$_GET["id"].'" name="projeto" id="projeto">';

      ?>

      <div  id="btnLinhas">

          
        
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