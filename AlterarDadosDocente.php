<?php

  
session_start();


    include 'abreConexao.php';
    
    $pasta = "fotos/";
    $lattes = $_POST['clattes'];
    $titulo =  $_POST['titulacao'];
    $docent =  $_POST['docente'];
    $descricao =  $_POST['desc'];
    $idGrupo = $_SESSION['idGrupoAtual'];
    $id = $_POST['idUsuario'];
     $linhas = $_POST['arrayLinhas'];
     $dataInicio = $_POST['data'];


     include "abreConexao.php";
  $sql = "SELECT ID_LINHA FROM tb_linha_grupo WHERE ID_GRUPO = '$idGrupo'";
$resultado =  $conexao->query($sql);
$aux = 0;
 while($row = $resultado->fetch_assoc()){        
         if(strstr($linhas, $row['ID_LINHA'])){
            $aux = 1;
         }             
                    }
    
echo $aux;
     if($aux == 0 && $linhas != ""){
           $_SESSION["EXCLUSAO"] = " ERRO - TENTATIVA DE ADICIONAR LINHA DE PESQUISA QUE NÃO PERTENCE AO GRUPO !!" ;

                      header('location:AlterarDocente.php?id='.$id.'');
     }else{




    
  
         /* formatos de imagem permitidos */
         $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");

        $nome_imagem    = $_FILES['imagem']['name'];
        $tamanho_imagem = $_FILES['imagem']['size'];


          if($_FILES['imagem']['name'] != ""){
          
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

                    $sql = "UPDATE `tb_docentes` SET `NOME` = '$docent', `DESC_TITULACAO` = '$descricao', `LINK_LATTES` = '$lattes', `FOTO` = '$nome_atual', `ID_TITULACAO_FK` = '$titulo' WHERE `tb_docentes`.`ID` = '$id';";
                    $sql = $conexao->query($sql);



                                //VINCULA AS LINHAS SELECIONADAS AO DOCENTE          
                    $arrayInicial = explode(',', $linhas);

                    foreach ($arrayInicial as $value) {
                        echo $value . '<br/>';


                           $sql = "INSERT INTO `tb_docente_linha` (`ID`, `ID_DOCENTE_FK`, `ID_LINHA_PESQUISA_FK`, `DATA_CADASTRO`, `DATA_INICIO`, `DATA_TERMINO`, `ID_GRUPO_FK`) VALUES (0, '$id', '$value', NOW() , '$dataInicio', NULL, '$idGrupo');";
                            $sql = $conexao->query($sql);

                        

                    }

                        

                    
                

                    $_SESSION["ALERT"] = "DOCENTE ($docent) ALTERADO COM SUCESSO !!" ;

                  
                   header('location:cadastroDocentes.php');

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
        //SE A IMAGEM NÃO ESTIVER SIDO ALTERADA
                 try{

                    if($dataInicio == "" && $linhas != ""){
                        $_SESSION["EXCLUSAO"] = " Erro - Informe a Data de Inicio  !!" ;            
                         header('location:AlterarDocente.php?id='.$id.'');

                    }else{


                    $sql = "UPDATE `tb_docentes` SET `NOME` = '$docent', `DESC_TITULACAO` = '$descricao', `LINK_LATTES` = '$lattes',  `ID_TITULACAO_FK` = '$titulo' WHERE `tb_docentes`.`ID` = '$id';";
                    $sql = $conexao->query($sql);


                                                //VINCULA AS LINHAS SELECIONADAS AO DOCENTE          
                    $arrayInicial = explode(',', $linhas);

                    foreach ($arrayInicial as $value) {
                        echo $value . '<br/>';


                           $sql = "INSERT INTO `tb_docente_linha` (`ID`, `ID_DOCENTE_FK`, `ID_LINHA_PESQUISA_FK`, `DATA_CADASTRO`, `DATA_INICIO`, `DATA_TERMINO`, `ID_GRUPO_FK`) VALUES (0, '$id', '$value', NOW() , '$dataInicio', NULL, '$idGrupo');";
                            $sql = $conexao->query($sql);
                             
                        

                    }
                        

                    $_SESSION["ALERT"] = "DOCENTE ($docent) ALTERADO COM SUCESSO  !!" ;

                  
                    header('location:cadastroDocentes.php');

                }

                  }catch(Exception $e){

                    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
                  }
        
    }
    include 'fechaConexao.php';
}
?>