<?php 

  
session_start();


    include 'abreConexao.php';
		
	 $idTecnico = $_POST['idTecnico'];		    
     $nomeTecnico = $_POST['nome'];
     $clattes = $_POST['clattes'];
     $atividade = $_POST['atividade'];
     $titulacao = $_POST['titulacao'];
     $desc_titulacao = $_POST ['desc'];
     $dataConclusao = $_POST ['dataConclusao'];
     $dataVinculo = $_POST ['dataVinculo'];
     $dataTermino = $_POST ['dataTermino'];
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


     $sql = "UPDATE tb_tecnico SET FOTO = '$nome_atual' WHERE ID = '$idTecnico';";
    $sql = $conexao->query($sql);



                   

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

		



      $sql = "UPDATE tb_tecnico SET NOME = '$nomeTecnico' WHERE ID = '$idTecnico';";
    $sql = $conexao->query($sql);

    if(strpos($clattes, 'LATTES')){

	 $sql = "UPDATE tb_tecnico SET LINK_LATTES = '$clattes' WHERE ID = '$idTecnico';";
    $sql = $conexao->query($sql);}
    else{
                        $_SESSION["ALERT1"] = "O curriculo lattes digitado não é valido";
        header("location: TelaAlteraTecnico.php?id=".$idTecnico."");
                      }    

    $sql = "UPDATE tb_tecnico SET ATIVIDADE_REALIZADA = '$atividade' WHERE ID = '$idTecnico';";
    $sql = $conexao->query($sql);

    $sql = "UPDATE tb_tecnico SET DESCRICAO_FORMACAO = '$desc_titulacao' WHERE ID = '$idTecnico';";
    $sql = $conexao->query($sql);

    $sql = "UPDATE tb_tecnico SET DATA_CONCLUSAO = '$dataConclusao' WHERE ID = '$idTecnico';";
    $sql = $conexao->query($sql);

    $sql = "UPDATE tb_tecnico SET TITULACAO_FK = '$titulacao' WHERE ID = '$idTecnico';";
    $sql = $conexao->query($sql);

      $sql = "UPDATE tb_tecnico_grupo SET DATA_INICIO = '$dataVinculo' WHERE ID_TECNICO_FK = '$idTecnico';";
    $sql = $conexao->query($sql);
    
      $sql = "UPDATE tb_tecnico_grupo SET DATA_TERMINO = '$dataTermino' WHERE ID_TECNICO_FK = '$idTecnico';";
    $sql = $conexao->query($sql);

                   

$_SESSION["CADASTRADO"] = "Técnico alterado com sucesso  !!" ;
                    header('location:Tecnicos.php');



    include 'fechaConexao.php';
?>




