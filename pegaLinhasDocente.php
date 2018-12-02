<?php 

session_start();

$id_docente = $_POST["id"];

$id_grupo = $_SESSION["idGrupoAtual"];

include 'abreConexao.php';

$sql = 'SELECT lp.ID, lp.NOME FROM tb_linha_pesquisa lp inner join tb_docente_linha dl on dl.ID_LINHA_PESQUISA_FK = lp.ID and dl.ID_GRUPO_FK = '.$id_grupo.' and dl.ID_DOCENTE_FK = '.$id_docente;


$result = $conexao->query($sql);

$linhas = "";

while($row = $result->fetch_assoc()) {
       $linhas = $linhas.'<option value="'.$row["ID"].'">'.$row["NOME"].'</select>';
}


$linhas = substr($linhas, 0,strlen($linhas)-1);

echo $linhas;




 ?>