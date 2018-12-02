
<style>

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


</style>

<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" >
    <a href="index.php" class="w3-bar-item w3-button">SYSREL</a>

                    <script>   // COMBOBOX MENUBAR
                     function myFunction() {
                    var x = document.getElementById("Demo");
                    if (x.className.indexOf("w3-show") == -1) {
                        x.className += " w3-show";
                    } else { 
                        x.className = x.className.replace(" w3-show", "");
                    }
                    }
                     </script>


    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right">
             <?php 
              $usuario;
              
              if($_SESSION["TIPO_USUARIO"] == 1){
              $usuario = "Administrador  ";
              }else{
                $usuario = "Líder   ";
              }




                if( $_SESSION["TIPO_USUARIO"] == 2){
                    if($_SESSION['idGrupoAtual'] == ""){
                          ?>
                         <a id="login" data-toggle="modal" data-target="#id01" ><span  class="w3-button pull-left"><img src="imagens/grupos.ico"></span></a>
                         <a href="Logoff.php"><span  class="glyphicon glyphicon-log-out w3-bar-item w3-button pull-right"> Logoff</span> </a>
                         <?php
                           // EXIBE O NOME USUARIO LOGADO
                       echo " <font class='w3-bar-item w3-hide-small' > Olá, ".$_SESSION["NOMEL"].".".$usuario." ".'&nbsp'."  </font>";

                    }else{
                         // CASO O USUARIO SEJA UM LIDER E TENHA UM GRUPO SELECIONADO VEM PARA CÁ.
                 
                ?>
                    <a id="login" data-toggle="modal" data-target="#id01" ><span  class="w3-button pull-left"><img src="imagens/grupos.ico"></span></a>

                    <?php
                    
                    // EXIBE O NOME DO GRUPO
                    $id = $_SESSION['idGrupoAtual'];

                    include 'abreConexao.php';
                   $sql = "SELECT NOME FROM `tb_grupo_pesquisa` WHERE `ID` = $id  ";

                   $result = $conexao->query($sql);
                     while($row = $result->fetch_assoc()) {
                            $GrupoSelecionado = $row['NOME'];
                                        }
                   include 'fechaConexao.php';

                    




           ?>

  <div class="w3-dropdown-click w3-hide-small">
    <?php
     echo " <font onclick='myFunction()' class= w3-button  data-toggle='dropdown' data-toggle='dropdown' > Grupo, ".$GrupoSelecionado."".'&nbsp'."  </font>";
                      ?>
    <div id="Demo" class="w3-dropdown-content w3-bar-block w3-card-4 w3-animate-zoom">
      <a href="cadastroDocentes.php" class="w3-bar-item w3-button">DOCENTES</a>
        <a href="CADASTROLINHAPESQUISA.PHP" class="w3-bar-item w3-button">LINHAS DE PESQUISA</a>
        <a href="TECNICOS.PHP" class="w3-bar-item w3-button">TECNICOS</a>
            <a href="PUBLICACOES.PHP" class="w3-bar-item w3-button">PUBLICAÇÕES</a>
            <a href="PROJETOS_PESQUISA.PHP" class="w3-bar-item w3-button">PROJETOS DE PESQUISA</a>
             <a href="EQUIPAMENTOS.PHP" class="w3-bar-item w3-button">EQUIPAMENTOS</a>
             <a href="REUNIOES.PHP" class="w3-bar-item w3-button">REUNIÕES</a>
             <a href="RELATORIOS.PHP" class="w3-bar-item w3-button">RELATÓRIOS</a>
       </div>
  </div>

                      <?php

                                  // EXIBE O NOME USUARIO LOGADO
                       echo " <font class='w3-bar-item w3-hide-small' > Olá, ".$_SESSION["NOMEL"].".".$usuario." ".'&nbsp'."  </font>";
                    
                    ?>
                     <a href="Logoff.php"><span  class="glyphicon glyphicon-log-out w3-bar-item w3-button pull-right"> Logoff</span> </a>
                  <?php

                    }
                }if( $_SESSION["TIPO_USUARIO"] == 1){


                              // EXIBE O NOME USUARIO LOGADO
                       echo " <font class='w3-bar-item w3-hide-small' > Olá, ".$_SESSION["NOMEL"].".".$usuario." ".'&nbsp'."  </font>";
                  ?>
                     <a href="Logoff.php"><span  class="glyphicon glyphicon-log-out w3-bar-item w3-button pull-right"> Logoff</span> </a>
                     <?php
                }

                ?>





             


    </div>
      <a class="dropdown ">
          <a class="dropdown-toggle w3-bar-item"  data-toggle="dropdown" href="#">Menu </a>
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
        </a>
  </div>
</div>



