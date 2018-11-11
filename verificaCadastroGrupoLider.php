

<?php 

SESSION_START();

$idGrupoAtual=isset ($_SESSION["idGrupoAtual"])?$_SESSION["idGrupoAtual"]:"";



include 'abreConexao.php';




//echo $lider;



$pasta = "fotos/";
$sigla = $_POST['sigla'];
$nome = $_POST['nome'];
$descricao= $_POST['descricao'];
$email= $_POST['email'];
$lattes= $_POST['clattes'];
$data= $_POST['data'];



    /* formatos de imagem permitidos */
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
     

    

    if(isset($_POST)){
        $nome_imagem    = $_FILES['imagem']['name'];
        $tamanho_imagem = $_FILES['imagem']['size'];
         
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));
         
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
             
            /* converte o tamanho para KB */
            $tamanho = round($tamanho_imagem / 1024);
             
            if($tamanho < 1024){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['imagem']['tmp_name']; //caminho temporário da imagem
                 
             $_SESSION["FOTOL"] = $nome_atual;

                 

                /* se enviar a foto, insere o nome da foto no banco de dados */
                if(move_uploaded_file($tmp,$pasta.$nome_atual)){
                  

                    try{

                    $sql = "UPDATE tb_grupo_pesquisa SET LOGOTIPO = '$nome_atual' WHERE ID = '$idGrupoAtual'";
                    $sql = $conexao->query($sql);
                  
                   
                  }catch(Exception $e){

                    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
                  }




                    }else{
                        echo "Falha ao enviar";
                    }
                }else{
                    echo "A imagem deve ser de no máximo 1MB";
                }
            }else{
                echo "Somente são aceitos arquivos do tipo Imagem";
                
            }
        }else{
            echo "Selecione uma imagem";
            exit;
        }



$sql = "UPDATE tb_grupo_pesquisa SET SIGLA = '$sigla' WHERE ID = '$idGrupoAtual';";
                    $sql = $conexao->query($sql);


$sql = "UPDATE tb_grupo_pesquisa SET NOME = '$nome' WHERE ID = '$idGrupoAtual';";
                    $sql = $conexao->query($sql);

$sql = "UPDATE tb_grupo_pesquisa SET descricao = '$descricao' WHERE ID = '$idGrupoAtual';";
                    $sql = $conexao->query($sql);

$sql = "UPDATE tb_grupo_pesquisa SET email = '$email' WHERE ID = '$idGrupoAtual';";
                    $sql = $conexao->query($sql);

$sql = "UPDATE tb_grupo_pesquisa SET LINK_DGP = '$lattes' WHERE ID = '$idGrupoAtual';";
                    $sql = $conexao->query($sql);

$sql = "UPDATE tb_grupo_pesquisa SET DATA_INICIO = '$data' WHERE ID = '$idGrupoAtual';";
                    $sql = $conexao->query($sql);

$sql = "UPDATE tb_grupo_pesquisa SET SITUACAO = '1' WHERE ID = '$idGrupoAtual';";
                    $sql = $conexao->query($sql);


$_SESSION["ALERT"] = "Dados Atualizados: ";
     header('location:telaMostraGruposLider.php');





 ?>