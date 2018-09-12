
<?php 
include 'abreConexao.php';

//VERIFICA SE Email existe
$sql = "SELECT * FROM `tb_administrador`";
$AdmVazio = 0;
$resultado =  $conexao->query($sql);
$verificador = 0;
$quantidadeDisponivel = 5;

$consulta = $conexao->query($sql);
$conta = $consulta->fetch_assoc();
if (empty($conta))
{

  $AdmVazio = 1;
    //SE NÃO HOUVER ADMNISTRADORES, CHAMA PAGINA DE CADASTRO
    
} else {
    header("location:index.php");
}



include 'fechaConexao.php'
?>

<?php 
    session_start();

    $SENHA;
    $SENHAB;
    $EMAIL;
 
    
    $LOG = strtoupper($_POST['login']);
    $EMAIL = strtolower($_POST['email']);
    $SENHA = $_POST['psw'];
    $SENHAB = $_POST['psw-repeat'];
    $SenhaCriptograda = hash('sha256',$_POST['psw']);


        if($SENHA == $SENHAB){
        include 'abreConexao.php';

//VERIFICA SE JÁ NÃO SALVOU ESTE USUARIO
$sql = "SELECT * FROM `tb_administrador`";

$resultado =  $conexao->query($sql);
$verificador = 0;

while($row = $resultado->fetch_assoc()){
if($row['LOGIN'] == strtoupper($LOG) || $row['EMAIL'] == strtolower($EMAIL)){

        $verificador = 1;
 
}
}

if($verificador == 1){
      $_SESSION["ALERT"] = "Esse Login ou email ja esta cadastrado!";
    header('location:cadastroAdministrador.php?');
 


  

}else{ 


    $Teste = preg_match('/[0-9]+/', $SENHA);

    if($Teste == 1){
        $Teste = preg_match('/[a-z]+/', $SENHA);

        if($Teste == 1){
          $Teste = preg_match('/[A-Z]+/', $SENHA);

          if($Teste == 1){
              $Teste = preg_match('/[\W]+/', $SENHA);
          }
        }
    }

    

    if($Teste == 1){

      $sql = "INSERT INTO `tb_administrador` (`LOGIN`,`ID`, `EMAIL`, `SENHA`, `SENHA_ANTIGA`, `ERROS_LOGIN`) VALUES ('$LOG','0', '$EMAIL', '$SenhaCriptograda', '$SenhaCriptograda', '0');";
      $sql = $conexao->query($sql);

        $_SESSION["ALERT"] = "Administrador Cadastrado com Sucesso!";

        include 'fechaConexao.php';

        header('location:index.php');
    }else if($Teste == 0){
        $_SESSION["ALERT"] = "OBS* Senha deve Conter : No minimo 6 caracteres, 1 letra minúscula, 1 maiúscula, 1 número e 1 caractere especial!";

        include 'fechaConexao.php';


        if($AdmVazio == 0){
        header('location:cadastroAdministrador.php');

        }else{
          header('location:PrimeiroAcessoAdm.php?');
        }



    }
  

}
     




        }else{
              if (isset($_SESSION['ID_USUARIO'])){
             $_SESSION["ALERT"] = "Senhas não Coincidem !";
            header('location:cadastroAdministrador.php?');
}else{
  $_SESSION["ALERT"] = "Senhas não Coincidem !";
            header('location:PrimeiroAcessoAdm.php?');
}




        }
  

    ?>


  