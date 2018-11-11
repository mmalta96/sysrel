
<?php 
	session_start();


$USUARIO = $_POST['uname'];
$SenhaCriptograda = hash('sha256',$_POST['psw']);
$SENHA= $SenhaCriptograda;
$SENHA_NORMAL = $_POST['psw'];
$VERIFICApasso2 = 0;

include 'abreConexao.php';


$sql = "SELECT * FROM `tb_administrador`";
$sqlLIDER = "SELECT * FROM `tb_lider_pesquisa`";

$VerificaPrimeiroAcesso = 0;

$resultado =  $conexao->query($sql);
$resultadoLider =  $conexao->query($sqlLIDER);

$verificador = 0;
$quantidadeDisponivel = 5;
$quantidadeTemp = 0;

//VERIFICA SE O USUARIO (ADMINISTRADOR) DIGITADO EXISTE E FAZ AS VERIFICAÇÕES
while($row = $resultado->fetch_assoc()){
if($row['LOGIN'] == strtoupper($USUARIO)){
	if($row['ERROS_LOGIN'] < 5 ){
	if($row['SENHA'] == $SENHA ){ // ENTRADA AUTORIZADA
		$verificador = 1;
		$sql2 = "UPDATE tb_administrador SET ERROS_LOGIN = 0 WHERE LOGIN = '$USUARIO'";
		$sql2 = $conexao->query($sql2);
		
		//PASSA POR SESSION PARA OUTRA PAGINA
		$_SESSION["ID_USUARIO"] = $row['ID'];
		$_SESSION["TIPO_USUARIO"] = 1;
		$_SESSION["NOMEL"] = $row['LOGIN'];

	}else{ // ENTRADA NAO AUTORIZADA, DIMINUI 1 DA QUANTIDADE DE TENTATIVAS
		$sql2 = "UPDATE tb_administrador SET ERROS_LOGIN = ERROS_LOGIN+1 WHERE LOGIN = '$USUARIO'";
		$sql2 = $conexao->query($sql2);

		$quantidadeDisponivel = $row['ERROS_LOGIN'];
		$quantidadeTemp = 1;
		if($row['ERROS_LOGIN'] > 3){
			$_SESSION["ALERT"] = "EXCEDEU O LIMITE DE TENTATIVAS TROQUE A SENHA";
			header("location:Login.php");
		}
	}

}else{ // SE CAIR AQUI, QUER DIZER QUE ERROU MAIS DE 5 VEZES A SENHA DESTE O USUARIO
$quantidadeDisponivel = 6;
}
	}else{
	if($verificador == 1){
		//faz nada
	}
}
	}

//VERIFICA SE O USUARIO (LIDER DE PESQUISA) DIGITADO EXISTE E FAZ AS VERIFICAÇÕES
while($row = $resultadoLider->fetch_assoc()){
if($row['PRONTUARIO'] == strtoupper($USUARIO)){
	if($row['ERROS_LOGIN'] < 5 ){
		// VERIFICA SE É O PRIMEIRO ACESSO DE LIDER COM A SENHA ENVIADA POR EMAIL
			if($row['SENHA_ANTIGA'] == ""){ // SE FOR A SENHA NÃO É CRIPTOGRAFADA
			$SENHA  = $SENHA_NORMAL;
				}

		

	if($row['SENHA'] == $SENHA ){ // ENTRADA AUTORIZADA
		$verificador = 1;
		$sql2 = "UPDATE tb_lider_pesquisa SET ERROS_LOGIN = 0 WHERE PRONTUARIO = '$USUARIO'";
		$sql2 = $conexao->query($sql2);
		
		if($row['SENHA_ANTIGA'] == ""){
			$VerificaPrimeiroAcesso = 1;
		}

				// SE A SEGUNDA ETAPA AINDA NAO FOI FEITA ELE ALTERA A VARIAVEL 
			if($row['CLATTES'] == "" || $row['FOTO'] == "" ){ 
			$VERIFICApasso2 = 1;

				}


		$_SESSION["ID_USUARIO"] = $row['ID'];
		$_SESSION["TIPO_USUARIO"] = 2;
		$_SESSION["NOMEL"] = $row['NOME'];
		$_SESSION["FOTOL"] = $row['FOTO'];
		$_SESSION["LATTES"] = $row['CLATTES'];
		$_SESSION['idGrupoAtual'] = "";
		$_SESSION['ExibicaoDeTabelaGrupo'] = 0;
		

	}else{ // ENTRADA NAO AUTORIZADA, DIMINUI 1 DA QUANTIDADE DE TENTATIVAS
		$sql2 = "UPDATE tb_lider_pesquisa SET ERROS_LOGIN = ERROS_LOGIN+1 WHERE PRONTUARIO = '$USUARIO'";
		$sql2 = $conexao->query($sql2);

		$quantidadeDisponivel = $row['ERROS_LOGIN'];
		$quantidadeTemp = 1;
		
		if($row['ERROS_LOGIN'] > 3){
			$_SESSION["ALERT"] = "EXCEDEU O LIMITE DE TENTATIVAS TROQUE A SENHA";
			header("location:index_logado.php");
		}
	}

}else{ // SE CAIR AQUI, QUER DIZER QUE ERROU MAIS DE 5 VEZES A SENHA DESTE O USUARIO
$quantidadeDisponivel = 6;
}
	}else{
	if($verificador == 1){
		//faz nada
	}
}
	}


// SE ACHOU ALGUM USUARIO ( ADMINISTRADOR OU LIDER AUTORIZADOS) CHAMA O INDEX.

$Aviso;

if($verificador == 1){

	if($VerificaPrimeiroAcesso == 1 && $VERIFICApasso2 == 1 ){
		header("location:telaPrimeiroAcessoLider.php");
	}
	else if($VERIFICApasso2 == 1 && $VerificaPrimeiroAcesso == 0){
		header("location:primeiroAcessoLiderDados.php");
	
	}
	else{
	header("location:index_logado.php");
		}
}else{
		if($quantidadeDisponivel > 3 && $quantidadeTemp = 0){
			$Aviso .= "EXCEDEU O LIMITE DE TENTATIVAS TROQUE A SENHA   <br>   ";
			
		}

	$Aviso .= "Login Inválido!   <br>  ";
	

	if((4 -$quantidadeDisponivel) > 0){
		$Aviso .= "TENTATIVAS DISPONIVEIS: " . (4 -$quantidadeDisponivel) ;
	}



	$_SESSION["ALERT"] = $Aviso;
		header("location:index.php");
}



include 'fechaConexao.php'
?>


