<?php
  

   session_start();
	$id = ($_GET["id"]);
	try {
    	 // Inicia a sessão
                    include 'abreConexao.php';

                    $sql = "DELETE  FROM `tb_itens_index` WHERE ID = $id";
                     $conexao->query($sql);
                    $_SESSION["ALERT"] = "Item removido com sucesso !! ";
    				 header('location:ItensSobregrupo.php');


                     include 'fechaConexao.php';


                         }catch (Exception $e) {

      $_SESSION["ALERT"] = "Não foi possivel remover o item .";
     header('location:ItensSobregrupo.php');


     
}
        

?>