<!-- Modal dos Grupos -->
      <!-- Modal content-->
  <div class="modal fade" id="id01" role="dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Meus Grupos de Pesquisa</h3>
        </div>
        <div class="modal-body">
              <form method="post">
  <div class="container">
    
    <hr> <?php 
             $id = $_SESSION["ID_USUARIO"];



 
    ?>

    <tr>
                 <table class="table table-striped" >
            <thead>
    <tr>  
            <th></th>
            <th>Nome</th>
            <th>Sigla</th>
            <th>Selecionar Grupo</th>
          
   </tr>






   </thead>

<?php 


                    include 'abreConexao.php';

                     $sql = "SELECT * FROM `tb_grupo_lider` WHERE ID_LIDER_FK = $id;";
                     $result = $conexao->query($sql);
                     while($row = $result->fetch_assoc()) {
                     $idGrupo = $row["ID_GRUPO_FK"];
                     }


                    //PEGA A PAGINA ATUAL e manda para o Peganame
                    $server = $_SERVER['SERVER_NAME'];

                    $endereco = $_SERVER ['REQUEST_URI'];
                    $endereco = str_replace('/', '', $endereco);
                    $_SESSION["PAGINA_ATUAL"] = $endereco;
                    





                    $sql ="    SELECT gp.NOME, gp.LOGOTIPO, gp.ID, gp.SIGLA, gp.DATA_INICIO, gp.SITUACAO 
                                        FROM tb_grupo_pesquisa gp
                                        inner join tb_grupo_lider gl
                                        on gp.ID = gl.ID_GRUPO_FK
                                        AND gl.ID_LIDER_FK = $id
                                        AND GL.DATA_FIM IS NULL;
                                        ;";

                    $result1 = $conexao->query($sql);
                    while($row = $result1->fetch_assoc()) {

                    $nomeGrupo = $row["NOME"];
                    $Ft = $row["LOGOTIPO"];
                    $idGrupo = $row["ID"];
                    $siglaGrupo = $row["SIGLA"];
                    $dataInicio =  $row["DATA_INICIO"];
                    $dataCerta = date('d/m/Y', strtotime($dataInicio));
                    $situacao = $row["SITUACAO"];
                    

                      $Ft = "\\"."fotos"."\\".$Ft;
                 
                      


                    /*$sql = "SELECT * FROM `tb_grupo_pesquisa` WHERE ID = $idGrupo";
                    $result1 = $conexao->query($sql);

                    while($row = $result1->fetch_assoc()) {

                    $nomeGrupo = $row["NOME"];
                    $idGrupo = $row["ID"];
                    $siglaGrupo = $row["SIGLA"];
                    $dataInicio =  $row["DATA_INICIO"];
                    $dataCerta = date('d/m/Y', strtotime($dataInicio));
                    $situacao = $row["SITUACAO"];*/


                     $sql = "SELECT * FROM `tb_lider_pesquisa` WHERE ID = $id;";
                     $result2 = $conexao->query($sql);
                     if ($row = $result2->fetch_assoc()) {
                     $nomeLider = $row["NOME"];
                     }
                        

                    if ($situacao == 0) {
                    $status = "AGUARDANDO LIDER";
                    }elseif ($situacao == 1) {
                    $status = "ATIVO";
                    }elseif ($situacao == 2) {
                    $status = "INATIVO";
                    }



                        echo('<tr>');
                        //mostra nome da tela em uma coluna

                        echo('<td>   <img src="'.$Ft.'" class="img-circle" width="50px" height="50px" alt="...">  </td>');
                        echo('<td name="tela'.$nomeGrupo.'" value="'.$nomeGrupo.'">'.$nomeGrupo.'</td>');
                        echo('<td name="tela'.$siglaGrupo.'" value="'.$siglaGrupo.'">'.$siglaGrupo.'</td>');
                        echo('<td><input type="button" class="btn btn-primary" value ="Escolher" onclick="peganame('.$idGrupo.')" name="'.$idGrupo.'" data-toggle="toggle"></td>');
                      

                       
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
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
  </div>
</div>
<!-- Fim do Modal de Grupos -->

</tr>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


window.onload = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


<script type="text/javascript">
    function peganame(id,endereco){  



        window.location.replace("PegaIdGrupo.php?id=" + id);
    };
</script>


  <?php
  if($_SESSION["TIPO_USUARIO"] == 2){
if($_SESSION['idGrupoAtual'] == "" ){
  if(   $_SESSION["ExibicaoDeTabelaGrupo"] == 0){
     $_SESSION["ExibicaoDeTabelaGrupo"] = 1;
      
  ?>

 <script type="text/javascript">
    $('#id01').modal();
</script>

    <?php
      }
    }
  }





?>

