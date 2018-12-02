
    <?php

    $id =$_POST["id"];

    include 'abreConexao.php';

    $sql ="SELECT P.DESCRICAO FROM tb_pauta P

    INNER JOIN tb_reuniao R
    on P.ID_REUNIAO_FK = R.ID
    and R.ID = '$id'";

     $sql = $conexao->query($sql);

     $arrayPautas = "";


       while($row = $sql->fetch_assoc()){
               $arrayPautas = $arrayPautas. $row['DESCRICAO'].",";
             }

        $arrayPautas = substr($arrayPautas, 0, strlen($arrayPautas)-1);

     echo $arrayPautas;
   

    ?>