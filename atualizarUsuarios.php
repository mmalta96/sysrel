<?php

  
session_start();


    include 'abreConexao.php';
    
    $pasta = "fotos/";
    $lattes = $_POST['clattes'];
    $lider = $_SESSION["ID_USUARIO"];
    $nomeAtual = $_POST['nome'];
     
    $_SESSION["LATTES"] = $_POST['clattes'];
    $_SESSION["NOMEL"] = $_POST['nome'];
    $_SESSION["ALERT"] = "DADOS ATUALIZADOS !!" ;



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

                    $sql = "UPDATE tb_lider_pesquisa SET foto = '$nome_atual' WHERE ID = '$lider'";
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

                    $sql = "UPDATE tb_lider_pesquisa SET clattes = '$lattes' WHERE ID = '$lider';";
                    $sql = $conexao->query($sql);
                    $sql = "UPDATE tb_lider_pesquisa SET NOME = '$nomeAtual' WHERE ID = '$lider';";
                    $sql = $conexao->query($sql);

header('location:index_logado.php');


    include 'fechaConexao.php';
?>