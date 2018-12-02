<?php 
	session_start();

include 'abreConexao.php';
$idR = $_POST["id"];
$idGrupo = $_SESSION["idGrupoAtual"];

$sql = "SELECT RN.ID as id,tdr.FINALIZACAO as situacao, 
GROUP_CONCAT(DISTINCT(tp.DESCRICAO)) as title,
RN.DATA as start,
RN.DATA  as FIM,
tdr.HORA_INICIO as INICIO_hora,
tdr.HORA_FIM as FIM_hora,
GROUP_CONCAT(DISTINCT(D.NOME)) as DOCENTE,
GROUP_CONCAT(DISTINCT(tcr.NOME)) as CONVIDADO,
tdr.ATA 




FROM tb_reuniao as RN

INNER JOIN tb_pauta tp
ON tp.ID_REUNIAO_FK = RN.ID

LEFT JOIN tb_detalhe_reuniao tdr
ON tdr.ID_REUNIAO_FK = RN.ID

LEFT JOIN tb_detalhe_reuniao_docente tdrd
ON tdrd.ID_REUNIAO_FK = RN.ID

LEFT JOIN tb_convidado_reuniao tcr
ON tcr.ID_REUNIAO_FK = RN.ID

 LEFT JOIN tb_docentes D 
 on tdrd.ID_DOCENTE_FK = D.ID



WHERE RN.ID_GRUPO_FK = '$idGrupo'
AND RN.ID = '$idR'
GROUP BY RN.ID ";

$result = $conexao->query($sql);

	 $arrayPautas = "";
	while($row = $result->fetch_assoc()){
               $arrayPautas = $arrayPautas. $row['INICIO_hora']."|";
               $arrayPautas = $arrayPautas. $row['FIM_hora']."|";
               $arrayPautas = $arrayPautas. $row['CONVIDADO']."|";
               $arrayPautas = $arrayPautas. $row['DOCENTE']."|";
               
               $intervalo = 45;
               $str_formatada = wordwrap($row['ATA'], $intervalo, '<br>', true);
               $arrayPautas = $arrayPautas. $str_formatada."|";
             }

        $arrayPautas = substr($arrayPautas, 0, strlen($arrayPautas)-1);

     echo $arrayPautas;



?>