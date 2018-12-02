<?php 
	session_start();

	include 'abreConexao.php';

	//pega a quantidade de registros da tabela.
	$sql = "select count(ID_TELA_FK) 'qtd' from tb_permissao_telas";

	$result = $conexao->query($sql);
	$qtd = 0;
	if($row = $result->fetch_assoc()){
		$qtd = $row["qtd"];
	}

	
	for ($x = 1; $x <= $qtd; $x++) {
		$adm = $x."ADM";
		$lider = $x."LIDER";

		$v_adm;
		$v_lider;

		if (isset($_POST[$adm])){
			$v_adm = 1;
		}
		else {
			$v_adm = 0;
		}

		if (isset($_POST[$lider])){
			$v_lider = 1;
		}
		else {
			$v_lider = 0;
		}


		$sql = 'UPDATE tb_permissao_telas SET ADM ='.$v_adm.' , LIDER = '.$v_lider.' WHERE ID_TELA_FK = '.$x;

		try {
  			$conexao->query($sql);
		} catch (Exception $e) {
		    echo 'Erro ao salvar: ',  $e->getMessage(), "\n";
		}
		

	}


	include 'fechaConexao.php';
	$_SESSION["ALERT"] = "Permissões salvas com sucesso!";
	header("location:permissoes.php");

?>