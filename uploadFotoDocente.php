<?php

  
session_start();


    include 'abreConexao.php';
    
    $pasta = "fotos/";
    $lattes = $_POST['clattes'];
    $dataInicio = $_POST['data'];
    $titulo =  $_POST['titulacao'];
    $docent =  $_POST['docente'];
    $descricao =  $_POST['desc'];
    $idGrupo = $_SESSION['idGrupoAtual'];
    $linhas = $_POST['arrayLinhas'];
    $lattes = strtoupper($lattes);

    //echo $linhas;
    //echo $dataInicio;

    include 'abreConexao.php';


$sql = "SELECT ID_LINHA FROM tb_linha_grupo WHERE ID_GRUPO = '$idGrupo'";
$resultado =  $conexao->query($sql);
$aux = 0;
 while($row = $resultado->fetch_assoc()){        
         if(strstr($linhas, $row['ID_LINHA'])){
            $aux = 1;
         }             
                    }
     
echo $aux;
     if($aux == 0){
           $_SESSION["ALERT"] = " ERRO - TENTATIVA DE ADICIONAR LINHA DE PESQUISA QUE NÃO PERTENCE AO GRUPO !!" ;

                      header('location:CadastroNovoDocente.php');
     }else{

    if($linhas == "" ){
         $_SESSION["ALERT"] = " ERRO, SELECIONE AO MENOS (1) LINHA DE PESQUISA !!" ;

                  
                    header('location:CadastroNovoDocente.php');
    }else{
        
     
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
                  
                    if(strpos($lattes, 'LATTES')){
                    try{

                    $sql = "INSERT INTO `tb_docentes` (`ID`, `NOME`, `DESC_TITULACAO`, `LINK_LATTES`, `FOTO`, `ID_TITULACAO_FK`) VALUES (0, '$docent', '$descricao', '$lattes', '$nome_atual', '$titulo');";
                    $sql = $conexao->query($sql);


                    // PEGA ID DO ULTIMO CADASTRADO - NO CASO O DOCENTE QUE ESTÁ SENDO CADASTRADO.
                    $sql = "SELECT ID FROM tb_docentes ORDER BY id DESC LIMIT 1";
                    $resultado = $conexao->query($sql);

                    while($row = $resultado->fetch_assoc()){
                        $UltimoDocenteCadastrado = $row['ID'];
                    }


                    // SALVA ELE NA TABELA DOCENTE_GRUPO
                     $sql = "INSERT INTO `tb_docente_grupo` (`ID`, `ID_DOCENTE_FK`, `ID_GRUPO_FK`, `DATA_CADASTRO`, `DATA_INICIO`, `DATA_TERMINO`) VALUES (0, '$UltimoDocenteCadastrado', '$idGrupo', NOW(), '$dataInicio', NULL);";
                    $sql = $conexao->query($sql);


                    //VINCULA AS LINHAS SELECIONADAS AO DOCENTE          
                    $arrayInicial = explode(',', $linhas);

                    foreach ($arrayInicial as $value) {
                        echo $value . '<br/>';


                           $sql = "INSERT INTO `tb_docente_linha` (`ID`, `ID_DOCENTE_FK`, `ID_LINHA_PESQUISA_FK`, `DATA_CADASTRO`, `DATA_INICIO`, `DATA_TERMINO`, `ID_GRUPO_FK`) VALUES (0, '$UltimoDocenteCadastrado', '$value', NOW() , '$dataInicio', NULL, '$idGrupo');";
                            $sql = $conexao->query($sql);

                        

                    }

                

                    $_SESSION["ALERT"] = "DOCENTE ($docent) CADASTRADO COM SUCESSO  !!" ;

                  
                    header('location:cadastroDocentes.php');

                  }catch(Exception $e){

                    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
                  }
              }else{
          $_SESSION["ALERT"] = "O curriculo lattes digitado não é valido";
        header("location: CadastroNovoDocente.php");
                       
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
    }
}
    include 'fechaConexao.php';
?>