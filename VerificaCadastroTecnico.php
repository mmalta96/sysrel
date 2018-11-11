
<?php

  
session_start();


    include 'abreConexao.php';
    
     $nomeTecnico = $_POST['nome'];
     $idGrupo = $_SESSION['idGrupoAtual'];
     $clattes = $_POST['clattes'];
     $atividade = $_POST['descricao'];
     $titulacao = $_POST['titulacao'];
     $desc_titulacao = $_POST ['desc'];
     $dataConclusao = $_POST ['dataConclusao'];
     $dataVinculo = $_POST ['dataVinculo'];
     $clattes = strtoupper($clattes);



     

     date_default_timezone_set('America/Sao_Paulo');
     $dataAtual = date('Y-m-d H:i');


     $pasta = "fotos/";

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
             
            if($tamanho < '1024'){ //se imagem for até 1MB envia
                $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                $tmp = $_FILES['imagem']['tmp_name']; //caminho temporário da imagem
                 

                 

                /* se enviar a foto, insere o nome da foto no banco de dados */
                if(move_uploaded_file($tmp,$pasta.$nome_atual)){
                  

                    try{

                   /*  "INSERT INTO `tb_docentes` (`ID`, `NOME`, `DESC_TITULACAO`, `LINK_LATTES`, `FOTO`, `ID_TITULACAO_FK`) VALUES (0, '$docent', '$descricao', '$clattes', '$nome_atual', '$titulo');";
                    $sql = $conexao->query($sql);*/


                    if(strpos($clattes, 'LATTES')){
                   $sql = "INSERT INTO `tb_tecnico` (`ID`, `NOME`, `LINK_LATTES`, `ATIVIDADE_REALIZADA`, `DESCRICAO_FORMACAO`, `DATA_CONCLUSAO`, `FOTO`, `TITULACAO_FK`) VALUES ('0', '$nomeTecnico', '$clattes', '$atividade', '$desc_titulacao', '$dataConclusao', '$nome_atual', '$titulacao');";
                   $sql = $conexao->query($sql);
                    

                    

                     $sql = "SELECT ID FROM tb_tecnico ORDER BY id DESC LIMIT 1";
                    $resultado = $conexao->query($sql);

                    while($row = $resultado->fetch_assoc()){
                        $UltimoTecnicoCadastrado = $row['ID'];
                    }


                    $sql = "INSERT INTO `tb_tecnico_grupo` (`ID_TECNICO_FK`, `ID_GRUPO_FK`, `DATA_CADASTRO`, `DATA_INICIO`, `DATA_TERMINO`, `ID`) VALUES ('$UltimoTecnicoCadastrado', '$idGrupo', '$dataAtual', '$dataVinculo', NULL, 0);";
                    $sql = $conexao->query($sql);

                    $_SESSION["ALERT"] = "Técnico ($nomeTecnico) Cadastrado Com Sucesso  !!" ;
                                        header('location:Tecnicos.php');                        


                      }else{
                        $_SESSION["ALERT"] = "O curriculo lattes digitado não é valido";
        header("location: TelaCadastraTecnico.php");
                      }    
                   




                   
                

                    
//

                  }catch(Exception $e){

                    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
                  }




                }else{
                    echo "Falha ao enviar";
                }
            }else{
                echo "A imagem deve ser de no máximo 1MB";
                echo 'tamanho '.$tamanho;
            }
        }else{
            echo "Somente são aceitos arquivos do tipo Imagem";
        }
    }else{
        echo "Selecione uma imagem";
        exit;
    }
    include 'fechaConexao.php';
?>


